<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>AutoMotors</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    </head>
    
    <body>
    
    <?php 
    
    include ('load.php');
    
    
    include('header.php'); ?>


    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Read our <em>Blog</em></h2>
                        <p>Ut consectetur, metus sit amet aliquet placerat, enim est ultricies ligula</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <section class='tabs-content'>
                      <article>
                        <img src="assets/images/blog-image-1-940x460.jpg" alt="">
                        <h4>Lorem ipsum dolor sit amet, consectetur adipisicing.</h4>

                        <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i>  15 comments</p>

                        <p>Phasellus convallis mauris sed elementum vulputate. Donec posuere leo sed dui eleifend hendrerit. Sed suscipit suscipit erat, sed vehicula ligula. Aliquam ut sem fermentum sem tincidunt lacinia gravida aliquam nunc. Morbi quis erat imperdiet, molestie nunc ut, accumsan diam.</p>
                        <div class="main-button">
                            <a href="blog-details.html">Continue Reading</a>
                        </div>
                      </article>

                      <br>
                      <br>

                      <article>
                        <img src="assets/images/blog-image-2-940x460.jpg" alt="">
                        <h4>Aspernatur excepturi magni, placeat rerum nobis magnam libero! Soluta.</h4>
                        <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i>  15 comments</p>
                        <p>Integer dapibus, est vel dapibus mattis, sem mauris luctus leo, ac pulvinar quam tortor a velit. Praesent ultrices erat ante, in ultricies augue ultricies faucibus. Nam tellus nibh, ullamcorper at mattis non, rhoncus sed massa. Cras quis pulvinar eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                        <div class="main-button">
                            <a href="blog-details.html">Continue Reading</a>
                        </div>
                      </article>

                      <br>
                      <br>

                      <article>
                        <img src="assets/images/blog-image-3-940x460.jpg" alt="">
                        <h4>Sunt hic recusandae vitae explicabo quidem laudantium corrupti non adipisci nihil.</h4>
                        <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i>  15 comments</p>
                        <p>Fusce laoreet malesuada rhoncus. Donec ultricies diam tortor, id auctor neque posuere sit amet. Aliquam pharetra, augue vel cursus porta, nisi tortor vulputate sapien, id scelerisque felis magna id felis. Proin neque metus, pellentesque pharetra semper vel, accumsan a neque.</p>
                        <div class="main-button">
                            <a href="blog-details.html">Continue Reading</a>
                        </div>
                      </article>
                    </section>
                </div>

                <div class="col-lg-4">
                    <h5 class="h5">Search</h5>
                    
                    <div class="contact-form">
                        <form id="search_form" name="gs" method="GET" action="#">
                          <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                        </form>
                    </div>

                    <h5 class="h5">Recent posts</h5>

                    <ul>
                        <li>
                            <p><a href="blog-details.html">Dolorum corporis ullam, reiciendis inventore est repudiandae</a></p>
                            <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                        </li>

                        <li><br></li>

                        <li>
                            <p><a href="blog-details.html">Culpa ab quasi in rerum dolorum impedit expedita</a></p>
                            <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                        </li>

                        <li><br></li>

                        <li>
                          <p><a href="blog-details.html">Explicabo soluta corrupti dolor doloribus optio dolorum</a></p>

                          <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->

    <?php   include("footer.php"); ?>


    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>