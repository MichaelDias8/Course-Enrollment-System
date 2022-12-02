<title>Student Account</title>
<link rel="stylesheet" href="/Student/Account/css/accountCSS.css">

<h1>Student Account Information is listed below:</h1>

<div class="container"; font-size=28px;>
<?php
	require_once '../../../database.php';
	$con = database::connect();
	get_account();
?>

<?php

	function get_account() 
    {
		global $con;
		$person = $_GET["person"];
        $query = "SELECT * FROM student WHERE studentID = '".$person."'";
		$result = mysqli_query($con, $query);
		if(!$result) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($result)) {
				echo "Student ID: ";
				echo $row['studentID'] . "<br>";
				echo "Student Username: ";
				echo $row['username'] . "<br>";
				echo "Student Full Name: ";
				echo $row['firstName'] . " " . $row['lastName'] . "<br>";
				echo "Program: <br>";
				echo str_repeat('&nbsp;', 4);
				echo "Faculty -- " . $row['faculty'] . "<br>";
				echo str_repeat('&nbsp;', 4);
				echo "Module -- " . $row['module'] . "<br>";
				echo str_repeat('&nbsp;', 4);
				echo "Degree -- " . $row['degree'] . "<br>";
		}
	}
?>
</div>

<a href="/Student/Main/html/studentMain.html"><Button id="addButton"; class="form__button">Return to Main Menu</Button></a>