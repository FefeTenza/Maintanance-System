<?php
session_start();

if (!isset($_SESSION['access'])) {
    header("Location:..\profile\login\login.html");
}
 ?> 

<?php
//To submit the query
if(isset($_REQUEST['submit'])){
  //fethes data from the form submitted
  $servername = "is3-dev.ict.ru.ac.za";
  $username = "OrderoftheHexes";
  $password = "O6ttC2G0";
  $database = "OrderoftheHexes";
$yes = $_SESSION['username'];
  $conn = new mysqli($servername, $username, $password, $database);
  
$picture = time() . $_FILES['picture']['name'];
$destination = "image/".$picture;
move_uploaded_file($_FILES['picture']['tmp_name'], $destination);

$pictures = time() . $_FILES['pictures']['name'];
$destinate = "image/".$pictures;
move_uploaded_file($_FILES['pictures']['tmp_name'], $destinate);

  $cate = $_POST['Category'];
  $location = $conn->real_escape_string($_REQUEST['location']);
  $desc = $conn->real_escape_string($_REQUEST['des']);
  $status = "Pending";
  $day = date("y/m/d");

//opening server and assigning roles


//getting the role of the user
$con5 = new mysqli($servername, $username, $password, $database);
$query = "SELECT Roles, Username
From  user
where Username = '$yes'";
$result = $con5->query($query);

$row =  mysqli_fetch_assoc($result); 
$Role = $row['Roles']; 
$con5-> close();

if ($Role == "Warden"){
  
  $query = "SELECT Staff_No, Username
  From  warden
  where Username = '$yes'";
  $result = $conn->query($query);
  
  $row =  mysqli_fetch_assoc($result); 
  $Warden_ID = $row['Staff_No']; 

  
  $con2 = new mysqli($servername, $username, $password, $database);
  $query = "SELECT Residence_ID, Warden_ID
  from residence
  where Warden_ID = '$Warden_ID'";
  $result = $con2->query($query);
  
  $row =  mysqli_fetch_assoc($result);
  $Residence_ID = $row['Residence_ID'];

  
  $con4 = new mysqli($servername, $username, $password, $database);
  $sql = "INSERT INTO ticket (textDescription, Status_Update, Residence_ID, CategoryFault, Locations,Warden_ID, DateReportedBy)
  VALUES ('$desc', '$status', '$Residence_ID', '$cate', '$location','$Warden_ID','$day')";
  $result = $con4->query($sql);
  
  if (strpos($picture, '.') !== false){
    $con2 = new mysqli($servername, $username, $password, $database);
    $query = "SELECT Ticket_ID FROM ticket ORDER BY Ticket_ID DESC LIMIT 1;";
    $result = $con2->query($query);
  
    $row =  mysqli_fetch_assoc($result);
    $ticket_ID = $row['Ticket_ID'];
  
      //storing photo 1
      $con6 = new mysqli($servername, $username, $password, $database);
      $sql = "INSERT INTO photos (Photo_Address, Photo_Name, Ticket_ID, User_ID)
      VALUES ('$destination', '$picture', '$ticket_ID','$yes')";
      $result = $con6->query($sql);
    }else{}

    if (strpos($pictures, '.') !== false){
      $con2 = new mysqli($servername, $username, $password, $database);
      $query = "SELECT Ticket_ID FROM ticket ORDER BY Ticket_ID DESC LIMIT 1;";
      $result = $con2->query($query);
    
      $row =  mysqli_fetch_assoc($result);
      $ticket_ID = $row['Ticket_ID'];
    
        //storing photo 2
        $con6 = new mysqli($servername, $username, $password, $database);
        $sql = "INSERT INTO photos (Photo_Address, Photo_Name, Ticket_ID, User_ID)
        VALUES ('$destinate', '$pictures', '$ticket_ID','$yes')";
        $result = $con6->query($sql);
      }else{}
  

  }else if($Role == "Student"){
  
  $conn = new mysqli($servername, $username, $password, $database);
  $query = "SELECT Residence, Student_Number, Username
  From  student
  where Username = '$yes'";
  $result = $conn->query($query);
  
  $row =  mysqli_fetch_assoc($result); 
  $Student_ID = $row['Student_Number']; 
  $res = $row['Residence'];

  
  
  $con2 = new mysqli($servername, $username, $password, $database);
  $query = "SELECT Residence_ID, Warden_ID, Residence_Name
  from residence 
  where Residence_Name = '$res'";
  $result = $con2->query($query);
   
  $row =  mysqli_fetch_assoc($result);
  $Residence_ID = $row['Residence_ID'];
  $Warden_ID= $row['Warden_ID'];
  //$con2 -> close();
  
  $con4 = new mysqli($servername, $username, $password, $database);
  $sql = "INSERT INTO ticket (textDescription, Status_Update, Residence_ID, CategoryFault, Locations,Warden_ID, DateReportedBy , Student_ID)
  VALUES ('$desc', '$status', '$Residence_ID', '$cate', '$location','$Warden_ID','$day', '$Student_ID')";
  $result = $con4->query($sql);


  if (strpos($picture, '.') !== false){
  $con2 = new mysqli($servername, $username, $password, $database);
  $query = "SELECT Ticket_ID FROM ticket ORDER BY Ticket_ID DESC LIMIT 1;";
  $result = $con2->query($query);

  $row =  mysqli_fetch_assoc($result);
  $ticket_ID = $row['Ticket_ID'];

    //storing the photo
    $con6 = new mysqli($servername, $username, $password, $database);
    $sql = "INSERT INTO photos (Photo_Address, Photo_Name, Ticket_ID, User_ID)
    VALUES ('$destination', '$picture', '$ticket_ID','$yes')";
    $result = $con6->query($sql);
  }else{}

  if (strpos($pictures, '.') !== false){
    $con2 = new mysqli($servername, $username, $password, $database);
    $query = "SELECT Ticket_ID FROM ticket ORDER BY Ticket_ID DESC LIMIT 1;";
    $result = $con2->query($query);
  
    $row =  mysqli_fetch_assoc($result);
    $ticket_ID = $row['Ticket_ID'];
  
      //storing photo 2
      $con6 = new mysqli($servername, $username, $password, $database);
      $sql = "INSERT INTO photos (Photo_Address, Photo_Name, Ticket_ID, User_ID)
      VALUES ('$destinate', '$pictures', '$ticket_ID','$yes')";
      $result = $con6->query($sql);
    }else{}
  }
  
}

if ($result === true) {
  $_SESSION['error'] = TRUE;
  if ($_SESSION['Roles'] === 'Warden') {
        header("Location:ct.php");
        exit();
  } elseif ($_SESSION['Roles'] === 'Student') {
        header("Location:ct.php");
        exit();
  }
} else {
  $_SESSION['error'] = FALSE;
  if ($_SESSION['Roles'] === 'Warden') {
        header("Location:ct.php");
        exit();
  } elseif ($_SESSION['Roles'] === 'Student') {
        header("Location:ct.php");
        exit();
  }
}

?>


