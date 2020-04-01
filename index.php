<?php 
include_once 'includes/dbh.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <!-- pace CSS  for pre loader -->
    <link rel="stylesheet" type="text/css" href="css/pace.css">

    <!-- Google Poppins Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">

    <!-------------- animate css------------->
    <link rel="stylesheet " href="css/animate.css">


    <!----------- owl carousel CSS  --------->
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!--------------Font awesome css ---------------->
    <link rel="stylesheet" href="fontawesome/css/all.css">

    <!-----------------Morphext css for text rotation----------------->
    <link rel="stylesheet" href="css/morphext.css">

    <!----------------magnific pop up for gallery---------------->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!----------- custom CSS  --------->
    <link rel="stylesheet" type="text/css" href="css/style.css">


    <title>University Administration System</title>
</head>

<body data-spy="scroll" data-target="#navbarNavAltMarkup" data-offset="0">

<!-------------------- Pre loader starts ----------------->
<div class="pre-loader"></div>

<!-------------------- Pre loader ends ----------------->


<!------------ header starts-------------->

<header id="header_wrapper">



    <!------------ title &login form starts-------------->
    <div class="container">
        <div class="row ">

            <div class="outer-wrapper">

                    <div class="inner-wrapper">
                        <h1 ><span class="hero-title">University</span> <span class="hero-title definer">Administration </span>
                            <br>
                            <span class="hero-title">System</span>
                        </h1>
                        <div class="icon_wrapper">
                            <figure>
                                <i class="fas fa-angle-double-right animated infinite fadeInRight"></i>
                            </figure>
                           <span> We have School of
                               <span id="rotating-text"> Software,Civil,Electronic,Mechatronics,Mechanical </span>
                               Engineering</span>
                        </div>
                    </div>

            </div>





        </div>
    </div>
    <!------------  title & login form ends------------->
    
    
    <!------------  slider starts-------------->
    <div id="slider">
        <div class="owl-carousel">

            <img src="img/banner1.jpg">

            <img src="img/banner2.jpg">

            <img src="img/banner3.jpg">

            <img src="img/banner4.jpg">


        </div>

    </div>
    <!------------  slider ends-------------->

    <!-----------navigation bar starts--------------->

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="img/navbar-logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="#header_wrapper">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#about-us">About Us</a>
                <a class="nav-item nav-link" href="#events">Events</a>
                <a class="nav-item nav-link" href="#our-team">Our Team</a>
                <a class="nav-item nav-link" href="#contact">Contact</a>
                <button class="nav-item nav-link btn btn-link btn-control"><a href="login.html">Sign In</a></button>
            </div>
        </div>
    </nav>

    <!------------ navigation bar ends ------------>



</header>

<!------------  header ends-------------->


<!------------  about us starts-------------->
<section id="about-us" class="section_wrapper">
    <div class="container">
        <div class="section_title">
            <h2 class="text-reveal"> About Us</h2>
        </div>
        <div class="row">
            <div class="col-md-7">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                    id arcu iaculis, rutrum nunc ac, pellentesque risus. Vivamus
                    hendrerit ligula nisl, at venenatis mi cursus et. Sed vitae ante
                    quis tellus iaculis placerat quis nec urna. Morbi eget metus
                    in odio cursus faucibus. Praesent metus diam, finibus eget
                    turpis in, cursus accumsan eros. Morbi euismod metus arcu,
                    quis venenatis massa ultrices eu. In sagittis consequat lectus
                    ac venenatis. Praesent in ipsum ut libero lacinia eleifend.
                    Nunc vitae porttitor ante, ut vehicula velit. In varius massa
                    ut scelerisque commodo.
                </p>
                <div >
                    <a class="btn" href="#contact">
                       CONTACT US
                    </a>
                </div>

            </div>

            <div class="col-md-5">
                <img src="img/img-07.jpg">
            </div>
        </div>
    </div>

</section>
<!------------ About us ends-------------->


