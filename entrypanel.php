<?php session_start(); 
include_once 'includes/dbh.php';

if(!isset($_SESSION['std_id'])){
  header("location:login.html?You_need_to_login_in");
}

else{
  $id=$_SESSION['std_id'];
  $sql = "SELECT * FROM personal_info WHERE student_id = '".$id."' ";
  $result= mysqli_query($conn,$sql);

  $resultCheck= mysqli_num_rows($result);

  if($resultCheck==1){
    while ($row=mysqli_fetch_assoc($result)) {
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $passport= $row['passport'];
      $nationality= $row['nationality'];
      $email= $row['email'];
      $pnber= $row['phone_number'];
      $gender= $row['gender'];
    }
  }

  $_SESSION['std_fname']=$fname;
           
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="fontawesome/css/all.css">

    
    <link rel="stylesheet" href="css/entrypanel.css">

    <title>Home Page | Student Entry</title>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jQuery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

   


  </head>

  <body>

    <header>

      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="img/navbar-logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto in ">
              <a class=" nav-link " href="#">Welcome  <?php echo $_SESSION['std_fname']; ?> </a>

              <button class="nav-item nav-link btn btn-link btn-control in ">
                <a href="includes/logOut.php">Log Out</a>
              </button>
                
            </div>
        </div>
      </nav>

    </header>

    <section id="section_wrapper">


      <div class="container">

        <div class="row">


          <div class="col-lg-3 col-sm-6 ">
            <div class="student-info common">
              <a href="#personal-information">
                <div class="custom-circle pl-2">
                  <i class="fa fa-user"></i>
                </div>
                <h3>Personal Info</h3>

              </a>
            </div>

          </div>

          <div class="col-lg-3 col-sm-6 ">
            <div class="student-course common">
              <a href="#course-table">
                <div class="custom-circle pl-2">
                  <i class="fas fa-book"></i>
                </div>

                <h3>Course Table</h3>
              </a>
            </div>

          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="result-poll common">
              <a href="#result">
                <div class="custom-circle pl-2">
                  <i class="fas fa-poll"></i>
                </div>
                
                <h3>Check Result</h3>
              </a>
            </div>
         </div>

          <div class="col-lg-3 col-sm-6 ">
            <div class="library common">
              <a href="school-library.php">
                <div class="custom-circle">
                  <i class="fas fa-school"></i>
                </div>
                <h3>School Library</h3>
              </a>
        
           </div>

          </div>

        </div>

      </div>
    </section>


    <section id= "personal-information">
      <div class=" container">

        <div class="section_title">
          <h2>Student Information</h2>
        </div>


        <table style="border: 2px solid black; padding: 20px;">

          <caption>Personal Information</caption>

          <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Passport</th>
            <th>Nationality</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Gender</th>
            
          </tr>

           <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $passport; ?></td>
            <td><?php echo $nationality; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $pnber; ?></td>
            <td><?php echo $gender; ?></td>
            
          </tr>


        </table>
      </div>
      
    </section>  

    <section id="course-table">
      <div class="container">

        <div class="section_title">
          <h2>Time Table</h2>
        </div>


        <table  class="table table-bordered table-striped " style="border: 2px solid black" >
          <caption>Course Table</caption>
          <thead>

          <tr>
          <th></th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          </tr>
          </thead>
          
          <tbody>
            <?php
            function get_course(){
            	global $conn;


            	$sql= "SELECT * FROM course_info ";
            	$result=mysqli_query($conn,$sql);

            	while($row=mysqli_fetch_assoc($result)){
            		$course[] = $row;
            	}

            	return $course;

            }

            $course_list=get_course();

            foreach ($course_list as $time_table) {

            	$time = $time_table['time'];
              $mo = $time_table['monday'];
             	$tu = $time_table['tuesday'];
              $we = $time_table['wednesday'];
              $th = $time_table['thursday'];
              $fr = $time_table['friday'];
            
            
            ?>
          <tr>
          <td><?php echo $time; ?></td>
          <td><?php echo $mo; ?></td>
          <td><?php echo $tu; ?></td>
          <td><?php echo $we; ?></td>
          <td><?php echo $th; ?></td>
          <td><?php echo $fr; ?></td>
          </tr>

      <?php } ?>

         </tbody>

        



        </table>

      </div>
      
      
    </section>
<!--------------------------------- time table section ends----------------- -->



<!--------------------------------- result section starts----------------- -->
    <section id="result">
      <div class="container">
        <div class="section_title">
          <h2>RESULTS</h2>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            
            <form class="form clearfix" method="post" action="entrypanel.php">
              <div class="row no-gutters">

                <div class="col-md-4">

                  <label>Academic Year</label>
                  <select name="academic" required>
                    <option></option>
                    <option>2019-2020</option>
                    <option>2020-2021</option>
                  </select>     

                </div>

                 <div class="col-md-3">

                  <label>Term</label>
                  <select name="term" required>
                    <option></option>
                    <option>1</option>
                    <option>2</option>
                  </select>   

                </div>
                <div class="col-md-2 ">
                  <button type="submit" name="check_result" class="btn btn-success ">Check</button>
                </div>

              </div>

            </form>
      
            
            
          </div>

          
          <div class="col-md-12">
            

            
                <?php

                if (isset($_POST['check_result'])) {

                  $term=$_POST['term'];
                  $academic=$_POST['academic'];

                  $sql="SELECT result.*,course_list.course_name FROM result
                  INNER JOIN  course_list ON result.course_id=course_list.course_id 
                  WHERE result.academic_year='".$academic."' AND result.term='".$term."'
                  AND result.student_id='".$id."'";

                  $query=mysqli_query($conn,$sql);

                  $rowNumbers=mysqli_num_rows($query);

                  if($rowNumbers>=1){?>
                    <h6 class=" text-info">Year: <?php echo $academic; ?> Term: <?php echo $term; ?></h6>
                    <table class="">
                      <caption class="text-center">Results for 
                        <?php 
                        $fname=strtolower($fname);
                        $lname=strtolower($lname);

                        echo $fname." ".$lname; ?>
                        
                      </caption>

                      <thead>
                        <tr>
                          <th>Course Name</th>
                          <th>Score</th>
                          <th>Credit</th>
                          <th>Decision</th>
                         
                        </tr>
                      </thead>

                      <tbody>
                    <?php
                    while ($row=mysqli_fetch_assoc($query)) {
                      $course_name=$row['course_name'];
                      $score=$row['score'];
                      $credit=$row['credit'];
                      $decision=$row['decision'];?>
                      

                      <tr>
                        <td><?php echo $course_name; ?></td>
                        <td><?php echo $score; ?></td>
                        <td><?php echo $credit; ?></td>
                        <td><?php echo $decision; ?></td>
                        
                      </tr>
                        
                    <?php
                    }?>
                     </tbody>
              
                    </table>

                    <?php

                  }
                  else{
                    echo"no result Found!";
                  }

                }
                else{?>
                  <h5>To check result you need to select academic Year and Term</h5>
                  <table>
                    <thead>
                      <th>Course Name</th>
                      <th>Score</th>
                      <th>Credit</th>
                      <th>Decision</th>
                    </thead>
                  </table>


               <?php 
                }
                ?>
                
             

            
          </div>
          
        </div>
      </div>
      
    </section>

 <!--------------------------------- result section ends----------------- -->

  <footer>

    <div class="container">
      <div class="footer-wrapper">

        <span>&copy;Copyright 2020-01, All Rights Reserved </span>
      </div>

    </div>

  </footer>
    
 <!---------custom js--------->

    <script src="js/entryPanel.js"></script>
    
  </body>
</html>
