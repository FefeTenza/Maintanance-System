<?php
if(isset($_REQUEST['Login'])){

session_start();

require_once("config.php");
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

$Username = $conn->real_escape_string($_REQUEST['Username']);
$Passwords = $conn->real_escape_string($_REQUEST['Passwords']);


if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT * FROM user WHERE Username = '$Username' AND Passwords = sha1('$Passwords') ";
$result= $conn->query($sql);

if($result=== FALSE){
    die("<p class=\" error\"> Log In Failed </p>");
}else{

$row = mysqli_fetch_assoc($result);
$user= $row['Username'];
$role = $row['Roles'];
}

if ($Username == $user  && isset($row['Passwords']))
{
    $_SESSION['access']= "yes";
    $_SESSION['username'] = $user;
    //ECHO $_SESSION['username'];
    $_SESSION['Roles'] = $role;
    //echo $_SESSION ['Roles'];
    header("Location:..\dashboard\dashboard.php");
    exit();  
    
}else {
    $_SESSION['error'] = "Log In Failed";
    header("Location:login.html");
    exit();

}
}

$conn->close();

?>