<?php 
include_once 'dbh.php';
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Bootstrap CSS -->
    

    <style type="text/css">
        p span {
            color:red;
            font-size: 25px;
            font-weight: 500;
            margin-left: 20px; 
        }
    </style>


    <title></title>
    <script src="../js/jQuery.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script >
        $(document).ready(function(){

            $(".borrow_action").click(function(){
                var btn_id = $(this).attr("id");
                $.post("includes/borrow.php", {
                    borrow_id:btn_id
                },function(data,status){
                    $("#load_success").html(data);

                });

            });


        })
        
    </script>



</head>


<body>

<?php


if(isset($_POST['book_id'])){



    $book_id = $_POST['book_id'];

    $sql="SELECT * FROM books WHERE bookId='".$book_id."' ";
    $result= mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['bookId'];
        $book_name=$row['book_name'];
        $book_author=$row['author'];
        $book_img=$row['book_img'];
        $book_description=$row['description'];
     }

       ?>

    <div class="container in">

            <div class="row">

                <div class="col-md-5">
                    <div class="book_cover">
                        <img src="img/books/<?php echo $book_img ; ?>">
                    </div>
                    <h4><?php echo $book_name;?></h4>
                    <h5><?php echo $book_author; ?></h5>
                </div>

                <div class="col-md-7">
                    <div class="box_wrapper">

                        <div class="description">
                            <p><?php echo $book_description ; ?></p>
                        </div>



                        <div class="borrow_wrapper">
                            <?php 
                            $student = $_SESSION['std_id'];

                            $sql="SELECT * FROM book_order where book_order.student_id='".$student."'
                            AND book_order.order_status='borrowed'";
                            $query=mysqli_query($conn,$sql);
                            $rows=mysqli_num_rows($query);

                            if($rows>=3){?>

                                <div class="access-denied">
                                    <p><i class="fas fa-exclamation-circle text-danger" ></i>
                                        Sorry you have up to 3 books borrowed from Library, to be able to borrow
                                        again you need first to return some books. Thanks!

                                    </p>
                                </div>

                            <?php
                            }
                            else{
                                $sql="SELECT * FROM book_order WHERE book_order.bookId='".$id."' AND 
                                book_order.student_id='".$student."' AND book_order.order_status='borrowed' ";

                                $query= mysqli_query($conn,$sql);
                                if(mysqli_num_rows($query)>=1){ ?>

                                    <div class="borrowed">
                                        <div class="btn btn-success btn-block disabled">
                                            ALREADY BORROWED
                                        </div>
                                    </div>

                                    
                                
                                <?php
                                }

                                else{ 
                                    ?>
                                    <div id="load_success">
                                        <div id="<?php echo $id;?>" class="borrow_action">
                                            <div  class="btn btn-primary btn-block">
                                                BORROW
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                <?php
                                }

                            
                            }
                            ?>

                            
                            
                            
                            
                        </div>
                         
                    </div>
                     
                </div>
            </div>

        </div>

<?php 

}
else{
    echo "<p><span>something went wrong</span></p>";
}

?>



</body>
</html>







 
