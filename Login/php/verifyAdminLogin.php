
<?php 
    require_once '../../database.php';

    //Variables used to store information from the HTML inputs
    $username = $_POST["username"];
    $password = $_POST["password"];
    $con = database::connect();


    $query = "SELECT adminID, password FROM administrator WHERE adminID = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    if(!$result) {
        die("Query Failed");
    } else {
        $row = mysqli_fetch_assoc($result);
        if(!$row){
            echo json_encode(""); //If the row is empty, i.e. the admin does not exist, return nothing
        } else {
            echo json_encode($row['adminID']); //If the admin exists, return the adminId
        }
    }

    mysqli_free_result($result);

?>