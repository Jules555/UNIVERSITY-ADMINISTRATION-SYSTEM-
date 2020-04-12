<?php session_start();
include_once 'includes/dbh.php';

if(!isset($_SESSION['std_fname'])){
    header("location:login.html?Action-Needed");
}


?>



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link  rel="stylesheet" href="css/bootstrap.css">

    <!-- custom  CSS -->
    <link rel=" stylesheet" href="css/school-library.css">

    <!-- fontawesome  CSS -->
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">


    <title>School-Library</title>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jQuery.js"></script>
<script src="js/popper.js" ></script>
<script src="js/bootstrap.js" ></script>

<!------------custom js-------------------->
<script src="js/library.js"></script>

</head>

<body>
<!--------------------------------- header starts---------------------- -->
<header>
    <!-----------navigation bar starts--------------->

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="img/navbar-logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link">
                    Welcome <?php echo $_SESSION['std_fname']; ?>
                </a>
                <a class="nav-item nav-link " id="my_account_action" href="#">
                    <i class="fas fa-user-circle" > My Account </i> 
                 </a>
                
                <button class="nav-item nav-link btn btn-link btn-control">
                    <a href="includes/logOut.php " >Sign Out</a>
                </button>
            </div>

        </div>
        
    </nav>

    <!------------ navigation bar ends ------------>

    <div class="current_location">
        <span>Your current location: <a href="entrypanel.php">homepage </a>>School Library</span>
        
    </div>

</header>
<!--------------------------------- header ends---------------------- -->

<!---------------------------------  section starts---------------------- -->
<?php 
function get_books_categories(){
    global $conn;

    $sql = "SELECT books.book_type FROM books GROUP BY books.book_type desc ";
    $result=mysqli_query($conn,$sql);

    while ($row=mysqli_fetch_assoc($result)) {
        $categories[]=$row;
    }
    return $categories;

}


$categories_list=get_books_categories();




foreach ($categories_list as $category) {
    $title = $category['book_type'];

?>
<section id="section_container" class="section-wrapper">
    <div class="container">
        <div class="section-title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="row">

            <?php
            
                $sql= "SELECT * FROM books WHERE book_type='".$title."' LIMIT 4";
                $result= mysqli_query($conn,$sql);

                while ($row=mysqli_fetch_assoc($result)) {


                    $book_name=  $row['book_name'];
                    $book_author=  $row['author'];
                    $book_description=  $row['description'];
                    $book_img=  $row['book_img'];
                    $book_id=  $row['bookId'];
            
                ?>

            <div class="col-lg-3 col-sm-6">
                <div  class="book-wrapper">
                    <div class="book-image">
                        <img src="img/books/<?php echo $book_img ;?>">
                    </div>
                    <div class="book-title">
                        <h4><?php echo $book_name;?></h4>
                        <h5><?php echo $book_author;?></h5>
                    </div>
                    <div id="<?php echo $book_id ;?>" class="check-out checking" >
                        <div class=" btn btn-outline-primary btn-block ">
                            <span>Check Out</span>
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    
                </div>


            </div>

            <?php }?>
          
            <div  class="col-sm-12 try">
                <div id="load-more" class="col-sm-3 col-md-2">
                    <a href="more_library.php?category=<?php echo $title ?>">
                        LOAD MORE
                    </a>
                </div>
            </div>
            
          
        </div>
    </div>

</section>

<?php } ?>
<!---------------------------------  section  ends---------------------- -->



<div id="modal-container" class="hide">
    
    <div id="modal-content">
        <div style="width:100%;background-color: grey">
            <div id="closeModal" style="color:black;float:right;padding:1em;cursor:pointer;font-weight:bold" >
                 Close
            </div>
        </div>
        <div id="load">
            
        </div>
        

       
    </div>
</div>


<div id= "my-account" class="hide">
    <div class="account_details">
        
        <div class="account-nav">
            <div class="account-owned">
                <a href="#">OWNED</a>
            </div>
            <div class="account-library">
                <a href="#">LIBRARY</a>
            </div>

        </div>
        
        <?php 
        $std_id=$_SESSION['std_id'];
        $sql="SELECT book_order.*, books.book_name, books.book_type FROM book_order 
        INNER JOIN books ON books.bookId=book_order.bookId
        WHERE book_order.student_id='".$std_id."' 
        AND book_order.order_status='borrowed'";
        $query=mysqli_query($conn,$sql);
                                      
        if(mysqli_num_rows($query)==0){?>

            <div class="custom-details owned-books" >
                You have no books borrowed currently
            </div>
        <?php
        }

        while($row=mysqli_fetch_assoc($query)){
            $book_name=$row['book_name'];
            $category=$row['book_type'];
            $order_date=$row['order_date'];
        
            ?>
            <div class="custom-details owned-books ">
                <div class="detail-descr ">
                    <span><?php echo $book_name; ?> </span>
                    <p style="color:rgb(0,0,0)"><?php echo $category; ?> Book</p> 
                    <p>Ordered On: <?php echo $order_date; ?> </p>       
                </div>

                <div class="detail-info ">
                    due
                </div>
            

            </div>
        <?php
        }

        $sql_library="SELECT book_order.*, books.book_name, books.book_type FROM book_order 
        INNER JOIN books ON books.bookId=book_order.bookId
        WHERE book_order.student_id='".$std_id."' ORDER BY book_order.order_date DESC ";
        $query_library=mysqli_query($conn,$sql_library);
        if(mysqli_num_rows($query)==0){?>

            <div class="custom-details books-history hide" >
                You have never borrowed any book.
            </div>
        <?php
        }

        while($row_library=mysqli_fetch_assoc($query_library)){
            $name=$row_library['book_name'];
            $type=$row_library['book_type'];
            $order_date=$row_library['order_date'];
            $return_date=$row_library['return_date'];
            $order_status=$row_library['order_status'];
            ?>
        <div class="custom-details books-history hide">
         
            <div class="detail-descr ">
                <span><?php echo $name; ?> </span>
                <p style="color:rgb(0,0,0)"><?php echo $type; ?> Book</p> 
                <p>Ordered On: <?php echo $order_date; ?> </p> 
                <p>Return date: <?php echo $return_date; ?> </p>      
            </div>

            <div class="detail-info ">
                <?php echo $order_status; ?>
            </div>

        </div>
        
        <?php
        }

        ?>



    </div>

</div>


<footer>

    <div class="container">
        <div class="footer-wrapper">
            <span>&copy;Copyright 2020-01, All Rights Reserved </span>
        </div>
    </div>

</footer>



</body>
</html>
