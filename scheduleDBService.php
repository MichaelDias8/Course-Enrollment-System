<?php
    require_once 'database.php';
    $con = database::connect();
    
    switch ($_POST["function"])
    {
        case "get_course_list":
            get_course_list();
            break;

        case "get_schedule":
            get_schedule();
            break;
    }

    function get_course_list(){
        global $con;
        $results = array();
        //Get first semester courses
        $sem1query = "SELECT courseName, profFirstName, profLastName FROM student, course, enrollcourse WHERE course.startDate LIKE '%-09-%' AND student.studentID = enrollcourse.studentID AND course.courseID = enrollcourse.courseID AND student.studentID = '" . $_POST['studentID'] . "'";
        $result = mysqli_query($con, $sem1query);
        if(!$result) {
            die("Get schedule query failed.");
        }
        $sem1courses = "";
        while($row = mysqli_fetch_assoc($result)) {
            $sem1courses = $sem1courses . "<p>" . $row['courseName'] . ' with ' . $row['profFirstName'] . ' ' . $row['profLastName'] .  "<p>";
        }
        array_push($results, $sem1courses);

        //Get second semester courses
        $sem2query = "SELECT courseName, profFirstName, profLastName FROM student, course, enrollcourse WHERE course.endDate LIKE '%-04-%' AND student.studentID = enrollcourse.studentID AND course.courseID = enrollcourse.courseID AND student.studentID = '" . $_POST['studentID'] . "'";
        $result = mysqli_query($con, $sem2query);
        if(!$result) {
            die("Get schedule query failed.");
        }
        $sem2courses = "";
        while($row = mysqli_fetch_assoc($result)) {
            $sem2courses = $sem2courses . "<p>" . $row['courseName'] . ' with ' . $row['profFirstName'] . ' ' . $row['profLastName'] .  "<p>";
        }
        array_push($results, $sem2courses);
        echo json_encode($results);
    }

    function get_schedule(){
        global $con;
        $results = array();
        //Get first semester courses
        $sem1query = "SELECT courseName, weekday, startTime, endTime FROM student, course, enrollcourse, daysofweek WHERE course.startDate LIKE '%-09-%' AND student.studentID = enrollcourse.studentID AND course.courseID = enrollcourse.courseID AND student.studentID = '" . $_POST['studentID'] . "' AND course.courseID = daysofweek.courseID";
        $result = mysqli_query($con, $sem1query);
        if(!$result) {
            die("Get schedule query failed.");
        }
        $sem1courses = array("", "", "", "", "");
        while($row = mysqli_fetch_assoc($result)) {
            $stringToAdd = '<div class="class-time-block">
                                <p>' . $row['courseName'] . '</p>' . '<p class="class-time">' . $row['startTime'] . ' - ' . $row['endTime'] . '</p>
                            </div>';
            switch($row['weekday'])
            {
                case "Monday":
                    $sem1courses[0] .= $stringToAdd;
                    break;
                case "Tuesday":
                    $sem1courses[1] .= $stringToAdd;
                    break;
                case "Wednesday":
                    $sem1courses[2] .= $stringToAdd;
                    break;
                case "Thursday":
                    $sem1courses[3] .= $stringToAdd;
                    break;
                case "Friday":
                    $sem1courses[4] .= $stringToAdd;
                    break;
            }
        }
        array_push($results, $sem1courses);

        $sem2query = "SELECT courseName, weekday, startTime, endTime FROM student, course, enrollcourse, daysofweek WHERE course.endDate LIKE '%-04-%' AND student.studentID = enrollcourse.studentID AND course.courseID = enrollcourse.courseID AND student.studentID = '" . $_POST['studentID'] . "' AND course.courseID = daysofweek.courseID";
        $result = mysqli_query($con, $sem2query);
        if(!$result) {
            die("Get schedule query failed.");
        }
        $sem2courses = array("", "", "", "", "");
        while($row = mysqli_fetch_assoc($result)) {
            $stringToAdd = '<div class="class-time-block">
                                <p>' . $row['courseName'] . '</p>' . '<p class="class-time">' . $row['startTime'] . ' - ' . $row['endTime'] . '</p>
                            </div>';
            switch($row['weekday'])
            {
                case "Monday":
                    $sem2courses[0] .= $stringToAdd;
                    break;
                case "Tuesday":
                    $sem2courses[1] .= $stringToAdd;
                    break;
                case "Wednesday":
                    $sem2courses[2] .= $stringToAdd;
                    break;
                case "Thursday":
                    $sem2courses[3] .= $stringToAdd;
                    break;
                case "Friday":
                    $sem2courses[4] .= $stringToAdd;
                    break;
            }
        }
        array_push($results, $sem2courses);
        echo json_encode($results);
    }
?>