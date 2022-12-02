<?php
    require_once '../../../database.php';
    $con = database::connect();
    
    switch ($_POST["function"])
    {
        case "get_module_options":
            get_module_options();
            break;
        case "get_courses":
            get_courses();
            break;
    }

    function get_module_options() 
    {
        global $con;
        $query = "SELECT * FROM subject";
        $result = mysqli_query($con, $query);
        if(!$result) {
            die("Get modules query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=" . $row['subjectID'] . ">" . $row['subjectName'] . "</option>";
        }
    }

    function get_courses() 
    {
        $courseName = "courseName LIKE '%" . $_POST['courseName'] . "%'";

        $semester = $_POST['semester'];
        switch($semester)
        {
            case "first-semester":
                $semester = " AND startDate LIKE '%-09-%' AND endDate LIKE '%-12-%' ";
                break;

            case "second-semester":
                $semester = " AND startDate LIKE '%-01-%' AND endDate LIKE '%-04-%'";
                break;

            case "summer":
                $semester = " AND startDate LIKE '%-05-%' AND endDate LIKE '%-8-%'";
                break;

            case "full-year":
                $semester = " AND startDate LIKE '%-09-%' AND endDate LIKE '%-04-%'";
                break;
                
            case "0":
            case "any":
                $semester = "";
                break;
        }

        $module = $_POST['module'];
        if($module != '-1' && $module != '0') {
            $module = " AND belongto = " . $module;
        } else {
            $module = "";
        }

        $year = $_POST['year'];
        if($year != '0') {
            $year = " AND courseName REGEXP '.*" . $year . "[0-9][0-9][0-9].*'";
        }else if ($year == '5+') {
            $year = " AND courseName REGEXP '.*[5-9][0-9][0-9][0-9].*'";
        } else {
            $year = "";
        }

        global $con;
        
        $query = 'SELECT courseID, courseName FROM course WHERE ' . $courseName . $semester . $module  . $year;
        $result = mysqli_query($con, $query);
        if(!$result) {
            die("Get courses query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            echo '<button class="course-button" data-courseID="' . $row['courseID'] . '">' . $row['courseName'] . '</button>';
        }
    }
?>