<?php
include_once __DIR__ . '/template.php';

    // Process confirm sales
    if ($_POST['answer-order'] && $_POST['answer'])
    {
      $result = update_post_meta($_POST['answer-order'], 'confirm_sales', $_POST['answer']);

      if ($result)
      {
        $status = 'wc-failed';
        if ($_POST['answer'] == 'yes')
        {
          $status = 'wc-processing';
        }
        $order_data = array(
          'ID' => $_POST['answer-order'],
          'post_status' => $status,
      );

        wp_update_post($order_data);
        echo '<script>window.location.href = window.location.href;</script>';
      }
    }

    // Process admin change order status
    if ($_POST['status-order-id'])
    {
      $order_data = array(
        'ID' => $_POST['status-order-id'],
        'post_status' => $_POST['status-order']);
  
      wp_update_post($order_data);
      echo '<script>window.location.href = window.location.href;</script>';
    }

  global $current_user; wp_get_current_user();
  $all_orders = wc_get_orders([]);
  $i=1;
  $total_amount = 0;
  $total_return_agent = 0;
  $total_debt=0;

  foreach ($all_orders as $order)
  {
    $data_order = $order->get_base_data();
    $date_order = $data_order['date_created']->date("d-m-Y");
    $items = $order->get_items();
    $product_name = '';
    $agent ='';

    foreach ( $items as $item ) {
      $product_name .= $item->get_name() . ' ';
      $product_id =$item->get_data()['product_id'];
      $agent .= wc_get_product($product_id)->short_description;
    }

    // If is_agent, show only agent's order
    if ((current_user_can('wp_realestate_agent') || current_user_can('wp_realestate_agency')) && str_contains($agent, $current_user->user_login))
      {
        continue;
      }

    // Filter order if search by date
    if ($_POST['name-product'] && !str_contains($product_name, $_POST['name-product']))
      {
        continue;
      }

    if ($_POST['status-order'] && !str_contains($_POST['status-order'], $data_order['status']))
      {
        continue;
      }

      if ($_POST['start-date'] && $_POST['start-date'] > $date_order)
      {
        continue;
      }

      if ($_POST['end-date'] && $_POST['end-date'] < $date_order)
      {
        continue;
      }


    // Process radio input
    $yes ='';
    $no ='';
    $disabled = '';
    $notAdmin = '';
    if ($order->get_meta('confirm_sales'))
    {
      $disabled = 'disabled';

      if ($order->get_meta('confirm_sales') == 'yes') {
        $yes = 'checked';
      } else {
        $no = 'checked';
      }
    }

    $background = '';
    // Process refunded order
    if ($order->get_parent_id() || $order->get_status() == 'refunded')
    {
      $disabled = 'disabled';
      $notAdmin = 'disabled';
      $background = 'style="background-color: red"';
    }

    // Process status
    $option = '<option value="">Unknown</option>';
    if ($data_order['status'])
    {
      $status = 'wc-'.$data_order['status'];

      $option = '<option value="'.$status.'">'.wc_get_order_statuses()[$status].'</option>';
    }

    foreach(wc_get_order_statuses() as $key => $name)
    {
      $option .= '<option value="'.$key.'">'.$name.'</option>';
    }

    if (!current_user_can('administrator'))
    {
      $notAdmin = 'disabled';
    }

    // Calculate total price only successful order
    if (!$order->get_parent_id() && $order->get_status() == 'completed') {
      $price_agent = round($data_order['total'] * 0.99);
      $price_host = round($data_order['total'] * 0.01);

      // Calculate total prices
      $meta_data = $order->get_meta('custom_order_field');

      if (!$meta_data)
        {
          $total_debt += $price_agent;
        }

      $total_amount += $data_order['total'];
      $total_return_agent += $price_agent;
    }



    $data .= '<tr class="text-center">';
    $data .= '<td class="text-center">'.$i++.'</td>';
    $data .= '<td><a href="'.admin_url( 'post.php?post=' . $data_order['id'] . '&action=edit') .'">'.$data_order['id'].'</a></td>';
    $data .= '<td>'.$agent.'</td>';
    $data .= '<td>'.$product_name.'</td>';
    $data .= '<td class="text-center">'.$data_order['date_created']->date("d-m-Y H:i:s").'</td>';
    $data .= '<td>'.wc_price($data_order['total']).'</td>';
    $data .= '<td>'.wc_price($price_agent).'</td>';
    $data .= '<td>'.wc_price($price_host).'</td>';
    $data .= '<form method="post">
    <td><select name="status-order" class="form-select">'.$option.'
      <input type="hidden" name="status-order-id" value="'.$order->get_id().'">
      <button '.$notAdmin.' type="submit">Xác Nhận</button>
    </td></form>
    ';
    $data .= '<form method="post">
                <td '.$background.'>
                  <label>
                    <input '.$yes.' type="radio" name="answer" value="yes">
                    Yes
                  </label>
                  <label>
                    <input '.$no.' type="radio" name="answer" value="no">
                    No
                  </label>
                <input type="hidden" name="answer-order" value="'.$order->get_id().'">
                <button '.$disabled.' type="submit">Xác Nhận</button>
                </td>
              </form>';
    $data .= '<td class="text-center">'.$meta_data.'</td>';
    $data .= '</tr>';
  }

