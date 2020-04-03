<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
			background-image: linear-gradient(65deg,#273c75,#192a56,#44bd32) ;
			
		}

		.update-student {
			font-size: 30px;
			border:1px solid rgba(128,128,128,0.6);
			background-color: #dcdde1;
			box-shadow: 5px 5px 7px #999;
			
		}
		span{
			font-size: 35px;
			background-color: yellow;
			color: #2980b9;
		}
		.edited{
			font-size: 16px;
			color: rgba(0,0,0,0.7);
		}
		.gif_wrapper img{
			width: 100%;

		}
	</style>



	<title>In Process</title>

	<script type="text/javascript" src="../js/jQuery.js"></script>
	<script type="text/javascript" src="../js/popper.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
</head>


<body>



<?php
include_once 'dbh.php';

if(isset($_POST['submit'])){

	if(!$conn){
		echo "Not connected to the server";
	}

	if(!$dtbase){
		echo "database not selected";
		exit();
	}


	$firstName = mysqli_real_escape_string($conn,$_POST['std_fnm']);
	$lastName = mysqli_real_escape_string($conn,$_POST['std_lnm']);
	$email = mysqli_real_escape_string($conn,$_POST['std_email']);
	$passport = mysqli_real_escape_string($conn,$_POST['std_passport']);
	$nationality = mysqli_real_escape_string($conn,$_POST['std_nationality']);
	$phone = mysqli_real_escape_string($conn,$_POST['std_pnber']);
	$password = mysqli_real_escape_string($conn,$_POST['std_pwd']);
	$gender = mysqli_real_escape_string($conn,$_POST['std_gender']);



	if(empty($firstName)|| empty($lastName)||empty($email)||empty($passport)|| empty($nationality)||empty($phone)
		||empty($password)||empty($gender)){
		header("location:../registration.html?Empty_input_fill_all_the_form");
	}
	else{

		$sql= "INSERT INTO personal_info (first_name,last_name,email,password,passport,nationality,phone_number,gender) VALUES ('$firstName','$lastName', '$email', '$password','$passport','$nationality','$phone','$gender')";

		if(!mysqli_query($conn,$sql)){

			echo "<span>Not Inserted <br> ";
			echo "contact suport team if you are having problem with the system.</span>";
			header("refresh:2; url=../index.html");
		}

		else{

			$sql="SELECT * FROM personal_info ORDER BY student_id DESC LIMIT 1";
			$query=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_assoc($query)) {
				$id=$row['student_id'];
			}


			?>

			<section>
				<div class="container">
					<div class="row mt-5 ">
						<div class="col-md-12 mb-2">
							<div class="row">
								<div class="col-md-2 mx-auto gif_wrapper">
									<img src="../img/countdown.gif">
								</div>
								
							</div>
						</div>

						<div class="col-md-6 mx-auto update-student">
							<p>You have successfully created a new account, 
								Your Student ID is: <br>
								<span><?php echo $id;?></span>


							</p>
							<p class="edited">You can sign in using your student ID
							 and your password <br> 
							 <a style="font-size: 18px;" href="../login.html">Sign in?</a>
							  </p>
						</div>
					</div>
				</div>

			</section>

	
			<?php
			header("refresh:9;url=../login.html");
			
		}
	}

}

else{

	echo "<span> not submitted <br>";
	echo "contact suport team if you are having problem with the system.</span>";	
	header("refresh:2; url=../registration.html");

}



?>

</body>
</html>
