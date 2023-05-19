<?php
  global $current_user; wp_get_current_user();
  $all_orders = wc_get_orders([]);
  $i=1;
  $total_amount = 0;
  $total_return_agent = 0;

  foreach ($all_orders as $order)
  {
    $data_order = $order->get_base_data();
    $meta_data = $order->get_meta('custom_order_field');

    $items = $order->get_items();
    $product_name = '';
    $agent ='';

    foreach ( $items as $item ) {
      $product_name .= $item->get_name() . ' ';
      $product_id =$item->get_data()['product_id'];
      $agent = wc_get_product($product_id)->short_description;
  }
    if (current_user_can('wp_realestate_agent') && $agent != $current_user->user_login)
    {
      continue;
    }
    $price_agent = round($data_order['total'] * 0.99);
    $price_host = round($data_order['total'] * 0.1);
    $total_amount += $data_order['total'];
    $total_return_agent += $price_agent;

    $data .= '<tr class="text-center">';
    $data .= '<td class="text-center">'.$i++.'</td>';
    $data .= '<td><a href="'.admin_url( 'post.php?post=' . $data_order['id'] . '&action=edit') .'">'.$data_order['id'].'</a></td>';
    $data .= '<td>'.$agent.'</td>';
    $data .= '<td>'.$product_name.'</td>';
    $data .= '<td class="text-center">'.$data_order['date_created']->date("Y-m-d H:i:s").'</td>';
    $data .= '<td>'.wc_price($data_order['total']).'</td>';
    $data .= '<td>'.wc_price($price_agent).'</td>';
    $data .= '<td>'.wc_price($price_host).'</td>';
    $data .= '<td>'.$data_order['status'].'</td>';
    $data .= '<td class="text-center">'.$meta_data.'</td>';
    $data .= '</tr>';
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/scss/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <title>Quản lý Order</title>
</head>
<body>
      <nav class="navbar navbar-expand-lg navbar-light menu_navbar">
          <div class="container-fluid w-75">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="navbar-brand" href="<?=home_url()?>"><img src="<?=get_bloginfo( 'template_directory' )?>/template-order-managentment/assets/images/logo-houzez.png" alt="logo" width="100"></a>

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
                              <div class="h5 mb-0 font-weight-bold text-gray-800">500</div>
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
                    <div class="row no-gutters align-items-center">
                        <div class="col-2">
                          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input id="dt1" type="text" data-input class="form-control input-numeric input-date text-center" data-target="#datetimepicker1"/>
                            <span class="input-group-text spancal" data-toggle>
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                              <input id="dt2" type="text" data-input class="form-control input-numeric input-date text-center" data-target="#datetimepicker1"/>
                              <span class="input-group-text spancal" data-toggle>
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                        </div>

                        <div class="col-2">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Agent's Name" aria-label="Text input with radio button">
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="input-group">
                            <select class="form-select" id="inputGroupSelect02">
                              <option selected>Status</option>
                              <option value="1">HP nhận tiền</option>
                              <option value="2">HP đã thanh toán</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-2 d-flex align-content-center justify-content-center">
                          <div class="d-flex align-content-center align-middle align-self-center w-75">
                            <button type="button" class="btn btn-primary w-100 h-50">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                          </div>
                        </div>
                        <div class="col-2 d-flex align-content-center justify-content-center">
                          <div class="d-flex align-content-center align-middle align-self-center w-75">
                          <!-- <button type="button" class="btn btn-success w-100 h-50"><a href="?download=true">CSV<i class="fa-solid fa-download"></i></a></button> -->
                          </div>
                        </div>
                    </div>
                </div>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?=$data?>
              </tbody>
            </table>
          </div>

          <h3 class="mt-4 mb-4 "> Thông tin chi tiết đơn hàng khi click vào một đơn hàng</h3>

          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                  Tên khách hàng
                </button>
              </h2>
              <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Chỗ này là tên của khách hàng
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                  Số điện thoại khách hàng
                </button>
              </h2>
              <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Refer lúc khách hàng đăng ký
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                  Tài khoản ngân hàng của khách hàng
                </button>
              </h2>
              <div id="flush-collapse3" class="accordion-collapse collapse" aria-labelledby="flush-heading3" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  refer lúc thanh toán
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                  Tên của Agent
                </button>
              </h2>
              <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Tên của cộng tác viên
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                  Tên của đại lý mà cộng tác viên thuộc vào
                </button>
              </h2>
              <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  có thể có hoặc không có
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header"id="flush-heading6">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                    Tên sản phẩm
                  </button>
              </h2>
              <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Refer name sản phẩm <br>
                  + Phần note nếu có
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading7">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                  Date time mua hàng
                </button>
              </h2>
              <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Date time định dạng yyyy/mm/dd 
                  time
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading8">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapse8">
                  Total amount
                </button>
              </h2>
              <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Số tiền mà cộng tác viên đăng. <br>
                  Cũng chính là số tiền mà khách hàng phải chuyển khoản
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading9">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-collapse9">
                  Trả cho agent
                </button>
              </h2>
              <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-heading9" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Số tiền trả cho người đăng bài
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading10">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse10" aria-expanded="false" aria-controls="flush-collapse10">
                  Số tiền trả lại cho host
                </button>
              </h2>
              <div id="flush-collapse10" class="accordion-collapse collapse" aria-labelledby="flush-heading10" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Trả cho website happy house <br>
                  1% của số tiền. 
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading11">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse11" aria-expanded="false" aria-controls="flush-collapse11">
                  Trạng thái
                </button>
              </h2>
              <div id="flush-collapse11" class="accordion-collapse collapse" aria-labelledby="flush-heading11" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                HP nhận tiền từ khách. Khi khách vừa chuyển khoản cho HP thì sẽ noti cho admin, <br>
                noti cho agent trên hệ thống. 
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading12">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse12" aria-expanded="false" aria-controls="flush-collapse12">
                  Action
                </button>
              </h2>
              <div id="flush-collapse12" class="accordion-collapse collapse" aria-labelledby="flush-heading12" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Mục đích để có thể chuyển qua thanh toán, hoặc thanh toán xong rồi chuyển qua trạng thái done. 
                </div>
              </div>
            </div>
          </div>

        
        </div>

      </div>
    </div>

        <footer class="text-center text-lg-start text-white mt-5 footer-bg">
          <!-- Grid container -->
          <div class="container p-4">
            <!--Grid row-->
            <div class="row my-4">
              <!--Grid column-->
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
      
                <div class=" d-flex align-items-center justify-content-center mb-4 mx-auto" >
                  <img src="/assets/images/logo-houzez.png"  alt=""
                       loading="lazy" />
                </div>
      
                <p class="text-center">Follow us on social media</p>
      
                <ul class="list-unstyled d-flex flex-row justify-content-center">
                  <li>
                    <a class="text-white px-2" href="#!">
                      <i class="fab fa-facebook-square"></i>
                    </a>
                  </li>
                  <li>
                    <a class="text-white px-2" href="#!">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a class="text-white ps-2" href="#!">
                      <i class="fab fa-youtube"></i>
                    </a>
                  </li>
                </ul>
      
              </div>
              <!--Grid column-->
      
              <!--Grid column-->
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Popular Search</h5>
      
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Apartment for Sale</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Apartment for Rent</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Offices for Sale</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Offices for Rent</a>
                  </li>
                </ul>
              </div>
              <!--Grid column-->
      
              <!--Grid column-->
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Quick Links</h5>
      
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Terms of Use</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Privacy Policy</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Pricing Plans</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Our Services</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">Contact</a>
                  </li>
                  <li class="mb-2">
                    <a href="#!" class="text-white text-decoration-none">FAQs</a>
                  </li>
                </ul>
              </div>
              <!--Grid column-->
      
              <!--Grid column-->
              <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Contact</h5>
      
                <ul class="list-unstyled">
                  <li>
                    <p><i class="fas fa-phone pe-2"></i>+(088) 123 456 789</p>
                  </li>
                  <li>
                    <p><i class="fas fa-envelope pe-2 mb-0"></i>hi@homez.com</p>
                  </li>
                </ul>
              </div>
              <!--Grid column-->
            </div>
            <!--Grid row-->
          </div>
          <!-- Grid container -->
      
          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: #181a20">
            © 2023 Copyright:
            <a class="text-white" href="">Golsoft</a>
          </div>
          <!-- Copyright -->
        </footer>
      

    <script src="https://kit.fontawesome.com/b33177e463.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
</body>
</html>
