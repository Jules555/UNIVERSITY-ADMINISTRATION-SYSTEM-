<?php
include_once 'dbh.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>

	<!-- Bootstrap CSS -->
    
     <style type="text/css">
        p span{
            color:red;
            font-size: 25px;
            font-weight: 500;
            text-align: center;
        }
    </style>

	<title></title>

	<script src="../js/jQuery.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>

<body>

<?php

if(!isset($_POST['borrow_id'])){
	echo "<p><span>Something went wrong!</span></p>";
	exit();
}


	$book_id=$_POST['borrow_id'];
	$student=$_SESSION['std_id'];

	$sql="SELECT books.copies FROM books WHERE bookId='".$book_id."'";
	$result=mysqli_query($conn,$sql);

	//get number of books we have in stock 
	$current_copies=mysqli_fetch_assoc($result);

	//check if the number is not zero so that we can go ahead and let 
	// a student borrow this book

	if($current_copies['copies']>=1){

		//if it's not zero the we need to update our table by subtracting 1 book
		$new_copies=$current_copies['copies']-1;

		$update_copies="UPDATE books SET books.copies='$new_copies' WHERE books.bookId='$book_id'";

		$update=mysqli_query($conn,$update_copies);


		$sql="INSERT INTO book_order (bookId,student_id,order_date,order_status) VALUES 
		('$book_id','$student',now(),'borrowed')";

		if(!mysqli_query($conn,$sql)) {
			echo "<p><span>Something went wrong!</span></p>";
		}

		else{ ?>

			<div class="btn btn-success btn-block">
            	SUCCESSFULLY BORROWED
        	</div> 

	<?php
		}
	}

	else{?>

		<div class="btn btn-danger btn-block">
            OUT OF STOCK
        </div> 

	<?php
	}

	?>


</body>
</html>