?>
<!DOCTYPE html>
<html lang="en">
<?=$head?>
<body>
      <nav class="navbar navbar-expand-lg navbar-light menu_navbar">
          <div class="container-fluid w-75">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="navbar-brand" href="<?=home_url()?>"><img src="<?=URL_ORDER_MANAGEMENT_TEMPLATE?>/assets/images/logo-houzez.png" alt="logo" width="100"></a>

              <div class="collapse navbar-collapse mx-5" id="navbarNavDarkDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-6 text-white pt-1" style="font-weight: 500;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Bất động sản
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark px-3" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Cần Bán</a></li>
                      <li><a class="dropdown-item" href="#">Cần Cho Thuê </a></li>
                      <li><a class="dropdown-item" href="#">Dự Án Hoả Tốc </a></li>
                    </ul>
                  </li>
                  <li class="nav-item mx-3">
                    <a class="nav-link active text-white" aria-current="page" href="#"><h6>Cộng Tác Viên</h6> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>

        <div class="container-fluid w-75 mt-4">
          <h3> Quản lý Order</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Quản lý order</li>
            </ol>
          </nav>

          <div class="row mt-5">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 fs-4">
                                  Total amount:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=wc_price($total_amount)?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 fs-4">
                                    Return for Agent</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=wc_price($total_return_agent)?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 fs-4">
                                  Debt</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=wc_price($total_debt)?></div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

          <h3 class="mt-4 mb-4"> Searching Area</h3>

            <div class="col-12">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <form action="?search" method="post">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2">
                          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input id="start-date" name="start-date" type="text" data-input class="form-control input-numeric input-date text-center" data-target="#datetimepicker1" value="<?=$_POST['start-date']?>"/>
                            <label for="start-date"><span class="input-group-text spancal" data-toggle>
                              <i class="fa fa-calendar"></i>
                            </span></label>
                          </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                              <input id="end-date" name="end-date" type="text" data-input class="form-control input-numeric input-date text-center" data-target="#datetimepicker1" value="<?=$_POST['end-date']?>"/>
                              <label for="end-date"><span class="input-group-text spancal" data-toggle>
                                <i class="fa fa-calendar"></i>
                              </span></label>

                            </div>
                        </div>

                        <div class="col-2">
                          <div class="input-group">
                            <input type="text" name="name-product" class="form-control" placeholder="Tên sản phẩm" aria-label="Text input with radio button" value="<?=$_POST['name-product']?>">
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="input-group">
                            <select name="status-order" class="form-select" id="inputGroupSelect02">
                              <?php
                              if ($_POST['status-order'])
                              {
                                echo '<option value="'.$_POST['status-order'].'">'.wc_get_order_statuses()[$_POST['status-order']].'</option>';

                              }else{
                                echo '<option value="">Trạng Thái Đơn Hàng</option>';
                              }

                              foreach(wc_get_order_statuses() as $key => $name)
                              {
                                echo '<option value="'.$key.'">'.$name.'</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-2 d-flex align-content-center justify-content-center">
                          <div class="d-flex align-content-center align-middle align-self-center w-75">
                            <button type="submit" class="btn btn-primary w-100 h-50">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                          </div>
                        </div>
                        <div class="col-2 d-flex align-content-center justify-content-center">
                          <div class="d-flex align-content-center align-middle align-self-center w-75">
                          </div>
                        </div>
                    </div>
                </div>
              </form>
            </div>
            </div>
          
          <div class="table-responsive mt-5">
            <table class="table table-bordered table-striped">
              <thead class="table-primary">
                <tr class="text-center align-middle">
                  <th>STT</th>
                  <th>Order ID</th>
                  <th>Agent name</th>
                  <th>Tên sản phẩm</th>
                  <th>Date time mua</th>
                  <th>Total amount</th>
                  <th>Trả cho agent</th>
                  <th>Trả cho host</th>
                  <th>Trạng thái</th>
                  <th>Xác nhận bán hàng</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                  <?=$data?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<div>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p style="text-align: center;">Lưu ý: Nếu trường Action bỏ trống, nghĩa là host chưa thanh toán tiền cho Agent</p>
    <p style="text-align: center;">Total Amount chỉ được tính khi Tình Trạng Đơn Hàng Thành Công (Agent xác nhận "Yes" -> Đang Xử Lý -> Admin: Đơn Hàng Thành Công)</p>
</div>
<?=$footer?>
</body>
</html>