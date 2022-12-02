<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="/Admin/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="board">

<h1 class="title">Courses In Western University</h1>

 	
<div id="show">
	<form action="" method="post" name="indexf"> 
		</p>
		<p  align="center">
			<input type="text" name="sel"/>
			<input type="submit" value="search" name="selesub"/>	
			 
	    </p>
	<br><br> 
	    <table align="center" border="1px" cellspacing="0px" width="1000px">
		<tr><th>Course id</th> 
			<th>Name</th>
			<th>Time</th>
			 
			<th>Professor </th>
		 
			<th>Description</th>
			 
			</tr> 
 
 <?php
			$link =mysqli_connect('127.0.0.1','root','root','schooldb');
			if(!$link){
			 exit("databse connect failed");
			}
			if (empty($_POST["selesub"])){
				$res=mysqli_query($link,"select * from course order by courseID");	
			}
			else{
				$sel=$_POST["sel"];
				$res=mysqli_query($link,"select * from course where courseID like '%$sel%' or courseName like '%$sel%' or belongto like '%$sel%'" );
			}
		   
			while ($row = mysqli_fetch_array($res)){
				
				echo'<tr align="center">';
				echo "<td>$row[0]</td>
				      <td>$row[1]</td>
					  <td>$row[2]|$row[3]</td>
					  <td>$row[4]  $row[5]</td>
					  
				
					  <td>$row[6]</td>	 
				";
				echo '</tr>';
				 
			}
		 
			 
	  ?>

 
</table>		 
</form>
 
</section>

<!-- admin dashboard section ends -->

<script src="/Admin/js/admin_script.js"></script>

</body>
</html>