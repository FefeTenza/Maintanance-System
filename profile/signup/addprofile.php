<?php
session_start();

$password = '';$confirm_password='';
if(isset($_REQUEST['ConfirmPassword'])) { 
$password = $_REQUEST['Passwords'];
$confirm_password = $_REQUEST['ConfirmPassword'];
if ($password != $confirm_password){
    $_SESSION['error'] = TRUE;
    header("Location:signup.php");
    exit();
    }
else{
$_SESSION['error'] = FALSE;
}
}


require_once("config.php");
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

$role = $_SESSION['Roles'] ?? null;


  // Collect form data
  $username = $conn->real_escape_string($_REQUEST['Username']?? null) ;
  $password = $conn->real_escape_string($_REQUEST['Passwords']?? null) ;
  $confirm_password = $conn->real_escape_string($_REQUEST['ConfirmPassword']?? null) ;
  $fname = $conn->real_escape_string($_REQUEST['FirstName']?? null) ; 
  $lname = $conn->real_escape_string($_REQUEST['LastName']?? null) ; 
  $stuno = $conn->real_escape_string($_REQUEST['StudentNumber']?? null) ;
  $stano = $conn->real_escape_string($_REQUEST['StaffNumber']?? null) ;
  $email = $conn->real_escape_string($_REQUEST['email']?? null) ; 
  $hall = $conn->real_escape_string($_REQUEST['hall']?? null) ; 
  $res = $conn->real_escape_string($_REQUEST['Residence']?? null) ; // Residence from form



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    $users = $conn->query("INSERT INTO user (Username, Passwords, Roles) VALUES ('$username', sha1('$password'), '$role')"); //roles
    if ($users === false) {
        die("Query failed to execute: " . $conn->error);
    }

    if ($role === "Student"){
        $student = $conn->query("INSERT INTO student (Student_Number, First_Name, Last_Name, Email, Username, Residence) VALUES ( '$stuno', '$fname', '$lname', '$email', '$username', '$res')");
        if($student === false){
            die("Query failed to execute: " . $conn->error);
        }else{
            header('Location: ..\\login\login.html');
            exit();
    
        }
    } elseif ($role === "Warden"){
        $warden = $conn->query("INSERT INTO warden (Staff_No, First_Name, Last_Name, Email, Username) VALUES ( '$stano', '$fname', '$lname', '$email', '$username')");
        if($warden === false){
            die("Query failed to execute: " . $conn->error);
        }else{
            header('Location: ..\\login\login.html');
            exit();
    
        }
    }elseif ($role === "Secretary"){
        $secretary = $conn->query("INSERT INTO secretary (Staff_No, First_Name, Last_Name, Email, Username) VALUES ( '$stano', '$fname', '$lname', '$email', '$username')");
        if($secretary === false){
            die("Query failed to execute: " . $conn->error);
        }else{
            header('Location: ..\\login\login.html');
            exit();
    
        }
    }else{
        $maintenance = $conn->query("INSERT INTO maintenance_staff (Staff_Number, First_Name, Last_Name, Email, Username) VALUES ( '$stano', '$fname', '$lname', '$email', '$username')");
        if($maintenance === false){
            die("Query failed to execute: " . $conn->error);
        }else{
            header('Location: ..\\login\login.html');
            exit();
    
        }
    }

    $conn->close();

?>

