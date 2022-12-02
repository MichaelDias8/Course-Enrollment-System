<?php

	require_once '../../../database.php';
	$con = database::connect();
    
    switch ($_REQUEST["function"])
    {
        case "print_courses":
            print_courses();
            break;
        case "delete_course":
            drop_course();
            break;
    }
	
	function print_courses() 
    {
		global $con;
		$count = 0;
		$person = "100004353";
        $querycheck = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		
		echo "<table align='center' border='1' width='100%'>";
		echo "<tr><td>" . "course ID" . "</td><td>" . "Course Name" . "</td><td>" . "Start Date" . "</td><td>" . "End Date" . "</td><td>" . "Professor First Name" . "</td><td>" . "Professor Last Name" . "</td></tr>";
		while($row = mysqli_fetch_array($check)) {
			echo "<tr><td>" . htmlspecialchars($row['courseID']) . "</td><td>" . htmlspecialchars($row['courseName']) . "</td><td>" . htmlspecialchars($row['startDate']) . "</td><td>" . htmlspecialchars($row['endDate']) . "</td><td>" . htmlspecialchars($row['profFirstName']) . "</td><td>" . htmlspecialchars($row['profLastName']) . "</td></tr>";
		}
		echo "</table>";
	}
	 
	function drop_course()
	{
		global $con;
		$person = "100004353";
		$found = false;
        $querycheck = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($check)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				$found = true;
			}
		}
		
		if(!$found) {
			echo "You have not enrolled this course / The course does not exist!";
		} else {
			$querydrop = 'DELETE FROM enrollcourse WHERE studentID = "'.$person.'" AND courseID = "'.$_REQUEST.'"';
			if (!mysqli_query($con, $querydrop)) {
				die("Error: insert failed" . mysqli_error($con));
			}
			echo 'Drop successfully.<br>The course you currently take: <br>';
			
			$query = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";
			$result = mysqli_query($con, $query);
			if(!$result) {
	            die("Get course info query failed.");
	        }
			
			echo "<table align='center' border='1' width='100%'>";
			echo "<tr><td>" . "course ID" . "</td><td>" . "Course Name" . "</td><td>" . "Start Date" . "</td><td>" . "End Date" . "</td><td>" . "Professor First Name" . "</td><td>" . "Professor Last Name" . "</td></tr>";
			while($row = mysqli_fetch_array($check)) {
				echo "<tr><td>" . htmlspecialchars($row['courseID']) . "</td><td>" . htmlspecialchars($row['courseName']) . "</td><td>" . htmlspecialchars($row['startDate']) . "</td><td>" . htmlspecialchars($row['endDate']) . "</td><td>" . htmlspecialchars($row['profFirstName']) . "</td><td>" . htmlspecialchars($row['profLastName']) . "</td></tr>";
			}
			echo "</table>";
		}
	}
	

?>