<?php 
include_once __DIR__ . '/template.php';

?>

<!DOCTYPE html>
<html lang="en">
<?=$head?>
<body>
    <div class="header w-100 bannerHd" >
        <div class="container-fluid w-75">
            <div class="">
                <div class="row">
                    <div class="col-12 mt-5">
                        <h3 class="text-white mt-5"> Tìm chỗ nghỉ tiếp theo</h3>
                        <h5 class="text-white">Tìm ưu đãi khách sạn, chỗ nghỉ dạng nhà và nhiều hơn nữa...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid w-75 ">
            <div class="row">
                <div class="col-12 mt-n5 searchBar">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <select class="form-select border-warning" aria-placeholder="Bạn muốn đi đâu?">
                                            <optgroup label="Điểm đến được ưu thích gần đây"></optgroup>
                                            <option value="" disabled selected style="display: none;">Bạn muốn đến đâu</option>
                                            <option value="1">Phú Quốc - Việt Nam</option>
                                            <option value="2">Hà Nội - Việt Nam</option>
                                            <option value="3">Sa Pa - Việt Nam</option>
                                            <option value="4">Đà Lạt - Việt Nam</option>
                                            <option value="5">Đà Nẵng - Việt Nam</option>
                                          </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <div class="input-group date " id="datetimepicker1" data-target-input="nearest">
                                            <input id="dt1" type="text" data-input class="form-control input-numeric input-date text-center border-warning" data-target="#datetimepicker1"/>
                                            <span class=" border-warning input-group-text spancal" data-toggle>
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                          </div>
                                    </div> 
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <div class="dropdown">
                                          <button class="btn btn-light border-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Người lớn - Trẻ em - Phòng
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <span class="mx-2">Người lớn</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="number-input">
                                                            <button class="btn btn-outline-warning" onclick="adjustNumber(event, this, -1)">-</button>
                                                            <input class="form-control w-50" type="number" id="adult-input" value="0" readonly>
                                                            <button class="btn btn-outline-primary"  onclick="adjustNumber(event, this, 1)">+</button>
                                                          </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <span class="mx-2">Trẻ em</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="number-input">
                                                            <button class="btn btn-outline-warning" onclick="adjustNumber(event, this, -1)">-</button>
                                                            <input class="form-control w-50" type="number" id="child-input" value="0" readonly>
                                                            <button class="btn btn-outline-primary"  onclick="adjustNumber(event, this, 1)">+</button>
                                                          </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <span class="mx-2">Phòng</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="number-input">
                                                            <button class="btn btn-outline-warning"  onclick="adjustNumber(event, this, -1)">-</button>
                                                            <input class="form-control w-50" type="number" id="room-input" value="0" readonly>
                                                            <button class="btn btn-outline-primary" onclick="adjustNumber(event, this, 1)">+</button>
                                                          </div>
                                                    </div>
                                                </div>
                                            </li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary ">Primary</button>
                                </div>
                            </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                  Tôi đang tìm nhà hoặc căn hộ nguyên căn
                                </label>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Tôi đi công tác
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header mb-0" id="panelsStayOpen-headingOne">
                            <button class="accordion-button tx-black fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                             <i class="fa-solid fa-circle-exclamation text-danger fa-2x mx-2"></i>Trợ giúp về virus corona (COVID-19)
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show mt-n5" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body mx-5" style="margin-top: -18px;">
                                Nhận lời khuyên mà bạn cần. Xem các hạn chế liên quan đến COVID-19 mới nhất trước khi du lịch. <br>

                                <a href="" class="link-primary "> Tìm hiểu thêm</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-12">
                    <div class="row mt-4">
                        <h3>Tìm kiếm gần đây của bạn</h3>
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <img src="./assets/images/HaNoi.png" alt="" class="recent-searches__image">
                                        </div>
                                        <div class="col mr-2">
                                            <div class="text-xs fw-bold  mb-1 fs-6 tx-black">
                                                Hà Nội</div>
                                            <div class="p b-0 font-weight-bold text-gray-800">26 tháng 5–8 tháng 6, 4 người</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row mt-3">
                        <div class="col-12">
                            <h3>Ưu đãi</h3>
                            <p>Khuyến mãi, giảm giác và ưu đãi đặc biệt dành riêng cho bạn</p>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-bg-image" style="background-image: url('/assets/images/preferential1.jpeg');">
                                  <div class="card-body card-body-tt">
                                    <h5 class="card-title text-white">Vi vu theo cách của bạn</h5>
                                    <p class="card-text">Tiết kiệm ít nhất 15% cho lưu trú <br> toàn cầu, từ nghỉ dưỡng đến phiêu lưu <br> hoang dã</p>
                                    <a href="#" class="btn btn-primary">Tìm Ưu Đãi Mùa Du Lịch</a>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-bg-image" style="background-image: url('/assets/images/preferential2.jpeg');">
                                  <div class="card-body card-body-tt">
                                    <h5 class="card-title text-white">Đổi gió một thời gian</h5>
                                    <p class="card-text">Tận hưởng sự tự do <br> với kỳ nghỉ  theo tháng trên <br> Booking.com</p>
                                    <a href="#" class="btn btn-primary">Khám phá kỳ nghỉ theo tháng</a>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="row mt-4">
                        <h3>Điểm đến đang thịnh hành</h3>
                        <p>Du khách tìm kiếm về Việt Nam cũng đặt chỗ ở những nơi này</p>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-bg-image-trend" style="background-image: url('/assets/images/UuDai/HoGuom.jpg');">
                                  <div class="card-body card-body-tt">
                                    <h3 class="card-title text-white">Hà Nội <img src="assets/images/logo.png" alt=""> </h3>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-bg-image-trend" style="background-image: url('/assets/images/UuDai/TPHCM.jpg');">
                                  <div class="card-body card-body-tt">
                                    <h3 class="card-title text-white">TP. Hồ Chí Minh <img src="assets/images/logo.png" alt=""> </h3>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-bg-image-trend" style="background-image: url('/assets/images/UuDai/3.jpg');">
                                  <div class="card-body card-body-tt">
                                    <h3 class="card-title text-white">Hội An <img src="assets/images/logo.png" alt=""> </h3>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-bg-image-trend" style="background-image: url('/assets/images/UuDai/5.jpg');">
                                  <div class="card-body card-body-tt">
                                    <h3 class="card-title text-white">Đà Nẵng <img src="assets/images/logo.png" alt=""> </h3>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-bg-image-trend" style="background-image: url('/assets/images/UuDai/4.jpg');">
                                  <div class="card-body card-body-tt">
                                    <h3 class="card-title text-white">Ninh Bình <img src="assets/images/logo.png" alt=""> </h3>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mt-4">
                        <div class="col-12">
                            <h3>Khám phá Việt Nam</h3>
                            <p>Các điểm đến phổ biến này có nhiều điều chờ đón bạn</p>
                        </div>
                        <div class="row">
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="p-0">
                                            <img src="assets/images/discovery/dalat.jpg" class="img-fluid img-discover">
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="content">
                                            <h6 class="fw-bold">Title</h6>
                                            <p>9 chỗ nghỉ</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="p-0">
                                            <img src="assets/images/discovery/thaprua.jpg" class="img-fluid img-discover">
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="content">
                                            <h6 class="fw-bold">Title</h6>
                                            <p>9 chỗ nghỉ</p>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="p-0">
                                                <img src="assets/images/discovery/tphcm.jpg" class="img-fluid img-discover">
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="content">
                                                <h6 class="fw-bold">Title</h6>
                                                <p>9 chỗ nghỉ</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="p-0">
                                                <img src="assets/images/discovery/hoabinh.jpg" class="img-fluid img-discover">
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="content">
                                                <h6 class="fw-bold">Title</h6>
                                                <p>9 chỗ nghỉ</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="p-0">
                                                <img src="assets/images/discovery/nhatrang.jpg" class="img-fluid img-discover">
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="content">
                                                <h6 class="fw-bold">Title</h6>
                                                <p>9 chỗ nghỉ</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="p-0 d-flex justify-content-center">
                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="content">
                                                <h6 class="fw-bold">Title</h6>
                                                <p>9 chỗ nghỉ</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                                  
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-4">
                            <h3>Tìm theo loại chỗ nghỉ</h3>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/1.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>9 chỗ nghỉ</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/2.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>9 chỗ nghỉ</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/3.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>9 chỗ nghỉ</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/4.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>9 chỗ nghỉ</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-4">
                            <h3>Tìm theo loại chỗ nghỉ</h3>
                            <p>Khám phá các điểm đến hàng đầu theo cách bạn thích ở Việt Nam</p>
                            <div class="col-12">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active custom-tab" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true"><i class="fa-solid fa-umbrella-beach "></i> Bãi biển</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab mx-3" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><i class="fa-solid fa-person-biking"></i> Thiên nhiên</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><i class="fa-solid fa-city mx-2"></i> Thành phố</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab mx-4" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><i class="fa-regular fa-heart mx-2"></i> Lãng mạn</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Thư giãn</a>
                                      </li>
                                  </ul>
                                
                                  <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                      <div id="carousel1" class="carousel slide" data-ride="carousel">
                                        <!-- Carousel slides -->
                                        <div class="container p-0">
                                            <div class="owl-carousel owl-theme">
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/dalat.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100 ">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="content">
                                                                    <h6 class="fw-bold">Title</h6>
                                                                    <p>9 chỗ nghỉ</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                            </div>
                                          </div>
                                
                                      </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                        <div id="carousel2" class="carousel slide" data-ride="carousel">
                                          <!-- Carousel slides -->
                                          <div class="container p-0">
                                            <div class="owl-carousel owl-theme">
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100 ">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="content">
                                                                    <h6 class="fw-bold">Title</h6>
                                                                    <p>9 chỗ nghỉ</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                            </div>
                                          </div>
                                  
                                          <!-- Carousel navigation buttons -->
                                        </div>
                                      </div>

                                      <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                        <div id="carousel6" class="carousel slide" data-ride="carousel">
                                          <!-- Carousel slides -->
                                          <div class="container p-0">
                                            <div class="owl-carousel owl-theme">
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100 ">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="content">
                                                                    <h6 class="fw-bold">Title</h6>
                                                                    <p>9 chỗ nghỉ</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                            </div>
                                          </div>
                                  
                                          <!-- Carousel navigation buttons -->
                                        </div>
                                      </div>
                                                             
                                    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                        <div id="carousel4" class="carousel slide" data-ride="carousel">
                                          <!-- Carousel slides -->
                                          <div class="container p-0">
                                            <div class="owl-carousel owl-theme">
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100 ">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                              <div class="item">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="w-100">
                                                            <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                              </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="content">
                                                                    <h6 class="fw-bold">Title</h6>
                                                                    <p>9 chỗ nghỉ</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                            </div>
                                          </div>
                                  
                                          <!-- Carousel navigation buttons -->
                                        </div>
                                      </div>

                                    <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                                        <!-- Carousel content for Tab 4 -->
                                        <div id="carousel5" class="carousel slide" data-ride="carousel">
                                            <!-- Carousel slides -->
                                            <div class="container p-0">
                                                <div class="owl-carousel owl-theme">
                                                  <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                                  <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                                  <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100 ">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                                  <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                                  <div class="item">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="w-100">
                                                                <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                            </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="content">
                                                                <h6 class="fw-bold">Title</h6>
                                                                <p>9 chỗ nghỉ</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                  </div>
                                                    <div class="item">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                <div class="w-100">
                                                                    <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                                </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="content">
                                                                        <h6 class="fw-bold">Title</h6>
                                                                        <p>9 chỗ nghỉ</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="item">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                <div class="w-100">
                                                                    <img src="assets/images/discovery/phuquoc.jpg" class="img-discover">
                                                                </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                <div class="content">
                                                                    <h6 class="fw-bold">Title</h6>
                                                                    <p>9 chỗ nghỉ</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                      </div>
                                                </div>
                                              </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-n5">
                            <h3>Nhà ở mà khách yêu thích</h3>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/1.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>Cheval Three Quays at The Tower of London <br>
                                            Bắt đầu từ <strong>VND 23.033.024</strong>
                                        </p>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="point">9.5</div>
                                            </div>
                                            <div class="col-10">
                                                <p> Xuất sắc * 586 đánh giá</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/1.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>Cheval Three Quays at The Tower of London <br>
                                            Bắt đầu từ <strong>VND 23.033.024</strong>
                                        </p>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="point">9.5</div>
                                            </div>
                                            <div class="col-10">
                                                <p> Xuất sắc * 586 đánh giá</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/1.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>Cheval Three Quays at The Tower of London <br>
                                            Bắt đầu từ <strong>VND 23.033.024</strong>
                                        </p>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="point">9.5</div>
                                            </div>
                                            <div class="col-10">
                                                <p> Xuất sắc * 586 đánh giá</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="p-0">
                                        <img src="assets/images/RestPlace/1.jpeg" class="img-fluid img-rest">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="content">
                                        <h6 class="fw-bold">Title</h6>
                                        <p>Cheval Three Quays at The Tower of London <br>
                                            Bắt đầu từ <strong>VND 23.033.024</strong>
                                        </p>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="point">9.5</div>
                                            </div>
                                            <div class="col-10">
                                                <p> Xuất sắc * 586 đánh giá</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="container p-0 mt-5">
                            <div class="banner">
                              <div class="row">
                                <div class="col-1"></div>
                                <div class="col-5">
                                  <div class="banner-text">
                                    <h2 style="margin-top: 0px;">Tìm nhà <br>
                                    cho chuyến đi tới</h2>
                                    <a href=""><button class="btn btn-discovery">Khám phá chỗ nghỉ như ở nhà</button></a>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="banner-image mx-5 mt-2">
                                    <img src="assets/images/cat.png" alt="Banner Image">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="row mt-5">
                            <h3>Tìm theo loại chỗ nghỉ</h3>
                            <p>Khám phá các điểm đến hàng đầu theo cách bạn thích ở Việt Nam</p>
                            <div class="col-12">
                                <ul class="nav nav-tabs border-0 p-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active custom-tab" id="tab8-tab" data-toggle="tab" href="#tab8" role="tab" aria-controls="tab8" aria-selected="true"><i class="fa-solid fa-umbrella-beach "></i> Khu vực</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab mx-3" id="tab9-tab" data-toggle="tab" href="#tab9" role="tab" aria-controls="tab9" aria-selected="false"><i class="fa-solid fa-person-biking"></i> Thành phố</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link custom-tab" id="tab10-tab" data-toggle="tab" href="#tab10" role="tab" aria-controls="tab10" aria-selected="false"><i class="fa-solid fa-city mx-2"></i> Địa điểm được quan tâm</a>
                                      </li>
                                  </ul>
                                
                                  <div class="tab-content mt-4">
                                    <div class="tab-pane fade show active" id="tab8" role="tabpanel" aria-labelledby="tab8-tab">
                                      <div id="carousel8" class="carousel slide" data-ride="carousel">
                                        <!-- Carousel slides -->
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="content">
                                                    <h6 class="fw-bold">Title</h6>
                                                    <p>9 chỗ nghỉ</p>
                                                </div>
                                            </div>
                                        </div>
                                      </div>

                                      </div>

                                      <div class="tab-pane fade" id="tab9" role="tabpanel" aria-labelledby="tab9-tab">
                                        <div id="carousel9" class="carousel slide" data-ride="carousel">
                                          <!-- Carousel slides -->
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="tab10" role="tabpanel" aria-labelledby="tab10-tab">
                                            <div id="carousel10" class="carousel slide" data-ride="carousel">
                                              <!-- Carousel slides -->
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="content">
                                                            <h6 class="fw-bold">Title</h6>
                                                            <p>9 chỗ nghỉ</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                </div>
                        </div>


                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php 


?>

</body>
</html>