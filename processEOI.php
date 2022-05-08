<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="process expressions of interest"/>
    <meta name="keywords" content="PHP, File, input, output" />
    <title>EOI Confirmation</title>
</head> 
<body>
    <h1>Job Process Confirmation:</h1>
<?php
    //function borrowed from week 9 sample code: process.php
    //puts in a variable input data and negates SQL injection
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	if (isset($_POST["jobRef"])) {
        $err_msg="";
        //Define all inputs as variables from $_POST if jobRef exists (which should almost always)
        $jobRef = $_POST["jobRef"];
		$first_name = $_POST["firstname"];
		$last_name = $_POST["lastname"];
        $email = $_POST["email"];
        $dob = $_POST["dob"];
        //$gender = $_POST["gender"]; This variable has been defined below
        $address = $_POST["address"];
        $state = $_POST["State"];
        $suburb = $_POST["suburb/town"];
        $post = $_POST["postcode"];
        $phone = $_POST["phone"];
        $otherskill = $_POST["otherskill"];
        $otherskill = sanitise_input($otherskill);
        $status = "New";
        
        //Validation for each input above. Code inspired by process.php in sample code of week 9
		//If firstname is empty
		if (trim($first_name)=="")
			$err_msg .= "<p>Please enter first name.</p>";
		else {
			$first_name=sanitise_input($first_name);
			if (!preg_match("/^[a-zA-Z]{0,20}$/",$first_name)){
				$err_msg .= "<p>Only letters are allowed in first name.</p>";
        }
        
        //If last name is empty
        if (trim($last_name)=="")
		$err_msg .= "<p>Please enter last name. </p>";
	    else {
		$last_name=sanitise_input($last_name);
		if (!preg_match("/^[a-zA-Z]{0,20}$/",$last_name)){
			$err_msg .= "<p>Only letters are allowed in last name.</p>";
		}
        }

        //If jobRef empty
        if (trim($jobRef)=="") 
        $err_msg .= "<p>Please apply through jobs.php to obtain a valid reference number.</p>";
        else {
        $jobRef=sanitise_input($jobRef);
        if (!preg_match("/^[a-zA-Z0-9]{0,5}$/",$jobRef)){
            $err_msg .="<p>Only letters and numbers allowed in job reference.<p>";
        }
        }
        
        //Checks for valid email:
        $email=sanitise_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $err_msg .= "<p>Email is not valid.</p>";
        }

        //checks that gender exists
        if (!isset($_POST["gender"])){
            $err_msg .= "<p>Please select your gender</p>";
        }
        else $gender = $_POST["gender"];
        
        //Date of birth validation, creates age if meets validation, then validates the age:
        if (trim($dob)=="") 
            $err_msg .= "<p>Please enter your date of birth.</p>";
        else {
            $dob = sanitise_input($dob);
            if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $dob)) {
                $err_msg .= "<p>Please enter date of birth in format dd/mm/yyyy.</p>";
            }
            else { //If date of birth is OK, proceeds to process it as an age number in years
                $dob=explode("/", $dob);
                $dob=$dob[2] . "-" . $dob[1] . "-" . $dob[0];
                $dateDob = date_create($dob);
                $dateNow = date_create();
                $age = date_diff($dateDob, $dateNow);
                $age = date_interval_format($age, "%Y");
                if ($age > 80) { //If more than 80: denied
                    $err_msg .= "<p>Your age must be less than 80 to apply.</p>";
                }
                else if ($age < 15) { //If less than 15: denied
                    $err_msg .= "<p>Your age must be more than 15 to apply.</p>";
                }
            }
        }

        //Address validation:
        if (trim($address)=="")
            $err_msg .= "<p>You must enter an address.</p>";
        else {
            $address = sanitise_input($address);
            if (!preg_match("/^[a-zA-Z0-9 ]{0,40}$/", $address)){
                $err_msg .= "<p>Max 40 characters in your street address.</p>";
            }
        }

        //Suburb validation:
        if (trim($suburb)=="")
            $err_msg .= "<p>You must enter a suburb or town.</p>";
        else {
            $suburb = sanitise_input($suburb);
            if (!preg_match("/^[a-zA-Z0-9 ]{0,40}$/", $suburb)){
                $err_msg .= "<p>Max 40 characters in your suburb / town.</p>";
            }
        }

        //Phone number validation
        if (trim($phone)=="")
            $err_msg .= "<p>You must enter a phone number 8-12 digits.</p>";
        else {
            $phone = sanitise_input($phone);
            if (!preg_match("/^[0-9 ]{8,12}$/", $phone)){ //  Or /^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/ 
                $err_msg .= "<p>Phone number must be between 8-12 numeric characters.</p>";
            }
        }

        //Postcode validation
        if(trim($post)=="")
            $err_msg .= "<p>You must enter your postcode.</p>";
        else {
            $post = sanitise_input($post);
            if (!preg_match("/^[0-9]{4}$/", $post)) {
                $err_msg .= "<p>Your postcode must contain only 4 numeric characters.</p>";
            }
        }

        //Validate postcode to state
        $postregex = "";
        if (!isset($_POST["State"]) || $state=="none") {
            $err_msg .= "<p>Please select your state.</p>";
        }
        else {
            $state = $_POST["State"];
        } //Regex changes based on selected state in the selection input previous
        if (trim($state)=="VICTORIA") 
            $postregex = "/^(3|8)\d+$/";
        else if (trim($state)=="NEW SOUTH WALES") 
            $postregex = "/^(1|2)\d+$/";
        else if (trim($state)=="QUEENSLAND") 
            $postregex = "/^(4|9)\d+$/";
        else if (trim($state)=="NORTHERN TERRITORY") 
            $postregex = "/^0\d+$/";
        else if (trim($state)=="WESTERN AUSTRALIA") 
            $postregex = "/^6\d+$/";
        else if (trim($state)=="SOUTH AUSTRALIA") 
            $postregex = "/^5\d+$/";
        else if (trim($state)=="TASMANIA") 
            $postregex = "/^7\d+$/";
        else if (trim($state)=="AUSTRALIAN CAPITAL TERRITORY") 
            $postregex = "/^0\d+$/";    

        if (!preg_match($postregex, $post)) { //Function to compare a variable string to regex
            $err_msg .= "<p>Your postcode does not match your selected State.</p>";
        }

        $skills = ""; //Checks if any of the checkboxes have been ticked, adding values to a skills variable to be added to database
        if (isset ($_POST["organise"])) $skills = $skills . "Organised;";
        if (isset ($_POST["punctual"])) $skills = $skills . "Punctual;";
        if (isset ($_POST["writing"])) $skills = $skills . "Writing;";
        if (isset ($_POST["passionate"])) $skills = $skills . "Passionate;";
        if (isset ($_POST["math"])) $skills = $skills . "Mathematics;";
        if (isset ($_POST["problemsolve"])) $skills = $skills . "Problem Solving;";
        if (isset ($_POST["communicative"])) $skills = $skills . "Communicative;";
        if (isset ($_POST["other"])) $skills = $skills . "Other;";
        else if ($skills = "") {
            $err_msg .= "<p>You must tick at least one of the skills boxes.</p>";
        }

        //If other checkbox is ticked, but no comments made: denied
        if ((isset ($_POST["other"])) && ($otherskill == "")) {
            $err_msg .= "<p>You must detail any other skill you have if 'other' has been ticked.</p>";
        }
        //If comments made, but other checkbox not ticked: denied
        else if (!isset($_POST["other"]) && ($otherskill !="")) {
            $err_msg .= "<p>You must tick 'other' if comments were made.</p>";
        }
        if (!$err_msg=="") {
            echo $err_msg;
        } //If error message is empty, create connection and begin database queries
        else {
            require_once ("settings.php");
            $conn = @mysqli_connect($host,
            $user,
            $pwd,
            $sql_db
            );
            if (!$conn){
                echo "<p>Database connection failure</p>";
            }
            else { //Successful connection queries all variables to be put into eoi table in database
            $sql_table = "eoi";

            $query = "insert into $sql_table (job_reference, firstname, lastname, email, gender, birthdate, user_address, suburb, aus_state, postcode, phone, skills, otherskill, data_status) values ('$jobRef', '$first_name', '$last_name', '$email', '$gender', '$dob', '$address', '$suburb', '$state', '$post', '$phone', '$skills', '$otherskill', '$status')";
            
            $result = mysqli_query($conn, $query);

            if(empty($result)) { //If unable to insert due to empty result (table non-existing), create a table "eoi". empty used from w3schools.com
            $query = "CREATE TABLE $sql_table (
                        eoi_number INT(4) NOT NULL AUTO_INCREMENT,
                        job_reference CHAR(5) NOT NULL,
                        firstname VARCHAR(20) NOT NULL, 
                        lastname VARCHAR(20) NOT NULL,
                        email VARCHAR(40) NOT NULL,
                        gender VARCHAR(10) NOT NULL, 
                        birthdate VARCHAR(20) NOT NULL,
                        user_address VARCHAR(40) NOT NULL,
                        suburb VARCHAR(40) NOT NULL,
                        aus_state VARCHAR(40) NOT NULL,
                        postcode INT(4) NOT NULL,
                        phone VARCHAR(12) NOT NULL,
                        skills VARCHAR(200) NOT NULL,
                        otherskill VARCHAR(500) NOT NULL,
                        data_status VARCHAR(20) NOT NULL,
                        PRIMARY KEY (eoi_number)
                    )";
                    //eoi number and status are not inputs, they are predefined. EOI auto increments which creates a unique number for each entry
            $result = mysqli_query($conn, $query); //If the table has been created, prompt this message
            echo "<p>Table $sql_table does not exist. Creating new table for $sql_table</p>";
            if ($result) { //Otherwise, query an insert with all inputs made by user into variable columns
                $query = "insert into $sql_table (job_reference, firstname, lastname, email, gender, birthdate, user_address, suburb, aus_state, postcode, phone, skills, otherskill, data_status) values ('$jobRef', '$first_name', '$last_name', '$email', '$gender', '$dob', '$address', '$suburb', '$state', '$post', '$phone', '$skills', '$otherskill', '$status')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "<p>Something is wrong with the $query";
                }
                else
                echo "<p>Data entered into $sql_table successfully</p>";
            }
            }
            else {
                echo "<p>Data entered successfully<p>";
            }
            mysqli_close($conn);
            }
        } 
    }
    }   
    else {
        header ("location:apply.php"); //Redirect if user attempts direct access to this page
    }
?>
</body>
</html>