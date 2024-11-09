
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['access'])) {
    header("Location: login.html");
    exit();
}

require_once("config.php");

// Retrieve data from form inputs
$username = $_REQUEST['username'] ?? null;
$role = $_REQUEST['role'] ?? null;
$fname = $_REQUEST['fname'] ?? null;
$lname = $_REQUEST['lname'] ?? null;
$email = $_REQUEST['email'] ?? null;
$stuno = $_REQUEST['stuno'] ?? null;
$stano = $_REQUEST['stano'] ?? null;
$hall = $_REQUEST['hall'] ?? null;
$res = $_REQUEST['res'] ?? null;

// Check if required fields are provided
if (!$username || !$fname || !$lname || !$email || !$hall || !$res) {
    die("Required fields are missing.");
}

// Database connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
if ($conn->connect_error) {
    die("<p class=\"error\"><strong>Connection failed: Database not available!</strong>" . $conn->connect_error . "</p>");
}

$update_residence = "";

if($role === "Student"){
// Update student's residence
$update_residence = "UPDATE student 
    SET Residence = '$res' 
    WHERE Username = '$username'";

if ($conn->query($update_residence) === TRUE) {
    // Update the hall corresponding to the new residence
    $update_hall_name = "UPDATE hall 
        INNER JOIN residence ON hall.Hall_ID = residence.Hall_ID
        INNER JOIN student ON student.Residence = residence.Residence_Name
        SET hall.Hall_Name = '$hall'
        WHERE student.Username = '$username'";
    if ($conn->query($update_hall_name) === TRUE) {
    // Fetch the updated profile details
    $fetch_user_info = "SELECT * FROM student
        INNER JOIN user ON student.Username = user.Username
        INNER JOIN residence ON student.Residence = residence.Residence_Name
        INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
        WHERE user.Username = '$username'";
    
    $result = $conn->query($fetch_user_info);

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

        // Redirect to the updated page to display updated information
    header("Location: updated.php");
    exit();
    }
}
}
}elseif($role === "Warden"){
    $update_residence = "UPDATE warden
    SET Residence = '$res' 
    WHERE Username = '$username'";

if ($conn->query($update_residence) === TRUE) {
    // Update the hall corresponding to the new residence
    $update_hall_name = "UPDATE hall 
        INNER JOIN residence ON hall.Hall_ID = residence.Hall_ID
        INNER JOIN warden ON warden.Residence = residence.Residence_Name
        SET hall.Hall_Name = '$hall'
        WHERE warden.Username = '$username'";
    if ($conn->query($update_hall_name) === TRUE) {
    // Fetch the updated profile details
    $fetch_user_info = "SELECT * FROM warden
        INNER JOIN user ON warden.Username = user.Username
        INNER JOIN residence ON warden.Residence = residence.Residence_Name
        INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
        WHERE user.Username = '$username'";
    echo "fefe";

    $result = $conn->query($fetch_user_info);

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
        // Redirect to the profile page to display updated information
    header("Location: updated.php");
    exit();
    }
}
}
}elseif($role === "Secretary"){
    $update_residence = "UPDATE secretary
    SET Residence = '$res' 
    WHERE Username = '$username'";

if ($conn->query($update_residence) === TRUE) {
    // Update the hall corresponding to the new residence
    $update_hall_name = "UPDATE hall 
        INNER JOIN residence ON hall.Hall_ID = residence.Hall_ID
        INNER JOIN secretary ON secretary.Residence = residence.Residence_Name
        SET hall.Hall_Name = '$hall'
        WHERE secretary.Username = '$username'";
    if ($conn->query($update_hall_name) === TRUE) {
    // Fetch the updated profile details
    $fetch_user_info = "SELECT * FROM secretary
        INNER JOIN user ON student.Username = user.Username
        INNER JOIN residence ON secretary.Residence = residence.Residence_Name
        INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
        WHERE user.Username = '$username'";
    
    $result = $conn->query($fetch_user_info);

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

        // Redirect to the profile page to display updated information
    header("Location: updated.php");
    exit();
    }
}
}
}else{
    $update_residence = "UPDATE maintenance_staff 
    SET Residence = '$res' 
    WHERE Username = '$username'";

if ($conn->query($update_residence) === TRUE) {
    // Update the hall corresponding to the new residence
    $update_hall_name = "UPDATE hall 
        WHERE maintenance_staff.Username = '$username'";
    if ($conn->query($update_hall_name) === TRUE) {
    // Fetch the updated profile details
    $fetch_user_info = "SELECT * FROM maintenance_staff
        INNER JOIN user ON maintenance_staff.Username = user.Username
        WHERE user.Username = '$username'";
    
    $result = $conn->query($fetch_user_info);

if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

        // Redirect to the profile page to display updated information
    header("Location: updated.php");
    exit();
    }
}
}
}
$conn->close();


?>





