<!-- This file connects to the database and retrieve necessary infomation of student.
It displays the required information on the page, based on certain actions. -->

<?php

	require_once '../../../database.php';	// require to connect to database
	$con = database::connect();
    
    switch ($_REQUEST["function"])
    {
        case "get_course_info":				// when user has input the course ID to search it
            get_course_info();
            break;
        case "add_taken_courses":			// when user wants to add the course
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
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){		// check whether the input course is in the database
				$found = "found";
			}
		}
		
		if (strcmp("found",$found) <> 0) {									// prompt an error message if course does not exist
			echo "<span style='color:red;'>You input an invalid course ID. Please refer the View Course Information Page for valid course IDs.</span> <br>";
			exit();
		} else {
			$course = $_POST['course'];
			$query = "SELECT * FROM course WHERE courseId = '".$course."'";	// display whole information if course exist
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
		$person = $_REQUEST["person"];
		$foundinsert = "not found";
        $querycheck = "SELECT * FROM course";
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($check)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){		// check whether the course ID is a valid one
				$foundinsert = "found";
			}
		}
		
		$dup = false;
        $querydup = "SELECT * FROM enrollcourse";
		$checkdup = mysqli_query($con, $querydup);
		if(!$checkdup) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($checkdup)) {						// check whether student has enrolled the course
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				if (strcmp($person, $row['studentID']) == 0){
					$dup = true;
				}
			}
		}
		
		if ($dup) {											// when student has enrolled the course
			echo "<span style='color:red;'>System detected that you have enrolled this course. Repetive enrollment is not allowed.</span> <br>";
			exit();
		} else {
			if (strcmp("found",$foundinsert) <> 0) {		// if the course cannot be found in the current list of given course
				echo "<span style='color:red;'>You input an invalid course ID. Please refer the View Course Information Page for valid course IDs.</span> <br>";
				exit();
			} else {										// Insert the course (the student has satisfied the conditions of adding a course)
				$queryinsert = 'INSERT INTO enrollcourse VALUES("'.$person.'", "'.$_REQUEST["course"].'")';
				if (!mysqli_query($con, $queryinsert)) {
					die("Error: insert failed" . mysqli_error($con));
				}
				echo "Course enrolled successfully! <br>";
			}
			
			echo "<p><hr><p>";
			global $con;
			$count = 0;
			$person = $_REQUEST["person"];						// get the student ID
	        $querycheck = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";		// check all the courses taken by this student
			$check = mysqli_query($con, $querycheck);
			if(!$check) {
	            die("Get course info query failed.");
	        }
			
			echo "Courses you have enrolled:<br>";			// after enrolled, display all the enrolled courses to show whether the course has been added
			echo "<table align='center' border='1' width='100%'>";
			echo "<tr><td>" . "course ID" . "</td><td>" . "Course Name" . "</td><td>" . "Start Date" . "</td><td>" . "End Date" . "</td><td>" . "Professor First Name" . "</td><td>" . "Professor Last Name" . "</td></tr>";
			while($row = mysqli_fetch_array($check)) {
				echo "<tr><td>" . htmlspecialchars($row['courseID']) . "</td><td>" . htmlspecialchars($row['courseName']) . "</td><td>" . htmlspecialchars($row['startDate']) . "</td><td>" . htmlspecialchars($row['endDate']) . "</td><td>" . htmlspecialchars($row['profFirstName']) . "</td><td>" . htmlspecialchars($row['profLastName']) . "</td></tr>";
			}
			echo "</table>";
		}
	}

?>