<?php
include_once '../includes/dbh.php';
session_start();
if(!isset($_SESSION['admin'])){
	header("location:login.html?Action_Needed");
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >

    <!---------fontawesome css----------->
    <link rel="stylesheet" href="../fontawesome/css/all.css">

    <!---------custom css----------->
    <link rel="stylesheet" href="css/adminStyles.css">
    <link rel="stylesheet" href="css/settings.css">

    <title>SETTINGS | Manage Users Entry Page</title>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jQuery.js" ></script>
    <script src="../js/popper.js" ></script>
    <script src="../js/bootstrap.js"></script>

    <!-- Optional JavaScript -->

</head>

<body>

<!-- -------------------------Navigation bar starts--------------------- -->
<nav class="navbar navbar-expand-lg navbar-light ">
    <button class="navbar-toggler ml-auto bg-light" type="button" data-toggle="collapse" data-target="#mynav"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynav">
        <div class="container-fluid">
            <div class="row">

                <!---- -------sidebar---------------->
                <div id="sidebar" class=" col-xl-2  col-md-3 fixed-top  ">
                    <div class=" py-4 border-bottom text-center ">
                        <span class="text-white ">Admin Panel</span>
                    </div>

                    <div class="navbar-nav flex-column sidebar-nav">

                        <a class="nav-item nav-link" href="index.php"> <i class="fas fa-home"></i> Dashboard</a>
                        <a class="nav-item nav-link" href="library.php"><i class="fas fa-school"></i> Library</a>
                        <a class="nav-item nav-link" href="#new-event"><i class="fas fa-plus"></i> Add Event</a>
                    </div>

                </div>
                <!--------------- sidebar ends------------->

                <!--------------- top bar ------------->
                <div id="top-bar" class="col-xl-10 col-md-9 ml-auto fixed-top pt-2 d-block">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="m-0">DASHBOARD</h4>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group ">
                                <input type="search" class="form-control" placeholder="search">
                                <div class=" btn btn-outline-success">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="navbar-nav float-md-right">
                                <a class="nav-item nav-link icon-parent"> <i class="fas fa-comments icon-bullet"></i> </a>
                                <a class="nav-item nav-link icon-parent"> <i class="fas fa-bell icon-bullet mr-3"></i> </a>
                                <a class="nav-item nav-link" href="#" data-toggle="tooltip" title="<h6>Sign Out</h6>"> 
                                 <i class="fas fa-sign-out-alt text-danger"></i> </a>

                            </div>

                        </div>
                    </div>

                </div>
                <!--------------- top-bar ends------------->

            </div>
        </div>
    </div>
</nav>
<!-- -------------------------Navigation bar ends--------------------- -->

<section class="section-fluid">
	<div class="container-fluid">
		<div class="row pt-4">
			<div class="col-xl-10 col-lg-9 ml-auto">
				<div>
					<h2 class="text-center text-info mb-4">Manage Users Entry Page</h2>
					<p style="font-size: 18px; color: rgba(0,0,0,.7);">here you can manage the 
						users page by choosing different ways you want
					 the user to see the page. You can also add or modify school events, and school motion.
					 <br>
					 Please provide all needed information when you want to add a new event.
					</p>
				</div>

				<div class="mt-4">
					<h3>Last Uploaded Events</h3>
                    <div class="row no-gutters">
                       <?php
                        $sql="SELECT * FROM school_events ORDER BY event_id DESC LIMIT 6";
                        $query=mysqli_query($conn,$sql);

                        while ($row=mysqli_fetch_assoc($query)) {
                            $event_title=$row['event_title'];
                            $event_descr=$row['event_descr'];
                            $event_img=$row['event_img'];
                            

                        ?>
                        <div class="col-xl-4 col-md-6">

                            <div class="event_wrapper">
                                <div class="event_caption">
                                    <h3><?php echo $event_title; ?></h3>
                                    <p><?php echo $event_descr; ?></p>
                                </div>
                                <div class="event_img">
                                    <img src="../img/<?php echo $event_img; ?>">
                                </div>
                                
                            </div>
                            
                        </div>
                        <?php
                        }
                        ?>

                        
                    </div>

				</div>

				<div id="new-event" class="mt-4">
					<h3 class="text-info mb-4 pb-4">Add New Event</h3>
					<form class="form clearfix" method="post" action="includes/manage_web.php" enctype="multipart/form-data">
						<div class="row mb-4">
							<div class="col-md-6 m-auto">

								<div class="form-group">
									<label for="title"><h5>Event Title</h5></label>
									<input id="title" class="form-control" type="text" name="title" placeholder="title">
								</div>

								<div class="form-group">
									<label for="description"><h5>Description</h5></label>
									<span class="span">
									(describe this event in few words)</span>
									<textarea  id="description" class="form-control" name="description"
									 placeholder="description"></textarea>
								</div>
								<div class="form-group">
									<label for="cover"><h5>Event Cover Image</h5></label>
									<input id="cover" class="form-control" type="file" name="event_cover">
									
								</div>

								<div class="form-group">
									<button type="submit " class="btn btn-primary btn-block" name="submit_event">
                                        Add Event
                                    </button>
								</div>

							</div>

						</div>

					</form>
				</div>

				
			</div>


		</div>
	</div>
</section>

</body>
</html>
