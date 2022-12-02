<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>delete</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/Admin/css/admin_style.css">

</head>
<body>
   
<?php include '../Main/admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="board">
 	
<div id="show">
	 
<h1 class="title">Delete Course</h1>
   
<form>
	<br><br> 
	    <table align="center" border="1px" cellspacing="0px" width="1000px">
		<tr><th>Course id</th> 
			<th>Name</th>
			<th>Time</th> 
			<th>Professor </th>
			<th>         </th>
			</tr> 
			<tr>
				
			</tr>
 
 <?php
			session_start();
			$link =mysqli_connect('127.0.0.1','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
			 
				$res=mysqli_query($link,"select * from course order by courseID");	
			 
			     while ($row = mysqli_fetch_array($res)){
				
				echo'<tr class="data-row" align="center">';
				echo "<td>$row[0]</td>
				      <td>$row[1]</td>
					  <td>$row[2]|$row[3]</td>
					  <td>$row[4]  $row[5]</td>
					  <td>
					  <input type='radio' name='course_id' value=$row[0] />
					  </td>		 
				";
				echo '</tr>';
	 		
	 				
			}
			  
	  ?>
 
 
</table> 
	<br><br>
	
<p  align="center">
<button type="button" class="delete-btn">Delete</button>
</p>
</form>
	
	
 

</section>

 <script src="/Admin/js/admin_script.js"></script>
 <script src="/Admin/js/admin_delete_script.js"></script>

</body>
</html>
  