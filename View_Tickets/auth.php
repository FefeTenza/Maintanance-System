<?php
if(isset($_REQUEST['Login'])){


session_start();
//$Username  = $_REQUEST['Username'];
//$Password  = $_REQUEST['Password'];

require_once("config.php");
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}
$Username = $conn->real_escape_string($_REQUEST['Username']);
$Passwords = $conn->real_escape_string($_REQUEST['Password']);

$sql = "SELECT * FROM user WHERE Username = '$Username' AND Passwords = '$Passwords' ";
$result= $conn->query($sql);

$row = mysqli_fetch_assoc($result);
$nam = $_REQUEST['Username'];

if($result=== FALSE){
    die("<p class=\" error\"> Log In Failed </p>");
}else 
{
    $_SESSION['access']= "yes";
    $_SESSION['user'] = $nam;
    echo "echo";
    
}


$conn->close();
}
?>