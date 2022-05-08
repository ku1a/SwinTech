<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Tony Lam">
    <meta name="keywords" content="MySQL, change, update, delete, database">
    <meta name="description" content="change or delete EOIs">
    <title>Result</title>
</head>
<body>
    <h1>Result:</h1>
    <?php
    //function borrowed from week 9 sample code: process.php
    //puts in a variable input data and negates SQL injection
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    require_once ("settings.php"); //credentials for connection

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);//Connection to database assigned to variable
    
    $sql_table = "eoi"; //tablename

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    }
    else {
        if (isset($_POST["delete"])) { //Checks if delete form section was used ----------------------------------------/
            $delete = $_POST["delete"];
            $sql_table = "eoi";
            $query = "DELETE FROM $sql_table WHERE job_reference = '$delete'"; //Lecture notes & w3schools.com

            $result = mysqli_query($conn, $query);
            if(!$result) { //If connection doesn't go through
                echo "<p>Something is wrong with $query</p>";
            }
            else {
                echo "<p>All data under $delete has been deleted</p>";
            }
        }
        else if (isset($_POST["status"])){ //Checks if update form section was used-------------------------------------/
            $status = $_POST["status"];
            $eoi = $_POST["eoi"];
            $eoi = sanitise_input($eoi);  
            $query = "UPDATE $sql_table SET data_status='$status' WHERE eoi_number='$eoi'"; //Coding borrowed from week 10 sample code pwsd change

            $result = mysqli_query($conn, $query);
            if(!$result) { //If connection doesn't go through
                echo "<p>Something is wrong with $query</p>";
            }
            else {
                echo "<p>Updated User:$eoi status to $status.</p>";
            }
        }
        else {
            header ('location:manage.php'); //If user tries direct connection to this page, they will be redirected to manager
        }        
        mysqli_close($conn);
    }
?>
</body>
</html>