<?php
session_start();
if (!isset($_SESSION['access'])) {
      header("Location:..\profile\login\login.html");
}


?> 

<?php
if (isset($_REQUEST['submit'])) {
      $servername = "is3-dev.ict.ru.ac.za";
      $username = "OrderoftheHexes";
      $password = "O6ttC2G0";
      $database = "OrderoftheHexes";

      $conn = new mysqli($servername, $username, $password, $database);

      $days = date("y/m/d");
      $da = date("y/m/d");
      $yes = $_SESSION['username'];
      $desc = $conn->real_escape_string($_REQUEST['des']);
      $stats = $conn->real_escape_string($_REQUEST['status']);
      $hell = $conn->real_escape_string($_REQUEST['ah']);

      if($_SESSION['Roles'] == 'Student' && $stats == 'Delete'){
      $sql = "UPDATE ticket SET Status_Update = '$stats' where Ticket_ID = '$hell'";
      $result = mysqli_query($conn, $sql);}

      if($_SESSION['Roles'] != 'Student'){
      $sql = "UPDATE ticket SET Status_Update = '$stats' where Ticket_ID = '$hell'";
      $result = mysqli_query($conn, $sql);}

      if (!empty($desc)) {
      $con3 = new mysqli($servername, $username, $password, $database);
      $sql = "INSERT INTO comment (Username, Content, Ticket_ID, Date)
VALUES ('$yes', '$desc', '$hell', '$days')";
      $result = $con3->query($sql);
      }

      //echo "<p class = \"success\"> The record was successfully updated</p>";
}

$servername = "is3-dev.ict.ru.ac.za";
$username = "OrderoftheHexes";
$password = "O6ttC2G0";
$database = "OrderoftheHexes";

if ($stats == 'Closed') {
      $con5 = new mysqli($servername, $username, $password, $database);
      $sql = " UPDATE ticket SET  DateClosedBy = '$da' where Ticket_ID = '$hell'";
      $result = mysqli_query($con5, $sql);
}

if ($stats == 'Delete') {

      $con6 = new mysqli($servername, $username, $password, $database);
      $sql = "SELECT * FROM photos where Ticket_ID = '$hell'";
      $result = mysqli_query($con6, $sql);

      if (mysqli_num_rows($result)<1){

            $con5 = new mysqli($servername, $username, $password, $database);
            $sql = "DELETE FROM ticket where Ticket_ID = '$hell'";
            $result = mysqli_query($con5, $sql);

      }else {
            $con6 = new mysqli($servername, $username, $password, $database);
            $sql = "DELETE FROM photos where Ticket_ID = '$hell'";
            $result = mysqli_query($con6, $sql);
      
            $con5 = new mysqli($servername, $username, $password, $database);
            $sql = "DELETE FROM ticket where Ticket_ID = '$hell'";
            $result = mysqli_query($con5, $sql);
      }
}
// WAS SUCCCESSFUL AND CHANGE VARIABLE
if ($result === true) {
      $_SESSION['error'] = TRUE;
      if ($_SESSION['Roles'] === 'Warden') {
            header("Location:mtw.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Secretary') {
            header("Location:mts.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Maintenance') {
            header("Location:mtm.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Student') {
            header("Location:stu.php");
            exit();
      }
} else {
      $_SESSION['error'] = FALSE;
      if ($_SESSION['Roles'] === 'Warden') {
            header("Location:mtw.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Secretary') {
            header("Location:mts.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Maintenance') {
            header("Location:mtm.php");
            exit();
      } elseif ($_SESSION['Roles'] === 'Student') {
            header("Location:stu.php");
            exit();
      }
}

?>