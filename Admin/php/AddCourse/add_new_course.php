<?php

if(isset($_POST['add_course'])){
	$link =mysqli_connect('localhost','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
				$id=$_POST['id'];
				$name=$_POST['name'];
			    $sd=$_POST['start_date'];
				$ed=$_POST['end_date'];
				$prof=$_POST['p_fname'];
				$pros=$_POST['p_lname'];
				$des=$_POST['des'];
				$adm="101000";//$admin_id
				$subject=$_POST['subject'];
				$query="INSERT INTO course VALUE ('$id', '$name', '$sd', '$ed', '$prof', '$pros', '$des', '$adm', '$subject');";	
				 
			 
				if (mysqli_query($link, $query)) {
                   $message[] = 'Course added successfully!';
				}
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="/Admin/css/admin_style.css">
</head>
<body>
   
<?php include '../Main/admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-course">
   <h1 class="title">Add Course</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Enter course information</h3>
	  <p align="left" "font-size:160%;">Course Id: </p>
	  <input type="text" name="id" class="box" placeholder="Enter course id(4 digits)" required>
	  <p align="left">Course Name: </p>
      <input type="text" name="name" class="box" placeholder="Enter course name" required>
      <p align="left">Start date: </p>
	  <input type="date" name="start_date" class="box"  required>
	  <p align="left">End date:</p>
	  <input type="date" name="end_date" class="box"  required>
      <p align="left"> Professor First Name:</p>
	  <input type="text" name="p_fname" class="box" placeholder="Enter professor first name" required> 
	  <p align="left"> Professor Last Name:</p>
	  <input type="text" name="p_lname" class="box" placeholder="Enter professor last name" required> 
	  <p align="left"> Course Description:</p>
	  <input type="text" name="des" class="box" placeholder="Enter course description" required>
	  <p align="left"> Subject:</p>
	  <input type="text" name="subject" class="box" placeholder="Enter subject ID" required>
      <input type="submit" value="add course" name="add_course" class="btn">
   </form>

</section>


<!-- custom admin js file link  -->
<script src="/Admin/js/admin_script.js"></script>

</body>
</html>