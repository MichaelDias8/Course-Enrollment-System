<!-- This file connects the database to retrieve necessary information about dropping a course.
It displays the dropping result and the new course schedule on the screen based on certain actions. -->

<?php

	require_once '../../../database.php';
	$con = database::connect();
    
    switch ($_REQUEST["function"])
    {
        case "print_courses":
			print_courses();						// show all enrolled courses before dropping
            break;
        case "drop_course":
            drop_course();							// perform dropping
            break;
    }
	
	function print_courses() 
    {
		global $con;
		$count = 0;
		$person = $_REQUEST["person"];					// get the student ID
        $querycheck = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";		// find all courses enrolled by student
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		
		echo "Courses you have enrolled:<br>";		// display all enrolled courses
		echo "<table align='center' border='1' width='100%'>";
		echo "<tr><td>" . "course ID" . "</td><td>" . "Course Name" . "</td><td>" . "Start Date" . "</td><td>" . "End Date" . "</td><td>" . "Professor First Name" . "</td><td>" . "Professor Last Name" . "</td></tr>";
		while($row = mysqli_fetch_array($check)) {
			echo "<tr><td>" . htmlspecialchars($row['courseID']) . "</td><td>" . htmlspecialchars($row['courseName']) . "</td><td>" . htmlspecialchars($row['startDate']) . "</td><td>" . htmlspecialchars($row['endDate']) . "</td><td>" . htmlspecialchars($row['profFirstName']) . "</td><td>" . htmlspecialchars($row['profLastName']) . "</td></tr>";
		}
		echo "</table>";
	}
	 
	function drop_course()
	{
		$found = false;
		echo $found;
		global $con;
		$person = $_REQUEST["person"];
        $querycheck = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";		// check whether student is dropping a course that is in the schedule
		$check = mysqli_query($con, $querycheck);
		if(!$check) {
            die("Get course info query failed.");
        }
		while($row = mysqli_fetch_assoc($check)) {
			if (strcmp($_REQUEST["course"], $row['courseID']) == 0){
				$found = true;
			}
		}
		
		
		if(strcmp($_REQUEST['course'], "") == 0) {				// prompt for input if user does not provide any information
			echo "<span style='color:red;'>Please prompt the course you want to drop.</span> <br>";
			print_courses();									// keep printing all the courses on the screen
			exit();
		} else if (!$found) {									// print error message if course ID is invalid
			echo "<span style='color:red;'>You have not enrolled this course / The course does not exist.</span> <br>";
			print_courses();
			exit();
		} else {
	        $querydate = "SELECT startDate FROM course WHERE courseID = '".$_REQUEST['course']."'";
			
			$resultdate = mysqli_query($con, $querydate);
			if(!$resultdate) {
	            die("Get course info query failed.");
	        }
			
			while($row = mysqli_fetch_array($resultdate)) {		// get the system date
				$date = $row["startDate"];
			}
			
			if (strcmp($date, "2023-09-08") == 0) {				// check whether the course starts from fall or winter
				if (date('Y-m-d') > "2023-10-30") {				// reject to drop the course if student has passed the final dropping date, and the date depends on fall/winter courses
					echo "<span style='color:red;'>You have passed the final dropping date. Failed to drop the selected course.</span> <br>";
					print_courses();
					exit();
				}
			} else {
				if (date('Y-m-d') > "2024-03-05") {				// winter courses
					echo "<span style='color:red;'>You have passed the final dropping date. Failed to drop the selected course.</span> <br>";
					print_courses();
					exit();
				}
			}
		}
			
		$querydrop = 'DELETE FROM enrollcourse WHERE studentID = "'.$person.'" AND courseID = "'.$_REQUEST["course"].'"';	// perform dropping
		if (!mysqli_query($con, $querydrop)) {
			die("Error: insert failed" . mysqli_error($con));
		}
		echo 'Dropped successfully.<br>The courses you currently take: <br>';
			
		$query = "SELECT * FROM course WHERE courseID IN (SELECT courseID FROM enrollcourse WHERE studentID = '".$person."')";	// get the enrolled course after dropping
		$result = mysqli_query($con, $query);
		if(!$result) {
	        die("Get course info query failed.");
	    }
			
		echo "<table align='center' border='1' width='100%'>";		// display courses after dropping
		echo "<tr><td>" . "course ID" . "</td><td>" . "Course Name" . "</td><td>" . "Start Date" . "</td><td>" . "End Date" . "</td><td>" . "Professor First Name" . "</td><td>" . "Professor Last Name" . "</td></tr>";
		while($row = mysqli_fetch_array($result)) {
			echo "<tr><td>" . htmlspecialchars($row['courseID']) . "</td><td>" . htmlspecialchars($row['courseName']) . "</td><td>" . htmlspecialchars($row['startDate']) . "</td><td>" . htmlspecialchars($row['endDate']) . "</td><td>" . htmlspecialchars($row['profFirstName']) . "</td><td>" . htmlspecialchars($row['profLastName']) . "</td></tr>";
		}
		echo "</table>";
	}
?>