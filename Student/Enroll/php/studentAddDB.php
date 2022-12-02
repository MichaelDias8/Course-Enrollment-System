<?php

	require_once '../../../database.php';
	$con = database::connect();
    
    switch ($_REQUEST["function"])
    {
        case "get_course_info":
            get_course_info();
            break;
        case "add_taken_courses":
            add_taken_courses();
            break;
    }
	
	function get_course_info() 
    {
		global $con;
		$found = "not found";
        $querycheck = "SELECT * FROM course";
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($check)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				$found = "found";
			}
		}
		
		if (strcmp("found",$found) <> 0) {
			echo '<script type="text/javascript">alert("Invalid Course ID!");</script>';
		} else {
			$course = $_POST['course'];
			$query = "SELECT * FROM course WHERE courseId = '".$course."'";
			$result = mysqli_query($con, $query);
			if(!$result) {
            	die("Get course info query failed.");
        	}	
        	while($row = mysqli_fetch_assoc($result)) {
				echo "Course ID: ";
				echo $row['courseID'] . "<br>";
				echo "Course Name: ";
				echo $row['courseName'] . "<br>";
				echo "Open Date: ";
				echo $row['startDate'];
				echo " -- ";
				echo $row['endDate'] . "<br>";
				echo "Professor: ";
				echo $row['profFirstName'];
				echo " ";
				echo $row['profLastName'] . "<br>";
				echo "Description: ";
				echo $row['description'];
        	} 
    	}
	}
	
	function add_taken_courses()
	{
		global $con;
		$person = "100004353";
		$foundinsert = "not found";
        $querycheck = "SELECT * FROM course";
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($check)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				$foundinsert = "found";
			}
		}
		
		$dup = false;
        $querydup = "SELECT * FROM enrollcourse";
		$checkdup = mysqli_query($con, $querydup);
		if(!$checkdup) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($checkdup)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				if (strcmp($person, $row['studentID']) == 0){
					$dup = true;
				}
			}
		}
		
		if ($dup) {
			echo "duplicated";
			exit();
		} else {
			if (strcmp("found",$foundinsert) <> 0) {
				//echo '<script type="text/javascript">alert("Invalid Course ID!");</script>';
				echo "not found";
			} else {
				$queryinsert = 'INSERT INTO enrollcourse VALUES("'.$person.'", "'.$_REQUEST["course"].'")';
				if (!mysqli_query($con, $queryinsert)) {
					die("Error: insert failed" . mysqli_error($con));
				}
				echo '<script type="text/javascript">alert("Course Enrolled Successfully!");</script>';
			}
		}
	}

?>