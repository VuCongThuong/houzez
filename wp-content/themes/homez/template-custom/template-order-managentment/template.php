<?php
$head = <<<EDF
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
                <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script>
            $( function() {
              $( "#start-date, #end-date" ).datepicker({
                format: 'dd-mm-yyyy',
                constrainInput: false
              });
            });
            </script>
              <title>Quản lý Order</title>
          </head>
        EDF;

$footer = <<<EDF
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
EDF;