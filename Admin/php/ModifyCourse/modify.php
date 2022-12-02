 
 
<?php

$link =mysqli_connect('localhost','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}


	$id = $_GET['id'];

if($_GET['modify'] == 'Modify'){
	$name=$_GET['name'];
	$sd=$_GET['start_date'];
	$ed=$_GET['end_date'];
    $prof=$_GET['p_fname'];
	$pros=$_GET['p_lname'];
	$des=$_GET['des'];
	$adm=$_GET['adm'];
	$subject=$_GET['subject'];
 
	$query2=
	"UPDATE course 
     SET courseName ='$name', startDate ='$sd', endDate='$ed', profFirstName='$prof', profLastName='$pros', description ='$des', addby ='$adm', belongto ='$subject' WHERE courseID='$id';";
			
	if (mysqli_query($link, $query2)) {
		$message[] = 'Course modified successfully!';}
	else{ 
		die ("Error while trying to modify in second step--". mysqli_error($link));
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
   
<?php include '../Main/admin_header.php'; ?>
<?php
	session_start();
	$link =mysqli_connect('localhost','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
	  
   
	$res=mysqli_query($link, 'select * from course where courseID = "' . $id . '"');
	
    
		$row = mysqli_fetch_array($res);
			 
			  echo '<section class="add-course">';  
	          echo '<form action="modify.php?modify=true" method="GET" enctype="multipart/form-data">';
              echo'<h3 align="center">Modify course information</h3>';
			  echo "<br>";
		      echo'<div align="center">';
			  echo "Course ID -  <input type='text' name='id' value = $id readonly>";
		      echo"<br>";
			  echo "Course Name  -  <input type='text' name='name' value = $row[1] >";
			  echo"<br>";
			  echo "Start Date  -  <input type='date' name='start_date'  value = $row[2] >";
			  echo"<br>";
			  echo "End Date  - <input type='date' name='end_date'  value = $row[3]>";
		      echo"<br>";
			  echo "Professor First Name  -  <input type='text' name='p_fname' value = $row[4]>";
			  echo"<br>";
			  echo "Professor Last Name  -  <input type='text' name='p_lname'  value = $row[5] >";
			  echo"<br>";
			  echo "Description  -  <input type='textbox' name='des'   value='$row[6]' >";
			  echo"<br>";
			  echo 'Administrator ID  -  <input type="text" name="adm"  value ="' . $_GET['adm'] . '" readonly>';
			  echo"<br>";
	     	  echo  "Subject ID  -  <input type='text' name='subject'  value =$row[8]>";
			  echo"<br><br><br>"; 			 			
			  echo'</div>';
			  echo" <p align='center'> <input type='submit' name='modify' value ='Modify' class='btn'></p
			  >";
 
            
	

 		 
	?>
	
	 </form>  			
   </section> 
	
 <script src="/Admin/js/admin_script.js"></script>

</body>
</html>
