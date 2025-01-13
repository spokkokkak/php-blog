<?php
  session_start();
  require_once './src/config/database.php';

  // if (!isset($_SESSION['user_id'])) {
  //     echo "Please log in to view articles.";
  //     exit;
  // }

  // Fetch the list of articles from the database
  try {
      $stmt = $conn->prepare("SELECT id, title, content, created_at FROM articles ORDER BY created_at DESC");
      $stmt->execute();
      $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Error fetching articles: " . $e->getMessage();
      exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog</title>
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

<body class="blog-page">

  <?php
      require_once 'header.php';
  ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Blog</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->


    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">

            <div class="container">

              <div class="row gy-4">

                <div class="col-lg-12">
                  <?php foreach ($articles as $index => $article): ?>
                    <article>
                      <div class="post-img">
                        <img src="./src/assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                      </div>

                      <h2 class="title">
                        <a href="blog-details.php?article_id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a>
                      </h2>

                      <div class="meta-top">
                        <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-person"></i> Nuttakan Praew</a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2022-01-01"><?= htmlspecialchars($article['created_at']) ?></time></a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> 0 Comments</a></li>
                        </ul>
                      </div>

                      <div class="content">
                        <p>
                          <?= htmlspecialchars($article['content']) ?>
                        </p>

                        <div class="read-more">
                          <a href="blog-details.php?article_id=<?= $article['id'] ?>">Read More</a>
                        </div>
                      </div>

                    </article>
                  <?php endforeach; ?>
                </div><!-- End post list item -->
              </div><!-- End blog posts list -->

            </div>

          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
          <section id="blog-pagination" class="blog-pagination section">

            <div class="container">
              <div class="d-flex justify-content-center">
                <ul>
                  <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#" class="active">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li>...</li>
                  <li><a href="#">10</a></li>
                  <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>

          </section><!-- /Blog Pagination Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>

              <div class="post-item">
                <img src="./src/assets/img/blog/blog-recent-1.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4>Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="./src/assets/img/blog/blog-recent-2.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4>Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="./src/assets/img/blog/blog-recent-3.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4>Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="./src/assets/img/blog/blog-recent-4.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4>Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="./src/assets/img/blog/blog-recent-5.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4>Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>

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
  <script src="./src/assets/vendor/php-email-form/validate.js"></script>
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