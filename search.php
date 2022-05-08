<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Tony Lam">
    <meta name="keywords" content="database, MySQL, search">
    <meta name="description" content="search or delete data from EOI database">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
    <h1>Search Results</h1>
    <a href="manage.php">Back to Manager</a>
    <?php
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    require_once ("settings.php"); //credentials

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    $sql_table = "eoi";

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    }
    else {
        if(isset($_POST["reference"])) { //IF REFERENCE EXISTS ASSIGN INPUTS TO VARIABLES
            $reference = $_POST["reference"];
            $firstname = $_POST["fname"];
            $firstname = sanitise_input($firstname);
            $lastname = $_POST["lname"];
            $lastname = sanitise_input($lastname);
            $query = "";
            
            //Search all (No other inputs)
            if ($reference=="*" && ($firstname=="") && ($lastname=="")) {
                $query = "select * FROM $sql_table"; 
            } 
            //Select based on job reference ONLY
            else if ($reference!="*"  && $firstname=="" && $lastname=="") {
                $query = "select * FROM $sql_table WHERE job_reference = '$reference'"; 
            }
            //Select based on job reference, firstname AND lastname together
            else if ($reference!="*"  && ($firstname!="" && $lastname!="")) {
                $query = "select * FROM $sql_table WHERE job_reference = '$reference' AND firstname = '$firstname' AND lastname = '$lastname'";
            }
            //Select based on job preference with firstname ONLY
            else if ($reference!="*"  && ($firstname!="" && $lastname=="")) {
                $query = "select * FROM $sql_table WHERE job_reference = '$reference' AND firstname = '$firstname'";
            }
            //Select based on job preference with lastname ONLY
            else if ($reference!="*"  && ($firstname=="" && $lastname!="")) {
                $query = "select * FROM $sql_table WHERE job_reference = '$reference' AND lastname = '$lastname'";
            }
            //Select ALL job references with firstname AND lastname
            else if ($reference="*"  && ($firstname!="" && $lastname!="")) {
                $query = "select * FROM $sql_table WHERE firstname = '$firstname' AND lastname = '$lastname'";
            }
            //Select ALL job references with firstname ONLY
            else if ($reference="*"  && ($firstname!="" && $lastname=="")) {
                $query = "select * FROM $sql_table WHERE firstname = '$firstname'";
            }
            //Select ALL job references with lastname ONLY
            else if ($reference="*" && ($firstname=="" && $lastname!="")) {
                $query = "select * FROM $sql_table WHERE lastname = '$lastname'";
            }

            $result = mysqli_query($conn, $query);

                if (!$result || empty($result)) {
                    echo "<p>Your query: $query was unsuccessful or no data exists for $sql_table.</p>";
                }
                else {
                echo "<table border=\"1\">\n"; //Creates a full table for all EOI numbers. Coding based lab10
                echo "<tr>\n "
                    ."<th scope=\"col\">eoiNumber</th>\n " //Table head here can be named anything, but has to be logical order
                    ."<th scope=\"col\">JobRef</th>\n "
                    ."<th scope=\"col\">firstname</th>\n "
                    ."<th scope=\"col\">lastname</th>\n "
                    ."<th scope=\"col\">email</th>\n "
                    ."<th scope=\"col\">Gender</th>\n "
                    ."<th scope=\"col\">Birthdate</th>\n "
                    ."<th scope=\"col\">Address</th>\n "
                    ."<th scope=\"col\">Suburb</th>\n "
                    ."<th scope=\"col\">State</th>\n "
                    ."<th scope=\"col\">Postcode</th>\n "
                    ."<th scope=\"col\">phone</th>\n "
                    ."<th scope=\"col\">skills</th>\n "
                    ."<th scope=\"col\">Otherskill</th>\n "
                    ."<th scope=\"col\">STATUS</th>\n "
                    ."</tr>\n "; 
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>\n";
                    echo "<td>",$row["eoi_number"],"</td>\n "; //accesses array elements where column name highlighted 
                    echo "<td>",$row["job_reference"],"</td>\n "; //The terms in the array accessor exactly the same as when creating a new table
                    echo "<td>",$row["firstname"],"</td>\n ";
                    echo "<td>",$row["lastname"],"</td>\n ";
                    echo "<td>",$row["email"],"</td>\n ";
                    echo "<td>",$row["gender"],"</td>\n ";
                    echo "<td>",$row["birthdate"],"</td>\n ";
                    echo "<td>",$row["user_address"],"</td>\n ";
                    echo "<td>",$row["suburb"],"</td>\n ";
                    echo "<td>",$row["aus_state"],"</td>\n ";
                    echo "<td>",$row["postcode"],"</td>\n ";
                    echo "<td>",$row["phone"],"</td>\n ";
                    echo "<td>",$row["skills"],"</td>\n ";
                    echo "<td>",$row["otherskill"],"</td>\n ";
                    echo "<td>",$row["data_status"],"</td>\n ";
                    echo "</tr>\n ";
                    }   
                }  
            }
        else {
            header ('location:manage.php'); //redirect if user attempts direct access to this page
        }
        mysqli_close($conn);
    }
    ?>
</body>
</html>