<!------------ Events starts-------------->
<section id="events" class="section_wrapper">
    <div class="container">
        <div class="section_title">
            <h2 class="text-reveal">Upcoming Events </h2>
        </div>
    </div>

    <div class="gallery">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <?php
                $sql = "SELECT * FROM school_events ORDER BY event_id DESC LIMIT 3"; 
                $query=mysqli_query($conn,$sql);

                while ($row=mysqli_fetch_assoc($query)) {
                    $event_title=$row['event_title'];
                    $event_descr=$row['event_descr'];
                    $event_img=$row['event_img'];
                    ?>

                    <div class="col-md-4">
                    <a href="img/<?php echo $event_img; ?>">
                        <div class="gallery-caption">
                            <h3 class="text-reveal"><?php echo $event_title; ?></h3>
                            <p><?php echo $event_descr; ?></p>
                        </div>

                        <div class="event-image">
                            <img src="img/<?php echo $event_img; ?>">
                        </div>
                    </a>
                </div>

                <?php
                }
                ?>
                
                
            </div>
        </div>
    </div>

</section>

<!------------Events ends-------------->

<!------------our team starts -------------->
<section id="our-team" class="section_wrapper">
    <div class="container">
        <div class="section_title">
            <h2 class="text-reveal">Support Team</h2>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM team LIMIT 4";
            $query= mysqli_query($conn,$sql);

            while ($row=mysqli_fetch_assoc($query)) {
                $tName=$row['name'];
                $tPosition=$row['position'];
                $timg=$row['team_img'];
                ?>
            
            <div class="col-md-6 col-xl-3">

                <div class="member">

                    <h4><?php echo $tName;?></h4>
                    <h5><?php echo $tPosition;?></h5>

                    <div class="member-image_wrapper">

                        <div class="social-media">

                            <a href="#">
                                <i class="fab fa-facebook"></i>
                            </a>

                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>

                        </div>

                        <div class="member-image">
                            <img src="img/<?php echo $timg;?>">
                        </div>

                    </div>

                </div>

            </div>
            <?php
            }
            ?>

        </div>

    </div>

</section>
<!------------our team ends------------->

<!------------contact  starts-------------->
<section id="contact" class="section_wrapper">
    <div class="container">

        <div class="section_title">
            <h2 class="text-reveal">Contact</h2>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h4>Our Address</h4>
                <address>
                    No.4 Section 2 North Jianshe Road<br>
                    Chengdu Sichuan China

                </address>

                <div>
                    <figure>
                        <i class="fab fa-instagram"> <a href="#">universitysystem</a> </i>
                    </figure>
                    <figure>
                        <i class="fab fa-facebook"> <a href="#">UASStudent</a> </i>
                    </figure>
                    <figure>
                        <i class="fab fa-twitter"> <a href="#">UAS</a> </i>
                    </figure>
                </div>
            </div>

            <div class="col-md-7">

                <h4>Send A Message to Our Team</h4>

                <form class="form clearfix" method="post">

                    <div class="row">

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Your Name" required>
                            </div>

                        </div>
                        <div class="col-md-6 form-group">

                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="message">Message</label>

                                <textarea id="message" class="form-control" name="message" placeholder="Your Message"
                                          rows="4" required></textarea>
                            </div>

                        </div>



                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" name="submit" class="btn btn-secondary float-right">Send a Message</button>
                    </div>

                </form>
            </div>

        </div>



    </div>
</section>
<!------------contact ends-------------->

<!-----------footer starts-------------->
<footer>
    <div class="container">
            <div class="footer-wrapper">
                <span>&copy;Copyright 2020-01, All Rights Reserved </span>
            </div>


    </div>
</footer>
<!------------footer ends-------------->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jQuery.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>


<!-- pace js -->
<script src="js/pace.js"></script>

<!----------- owl carousel  --------->
<script src="js/owl.carousel.min.js"></script>

<!----------- morphext js --------->
<script src="js/morphext.js"></script>

<!----------- magnific popup js --------->
<script src="js/jquery.magnific-popup.js"></script>

<!-------custom java script ------->
<script src="js/script.js"></script>

</body>
</html>
