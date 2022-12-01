
<?php 
    require_once 'database.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $con = database::connect();


    $query = "SELECT adminID, password FROM administrator WHERE adminID = '$username' AND password = '$password'";
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
            echo json_encode($row['adminID']); 
        }
    }

    mysqli_free_result($result);

?>