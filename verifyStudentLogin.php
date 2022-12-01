
<?php 
    require_once 'database.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $con = database::connect();


    $query = "SELECT username, password, studentID FROM student WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    if(!$result) {
        die("Query Failed");
    } 
    else 
    {
        $row = mysqli_fetch_assoc($result);
        if(!$row){
            echo json_encode("");
        } else {
            echo json_encode($row['studentID']); 
        }
    }

    mysqli_free_result($result);

?>