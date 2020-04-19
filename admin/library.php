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
    <link rel="stylesheet" href="css/update_library.css">

    <title>SCHOOL LIBRARY</title>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jQuery.js" ></script>
    <script src="../js/popper.js" ></script>
    <script src="../js/bootstrap.js"></script>

    <!-- Optional JavaScript -->

</head>

<body>

<!-------------------------------------Navigation starts------------------------------>
<nav class="navbar navbar-expand-lg navbar-light ">
    <button class="navbar-toggler ml-auto bg-light" type="button" data-toggle="collapse" data-target="#mynav"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynav">
        <div class="container-fluid">
            <div class="row">

                <!---- -------sidebar---------------->
                <div id="sidebar" class=" col-xl-2  col-lg-3 fixed-top  ">
                    <div class=" py-4 border-bottom text-center ">
                        <span class="text-white ">Admin Panel</span>
                    </div>

                    <div class="navbar-nav flex-column sidebar-nav">
                        <a class="nav-item nav-link" href="index.php"> <i class="fas fa-home"></i> Dashboard</a>
                        <a class="nav-item nav-link" href="#books"><i class="fas fa-book"></i> Books</a>
                        <a class="nav-item nav-link" href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
                        <a class="nav-item nav-link" href="#return"><i class="fas fa-exchange-alt"></i> Return</a>
                        
                    </div>

                </div>
                <!--------------- sidebar ends------------->

                <!--------------- top bar ------------->
                <div id="top-bar" class="col-xl-10 col-lg-9 ml-auto fixed-top pt-2 d-block">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4 class="m-0">LIBRARY</h4>
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
<!-------------------------------------Navigation ends------------------------------>


<!-------------------------------------display all books starts ------------------------------>
<section id="books" class="section-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 ml-auto">

                <div class="row">
                    <div class="display-books">
                                   
                    <h3 class="mt-2">List Of Books</h3>

                    <div class="add_info col-md-12">
                        <div class="add_btn btn-info">
                            <a href="includes/modification.php"><i class="fas fa-plus"><span> add Book</span></i></a>
                        </div>
                        
                        
                    </div>

                    <table class="book-table" width="1050">
                        <caption class="text-center">Book List</caption>

                        <thead>

                            <tr>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Copies</th>
                                <th>Book Cover</th>
                                <th>#</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php 
                            $sql= "SELECT * FROM books";
                            $query=mysqli_query($conn,$sql);

                            $rows_number=mysqli_num_rows($query);
                            
                            $result_per_page=3;
                            $number_of_pages=ceil($rows_number/$result_per_page);

                            if(!isset($_GET['book_page'])){
                                $page=1;
                            }
                            else{
                                $page=$_GET['book_page'];
                            }

                            $starting_num=($page-1)*$result_per_page;

                            echo "showing results from ".$starting_num." to ".($starting_num+$result_per_page);

                            $sql = "SELECT * FROM books LIMIT $starting_num,$result_per_page";
                            $query=mysqli_query($conn,$sql);

                            while ($row=mysqli_fetch_assoc($query)) {
                                $b_id=$row['bookId'];
                                $name=$row['book_name'];
                                $author=$row['author'];
                                $description=$row['description'];
                                $category=$row['book_type'];
                                $copies=$row['copies'];
                                $cover=$row['book_img'];

                                
                            ?>

                            <tr>
                                <td><?php echo $name;?></td>
                                <td><?php echo $author;?></td>
                                <td><?php echo $description;?></td>
                                <td><?php echo $category;?></td>
                                <td><?php echo $copies;?></td>
                                <td><img width="60" src="../img/books/<?php echo $cover;?>"></td>
                                <td>
                                    <a href="includes/modification.php?id=<?php echo $b_id;?>" >
                                        <i class="fas fa-edit "></i>
                                    </a>
                                </td>

                            </tr>
                            <?php

                            }

                            ?>

                        </tbody>
                        
                    </table>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link">&laquo;</a>
                            </li>

                            <?php
                            for($i=1;$i<=$number_of_pages;$i++){?>



                            <li class="page-item">
                                <a class="page-link" href="library.php?book_page=<?php echo $i;?>">
                                    <?php echo $i;?>
                                        
                                </a>
                            </li>
                            <?php
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link">&raquo;</a>
                            </li>
                        </ul>
                    </nav>

                    </div>

                </div>
                
            </div>
            
        </div>
        
    </div>
    
</section>

<!-------------------------------------display all books ends ------------------------------>


<!-------------------------------------book orders starts ------------------------------>
<section id="orders" class="section-fluid">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xl-10 col-lg-9 ml-auto">
                <div class="row">

                    <div class="orders col-md-8 ">
                        <h3 class="text-center">Book Orders</h3>

                        <table class="table table-dark table-bordered table-hover">
                            <caption class="text-center">Orders</caption>
                            <thead>

                                <tr>
                                    <td>Student Id</td>
                                    <td>Book Id</td>
                                    <td>Order Date</td>
                                    <td>Status</td>
                                    <td>#</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql ="SELECT * FROM book_order WHERE order_status='borrowed' ";
                                $query = mysqli_query($conn,$sql);

                                while ($row=mysqli_fetch_assoc($query)) {
                                    $order_id=$row['order_id'];
                                    $std_id=$row['student_id'];
                                    $book=$row['bookId'];
                                    $order_date=$row['order_date'];
                                    $status=$row['order_status'];

                                
                                ?>
                                <tr>
                                    <td><?php echo $std_id; ?></td>
                                    <td><?php echo $book; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $status ; ?></td>
                                    <td>
                                        <a href="includes/modification.php?order=<?php echo $order_id;?>" >
                                            <i class="fas fa-edit "></i>
                                        </a>
                                    </td>
                                </tr>

                                <?php
                                }
                                ?>
                            </tbody>


                        </table>
                    </div>
                    <!-----------------returning books starts------------>
                    <div id ="return" class=" col-md-4 mb-4">
                        <h4 class="text-center">Return Books</h4>
                        <div class="col-md-11 col-sm-8 m-auto">
                            <form class="form clearfix" method="post" action="includes/modification.php">
                                <div class="form-group text-center mt-4 pt-3">
                                    <label ><h4 >Student Id</h4></label>
                                    <input class="form-control" type="text" name="std_id" 
                                    placeholder="Student ID" required> 
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-outline-success btn-block" name="return_book">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                
                            </form>
                            
                        </div>
                        
                    </div>
                     <!------------------------returning books ends  -------------------->
                    
                </div>
            </div>
        </div>

    </div>

    
</section>
<!-------------------------------------book orders ends------------------------------>
</body>
</html>
