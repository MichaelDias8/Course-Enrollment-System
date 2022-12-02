 
 
<?php

$link =mysqli_connect('localhost','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
$id=$_POST['id'];
echo $cid;
 
if(isset($_POST['delete'])){
 
$query2="delete from course where courseID='$id' ";
			
if (mysqli_query($link, $query2)) {
$message[] = 'Course deleted successfully!';}
	else{ 
die ("Error while trying to add new course". mysqli_error($link));
	}
	
               
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/Admin/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>
<?php
	session_start();
	$link =mysqli_connect('localhost','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
	$cid=$_POST['course_id'];
	  
     
	
	$res=mysqli_query($link,"select * from course where courseID = '$cid' " );
	
    
		$row = mysqli_fetch_array($res);
			 
			  echo '<section class="add-course">';  
	          echo '<form action="" method="post" enctype="multipart/form-data">';
              echo'<h3 align="center">Are you want delete this course?</h3>';
			  echo "<br>";
		      echo'<div align="center">';
			  echo "Course ID --  <input type='text' name='id' value = $cid readonly>";
		      echo"<br>";
			  echo "Course Name  --    $row[1] ";
			  echo"<br>";
			  echo "Start Date  --    $row[2] ";
			  echo"<br>";
			  echo "End Date  -- $row[3]";
		      echo"<br>";
			  echo "Professor First Name  --  $row[4]";
			  echo"<br>";
			  echo "Professor Last Name  --  $row[5] ";
			  echo"<br>";
			  echo "Descripation  --  $row[6] ";
			  echo"<br>";
			  echo  "Administrator ID  -- $row[7] ";
			  echo"<br>";
	     	  echo  "Subject ID  --  $row[8]";
			  echo"<br><br><br>"; 			 			
			  echo'</div>';
			  echo" <p align='center'> <input type='submit' name='delete' value ='Delete' class='btn'></p
			  >";
 
	?>
	
	 </form>  			
   </section> 
	
 <script src="/Admin/js/admin_script.js"></script>

</body>
</html>
  