<?php
    session_start();
    if (session_id() && isset($_SESSION['user_id'])) {
      header("Location: /");
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./src/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./src/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./src/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./src/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./src/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="./src/assets/css/main.css" rel="stylesheet">

</head>

<body class="contact-page">

  <?php
      require_once 'header.php';
  ?>

  <main class="main">

    <!-- Contact Section -->
    <section id="contact" class="contact section" style="min-height: 80vh;">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center gy-4">

            <div class="pricing col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="pricing-item">
                    <h3>Login</h3>
                    <form action="function/login.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-12">
                                <input type="text" id="username" name="username" required  class="form-control" placeholder="Your Name">
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="password" name="password"  class="form-control" placeholder="Your password" required="" style="-webkit-text-security: disc;">
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">successfully!</div>

                                <button type="submit" name="login">Login</button>

                            </div>

                        </div>
                    </form>
                </div>
                <div class="text-center">
                    <br>
                    <a href="register.php">Register new account</a>
                </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /Contact Section -->

  </main>
  <?php
      require_once 'footer.php';
  ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="./src/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="./src/assets/vendor/php-email-form/validate.js"></script> -->
  <script src="./src/assets/vendor/aos/aos.js"></script>
  <script src="./src/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./src/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="./src/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./src/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="./src/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="./src/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="./src/assets/js/main.js"></script>

</body>

</html>

