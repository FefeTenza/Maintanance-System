<?php

//start session
session_start();
//get values from form
require_once("config.php");

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE); 

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = "John123";
$password = "Shhh#43";
$role = "Student";

$sql = "SELECT * FROM user WHERE username = $username";

//check if the username and password match
if($username === "John123" && $password === "Shhh#43" && $role === "Student"){
    //user exists
   
    //set session variable to allow access to webpages
    $_SESSION['access'] = "yes";
    $_SESSION['username'] = $username;
    $_SESSION['Roles'] = $role;
    
    
    //direct user to appropriate webpage
    header("Location:View_Tickets.php");
    exit();
} else {
    header("Location:login.html");
    exit();
}

?>



<!-- <?php
session_start();

require_once("config.php");

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE); 

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $conn->real_escape_string($_REQUEST['username']);
$password = $conn->real_escape_string($_REQUEST['password']);

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password ";

$result = $conn -> query($sql);
    //check if query is successful
    if($result === FALSE){
        die("<p class=\"error\">Unable to retrieve data!</p>");
    }

if($result->num_rows == 1){
    $_SESSION['access'] = "yes";

        header("Location:profile.php");
    } else {
        header("Location:login.html");
    
}
?> -->
<
 


   
</body>
</html>