<?php
session_start();
include_once 'includes/dbh.php';
if(!isset($_SESSION['std_id'])){
    header("location:login.html?Action_Needed");
}
$id=$_SESSION['std_id'];
$fname=$_SESSION['std_fname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  href="css/bootstrap.css">

    <!----------- custom css ----------->
    <link rel="stylesheet" href="css/otherPageStyles.css">
    <link rel="stylesheet" href="css/select_course.css">

    <title>STUDENT | Course Selection</title>

    <script src="js/jQuery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
        $(document).ready(function(){
      
            $("#myForm").submit(function(e){
                e.preventDefault()
                let formData= $(this).serializeArray()
                let selectedOffers = []
                formData.forEach(data=>{
                  data.value!=='null'?selectedOffers.push(data.value):''
                })

                console.log(selectedOffers)
                // let data = {
                //     studentId:"currentStudent",
                //     selectedCourses:selectedOffers
                // }

                if(selectedOffers.length<6){
                    alert("WARNING! \n\n You need to select more than 5 classes!")
                }
                else{
                    $.post("includes/selected_course.php",
                     {selectedCourses:selectedOffers},function(){
                         location.replace("entrypanel.php");
                     })
                    //  $.ajax({                            
                    //              type: "POST",  
                    //              url: "includes/selected_course.php",
                    //              data: {selectedCourses:selectedOffers}, 
                    //              success: function(){  
                    //                  location.replace("entrypanel.php");
                    //              },
                    //              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    //                  alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    //              //show error message  
                    //              }          
                    //          });

                }

            })
               // use ajax to send an array of selected offers and a student id

        

        })
       
       
       
    </script>
</head>
<body>

    <div id="top-wrapper">  
        <!-----------navigation bar starts--------------->

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#"><img src="img/navbar-logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link">Welcome <?php echo $fname;?></a>                
                    <button class="nav-item nav-link btn btn-link btn-control">
                        <a href="includes/logOut.php">Sign Out</a>
                    </button>
                </div>
            </div>

        </nav>

        <!------------ navigation bar ends ------------>
    </div>

    <section>
        <div class="container">
           
            <div class=" title">
                Location: <a href="entrypanel.php">Homepage</a> >Course selection
                <br><br>
                    This is the course Selection. You are required to select step by 
                    step according to your curriculum, <br>

                    your schedule must have more than 5 classes in a week<br><br>
                    Basic Explanation on Time<br><br>
            </div>

            <form class="form " method="post" id="myForm">

            <div class="row">
              
                <div class=col-md-12>
                <table class="table table-dark">
                    <caption class="text-white text-center">Time explanation</caption>
                    <tr>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th>5th</th>                                         
                    </tr>
                    <tr>
                        <td>8h30-10h00</td>
                        <td>10h30-12h00</td>
                        <td>14h30-16h00</td>
                        <td>16h20-17h50</td>
                        <td>19h30-21h00</td>
                    </tr>

                </table>
                </div>

                <?php 
                function get_days(){
                    global $conn;
                    $sql="SELECT DAYNAME(offered_course.starting_date) AS dayname FROM offered_course 
                            GROUP BY dayname ORDER BY DAYOFWEEK(offered_course.starting_date)";
                    $query=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($query)){
                        $days[]=$row;
                    }
                    return $days;

                }
                $new_list=get_days();
                foreach($new_list as $day_list){
                    $day=$day_list['dayname'];
                                
                ?>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mt-3">
                    <div>
                        <h4><?php echo $day; ?></h4>
                    </div>
                    <?php
                    $sql= "SELECT offer_time FROM offered_course WHERE
                     DAYNAME(offered_course.starting_date)='".$day."' GROUP BY offer_time" ;
                    $query=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($query)){
                        $offer_time=$row['offer_time'];
                    
                    ?>
                    <div>
                       <h5>Time: <?php echo $offer_time; ?></h5>
                         
                           <div class="form-group">
                               <select class="custom-select" name="<?php echo $day, $offer_time?>">
                                   <option value="null">Choose a course</option>
                                   <?php 
                                   $sql_inner="SELECT course_list.course_name,offered_course.offer_id
                                        FROM offered_course 
                                        INNER JOIN course_list ON course_list.course_id=offered_course.course_id
                                        WHERE DAYNAME(offered_course.starting_date)='".$day."' AND 
                                        offered_course.offer_time='".$offer_time."'";
                                    $query_inner=mysqli_query($conn,$sql_inner);
                                    while($row_inner=mysqli_fetch_assoc($query_inner)){
                                        $course=$row_inner['course_name'];
                                        $offer_id=$row_inner['offer_id'];
                                    
                                   ?>
                                   <option value=<?php echo $offer_id; ?>><?php echo $course;?></option>
                                   <?php
                                    }
                                   ?>
                               </select>
                           </div>
                           
                      
                    </div>
                    <?php
                    }
                    ?>
            
                </div>
                <?php
                }
                ?>
                <div class="col-md-12  pb-4 mb-4">
                    <div class="col-sm-3 mx-auto">
                        <button class="btn-outline-success btn-block" type="submit" id="submitBtn">
                            SUBMIT
                        </button>

                    </div>
                    
                </div>
             
                
            </div>
            </form>
        </div>
    </section>

</body>
</html>
