<?php 
session_start();
include_once '../includes/dbh.php';


if(!isset($_SESSION['admin'])){
	header("location:login.html?Action_needed");
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

    <title>Admin | Dashboard</title>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jQuery.js" ></script>
    <script src="../js/popper.js" ></script>
    <script src="../js/bootstrap.js"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" src="js/adminScript.js"></script>

</head>
 
<body>

<nav class="navbar navbar-expand-lg navbar-light ">
    <button class="navbar-toggler ml-auto bg-light" type="button" data-toggle="collapse" data-target="#myNav"
            aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNav">
        <div class="container-fluid">
            <div class="row">

                <!---- -------sidebar---------------->
                <div id="sidebar" class=" col-xl-2  col-lg-3 fixed-top  ">
                    <div class=" py-4 border-bottom text-center ">
                        <span class="text-white ">Admin Panel</span>
                    </div>

                    <div class="navbar-nav flex-column sidebar-nav">

                        <a class="nav-item nav-link" href="index.php"> <i class="fas fa-home"></i> Dashboard</a>
                        <a class="nav-item nav-link" href="#student_list"><i class="fas fa-users"></i> Students</a>
                        <a class="nav-item nav-link" href="#course"><i class="fas fa-book"></i> Courses</a>
                        <a class="nav-item nav-link" href="library.php"><i class="fas fa-school"></i> Library</a>
                        <a class="nav-item nav-link" href="#team"><i class="fab fa-teamspeak"></i> Team</a>
                        <a class="nav-item nav-link" href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
                    </div>

                </div>
                <!--------------- sidebar ends------------->

                <!--------------- top bar ------------->
                <div id="top-bar" class="col-xl-10 col-lg-9 ml-auto fixed-top pt-2 d-block">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4 class="m-0">DASHBOARD</h4>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group ">
                                <input type="search" class="form-control" placeholder="search">
                                <div class=" btn btn-outline-success">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="navbar-nav float-lg-right">
                                <a class="nav-item nav-link icon-parent"> <i class="fas fa-comments icon-bullet"></i> </a>
                                <a class="nav-item nav-link icon-parent"> <i class="fas fa-bell icon-bullet mr-3"></i> </a>
                                <a class="nav-item nav-link" href="includes/log_out.php" data-toggle="tooltip" title="<h6>Sign Out</h6>"> 
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

<!-------------------------cards starts here-------------------------->
<section class="section-fluid">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xl-10 col-lg-9 ml-auto ">
                <div class="row pt-lg-3 mt-lg-4">

                    <div class="col-sm-6 col-md-4">
                        <div class="cards">

                        	<div class="cards-icon">
                        		<i class="fas fa-users text-info"></i>
                        	</div>

                        	<div class="cards-title">
                        		<?php 
                        		$sql= "SELECT * FROM personal_info";
                        		$query=mysqli_query($conn,$sql);
                        		$allStudents=mysqli_num_rows($query);
                        		?>
                        		<h4>Students</h4>
                        		<span><?php echo $allStudents;?></span>
                        	</div>
                        	
                        	
                        	
                        </div>
                        <div class="update-status">
                        	<i class="fas fa-sync"></i>
                        	<span>Updated now</span>                       	
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                         <div class="cards">

                         	<div class="cards-icon">
                        		<i class="fas fa-shopping-cart text-warning"> </i>
                        	</div>

                        	<div class="cards-title">
                        		<?php
                        		$sql= "SELECT * FROM book_order WHERE order_status='borrowed'";
                        		$query=mysqli_query($conn,$sql);
                        		$allBooks_out=mysqli_num_rows($query);
                        		?>
                        		<h4>Books Out</h4>
                        		<span><?php echo $allBooks_out;?></span>                        		
                        	</div>
	
                        </div>

                        <div class="update-status">
                        	<i class="fas fa-sync"></i>
                        	<span>Updated now</span>                       	
                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="cards">

                        	<div class="cards-icon">
                        		<i class="fas fa-chart-line text-danger"></i>
                        	</div>

                        	<div class="cards-title">
                        		<h4>Visitors</h4>
                        		<span>...</span>                        		
                        	</div>
                        	
                        	
                        	
                        </div>

                        <div class="update-status">
                        	<i class="fas fa-sync"></i>
                        	<span>Updated now</span>                       	
                        </div>

					</div>
					
					<div class="col-sm-6 col-md-4">
                        <div class="cards">

                        	<div class="cards-icon">
                        		<i class="fas fa-table text-success"></i>
                        	</div>

                        	<div class="cards-title">
								<?php
								$sql="SELECT * FROM selected_course GROUP BY student_id";
								$query=mysqli_query($conn,$sql);
								$tables=mysqli_num_rows($query);
								?>
                        		<h4>Tables</h4>
                        		<span><?php echo $tables; ?></span>                        		
                        	</div>
                        	
                        	
                        	
                        </div>

                        <div class="update-status">
                        	<i class="fas fa-sync"></i>
                        	<span>Updated now</span>                       	
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
<!-------------------------cards ends here-------------------------->


<!-------------------------section to display students-------------------------->
<section id= "student_list" class="section-fluid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-10 col-lg-9 ml-auto">

				<div class="display-list">
					<h3 class="mt-2">List of Students </h3>
					<div class="add_info col-md-12">
						<div class="add_btn btn-info">
							<a href="includes/student.php">
								<i class="fas fa-plus">
									<span> add Student</span>
								</i>
							</a>
						</div>
						
						
					</div>
					<table class="table table-hover table-bordered" >
						<caption class="text-center">ALL STUDENTS</caption>
						<thead>
							<tr>
								<th>Student ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Passport</th>
								<th>Country</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Gender</th>
								<th>#</th>
								
								
							</tr>
						</thead>
						<tbody>
							<?php 

							$sql = "SELECT * FROM personal_info";
							$query = mysqli_query($conn,$sql);

							$rows_number=mysqli_num_rows($query);

							$result_per_page=3;

							$number_of_page=ceil($rows_number/$result_per_page);

							if (!isset($_GET['std_page'])) {
								$page=1;
							}
							else{
								$page=$_GET['std_page'];
							}

							$starting_num=($page-1)*$result_per_page;

							$sql = "SELECT * FROM personal_info LIMIT $starting_num,$result_per_page";
							$query=mysqli_query($conn,$sql);

							$result_shown=$starting_num+mysqli_num_rows($query);

							echo "showing result from ".$starting_num." to ".$result_shown;

							while ($row=mysqli_fetch_assoc($query)) {
								$student_id=$row['student_id'];
								$fname=$row['first_name'];
								$lname=$row['last_name'];
								$passport=$row['passport'];
								$country=$row['nationality'];
								$email=$row['email'];
								$pnumber=$row['phone_number'];
								$gender=$row['gender'];
								
							
							?>
							<tr>
								<td><?php echo $student_id; ?></td>
								<td><?php echo $fname; ?></td>
								<td><?php echo $lname; ?></td>
								<td><?php echo $passport; ?></td>
								<td><?php echo $country; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $pnumber; ?></td>
								<td><?php echo $gender; ?></td>
								<td>
									<a href="includes/student.php?id=<?php echo $student_id;?>" >
										<i class="fas fa-edit text-info"></i>
									</a>
								</td>
								
							</tr>

						<?php }?>
						</tbody>
						
					</table>

					<!---------------------------pagination for students table------------------->
					<nav>
						<ul class="pagination justify-content-center">
							<li class="page-item">
								<a class="page-link">&laquo;</a>
							</li>
							<?php 
							for($i=1;$i<=$number_of_page;$i++){?>
								<li class="page-item ">
									<a class="page-link" href="index.php?std_page=<?php echo $i;?>"><span>
										<?php echo $i;?>
										
									</span></a>
								</li>

							<?php
							}
							?>
							
							
							</li>
							<li class="page-item ">
								<a class="page-link">&raquo;</a>
							</li>
							
						</ul>
					</nav>
					<!---------------------------pagination for students table ends------------------->
				
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</section>
<!-------------------------students section ends here -------------------------->

<!-------------------------course section starts course list-------------------------->
<section id="course" class="section-fluid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-10 col-lg-9 ml-auto">
				<div>
					<h2  class="text-center mb-4">COURSES</h2>
				</div>
				<div class="row">
					<!-------------------------course starts-------------------------->
					<div class="col-xl-6 text-center">
						<h3 class="">Course List</h3>

						<div class=" add_info col-md-12 ">
							<div class="add_btn btn-info mb-2">
								<a href="includes/modify_course.php">
									<i class="fas fa-plus">
										<span > add Course</span>
									</i>
								</a>

							</div>
							<div class="manage_table btn-success mb-2">
								<a href="includes/modify_course.php">
									<i class="fas fa-plus">
										<span > Manage Tables</span>
									</i>
								</a>

							</div>
							
						</div>

						<?php 
						$sql="SELECT * FROM course_list";
						$query=mysqli_query($conn,$sql);

						$rows_number=mysqli_num_rows($query);
						$result_per_page=5;
						$number_of_page=ceil($rows_number/$result_per_page);

						if(isset($_GET['course_page'])){
							$page=$_GET['course_page'];

						}
						else{
							$page=1;
						}

						$starting_num=($page-1)*$result_per_page;
						$sql="SELECT * FROM course_list LIMIT $starting_num,$result_per_page";
						$query=mysqli_query($conn,$sql);

						$result_shown=$starting_num+mysqli_num_rows($query);

						

						?>
						<table class="table table-dark table-bordered text-center">
							<thead>
								<tr>
									<th>Course ID</th>
									<th>Course Name</th>
									<th>Credit</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<?php
								echo "showing result from ".$starting_num." to ".$result_shown;
								while ($row=mysqli_fetch_assoc($query)) {
									$course_id=$row['course_id'];
									$course_name=$row['course_name'];
									$credit=$row['credit'];
									
								
								?>
								<tr>
									<td><?php echo $course_id; ?></td>
									<td><?php echo $course_name; ?></td>
									<td><?php echo $credit; ?></td>
									<td>
										<a href="includes/modify_course.php?id=<?php echo $course_id?>">
											<i class="fas fa-edit"></i>
										</a>
									</td>
								</tr>
								<?php
								}?>
							</tbody>
						</table>

						<!---------------------------pagination for course table------------------->
						<nav>
							<ul class="pagination justify-content-center">
								<li class="page-item">
									<a class="page-link">&laquo;</a>
								</li>
								<?php 
								for($i=1;$i<=$number_of_page;$i++){?>

									<li class="page-item ">
										<a class="page-link" href="index.php?course_page=<?php echo $i;?>">
											<span><?php echo $i;?></span>
										</a>
									</li>

								<?php
								}
								?>
							
								<li class="page-item ">
									<a class="page-link">&raquo;</a>
								</li>
								
							</ul>
						</nav>
						<!---------------------------pagination for course table ends------------------->
					</div>
		<!-------------------------course ends-------------------------->

			<!-------------------------result starts-------------------------->

					<div class="col-xl-6 ">
						<h3 id="results" class="text-center add_info">Publish Student Results</h3>
						<p></p>
						<form class="form " method="post" action="includes/publish_result.php">
							<div class="row ">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Student Id</label>
										<input class="form-control" type="text" name="std_id">
									</div>
									<div class="form-group">
										<label>Course ID</label>
										<input class="form-control"  type="text" name="course_id">
									</div>
									<div class="form-group">
										<label>Score</label>
										<input class="form-control"  type="number" name="std_score">
									</div>
								</div>


								<div class="col-sm-6">
									<div class="form-group">
										<label>Course Credit</label>
										<input class="form-control"  type="number" name="credit">
									</div>

									<div class="form-group">
										<label>Academic Year</label>
										<select class="custom-select" name="academic">
											<option>Choose Academic Year</option>
											<option>2019-2020</option>
											<option>2020-2021</option>
										</select>
									</div>
									<div class="form-group">
										<label>Term</label>
										<select class="custom-select" name="term">
											<option>Choose a Term</option>
											<option>1</option>
											<option>2</option>
										</select>
									</div>
								</div>

								<div class="col-xl-12" >
									
									<button class="btn btn-warning btn-block" type="submit" name="submit_result">
										PUBLISH
									</button>   
								</div>

							</div>
		<!-------------------------result section ends-------------------------->
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>

</section>
<!-------------------------course and result section ends -------------------------->

<!-------------------------team section starts -------------------------->
<section id="team" class="section-fluid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-10 col-lg-9 ml-auto">
				<h2 class="text-center ">Support Team</h2>
				<div class="row ">
					<?php 
					$sql="SELECT * FROM team";
					$query=mysqli_query($conn,$sql);

					while ($row=mysqli_fetch_assoc($query)) {
						$team_id=$row['team_id'];
						$name=$row['name'];
						$position=$row['position'];
						$team_img=$row['team_img'];
					
					?>


					<div class="col-sm-6 col-xl-3">
						<div class="team-wrapper">
							<div class="task-obj ">
								<h4><?php echo $name;?></h4>
								<p><?php echo $position; ?><p>
								
							</div>
							
							<div class="team-image">
								<img src="../img/<?php echo $team_img;?>">
							</div>

							<div class="team-link">
								<a href="#team-edit">
									<i class="fas fa-edit"></i>

								</a>
							</div>


						</div>
						
					</div>
					<?php
					}
					?>


					
				</div>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-------------------------team section ends -------------------------->

<!-- --------------------------- form to edit the team starts-------------------- -->
<section id="team-edit" class="section-fluid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-10 col-lg-9 ml-auto">
				<div class="team-close">
					
					<i class="far fa-window-close"></i>
					
				</div>
				<div class="row mt-2">
					<div class="col-md-6 mx-auto" >
						<h2 class="add_info">Manage Support Team</h2>
						<form class="form clearfix" method="post" action="includes/manage_web.php" enctype="multipart/form-data">

							<div class="form-group">
								<label><h5>Member's Full Name</h5></label>
								<input class="form-control" type="text" name="title">
							</div>
							<div class="form-group">
								<label><h5>Positon</h5></label>
								<select class="custom-select" name="description" >
									<option></option>
									<option>IS President</option>
									<option>Admission Office</option>
									<option>IT Manager</option>
									<option>Application Assistant</option>
								</select>
							</div>
							<div class="form-group">
								<label><h5>Memmber Profile</h5></label>
								<input class="form-control" type="file" name="event_cover">
							</div>

							<div class="form-group">
								<button class="btn btn-primary btn-block" type="submit" name="submit_team" >
									UPDATE
								</button>	
							</div>

							
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>
<!-- --------------------------- form to edit the team ends-------------------- -->


</body>
</html>
