<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location:..\profile\login\login.html");
}

 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ticket</title>
    <link rel="stylesheet" href="update.css" />
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />


</head>
<!-- -->

<header id="titlesec">

    <img id="logoimg" src="../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="..\php\home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../About/about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../profile/dashboard/dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm" 
        
        <?php if (isset($_SESSION['username'])):?>
             href='..\profile\dashboard\dashboard.php'> <img id="prfico" src="../images/Profile.png"> <a class="nav_itm" href="..\php\logout.php">Logout </a>
             <?php else: ?>
            href='..\profile\login\login.html'> Login </a>
          <?php endif;?>
        
        
        <!--href="login.php"> Login -->


        </a>
    </nav>

</header>

<body>
<h2> Update Ticket</h2>

<div class = 'ticket'>
<?php
$yes = $_SESSION['username'];
     
$servername = "is3-dev.ict.ru.ac.za";
      $username = "OrderoftheHexes";
      $password = "O6ttC2G0";
      $database = "OrderoftheHexes";

      $con5 = new mysqli($servername, $username, $password, $database);
      $query = "SELECT Roles, Username
      From  user
      where Username = '$yes'";
      $result = $con5->query($query);
      
      $row =  mysqli_fetch_assoc($result); 
      $Role = $row['Roles']; 
      
      $userRole = $Role;


      if ($userRole === 'Warden') {
        $options['Confirm'] = 'Confirm'; 
        $options['Closed'] = 'Closed';
    } elseif ($userRole === 'Secretary') {
        $options['Requisition'] = 'Requisition';
        $options['Closed'] = 'Closed'; // Managers see Pending
    } elseif ($userRole === 'Maintenance') {
      $options['Resolved'] = 'Resolved';
    }elseif ($userRole === 'Student') {
        $options['Pending'] = 'Pending';
        $options['Delete'] = 'Delete';

    }
$conn = new mysqli($servername, $username,$password,$database);
$id = $conn->real_escape_string($_REQUEST['id']);
$hell = $conn->real_escape_string($_REQUEST['id']);

$sql = "SELECT * FROM ticket WHERE Ticket_ID = '$id'";
$result= mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$ID = $row["Student_ID"];
$desc= $row['textDescription'];
$status = $row['Status_Update'];
$resID= $row['Residence_ID'];
$rep = $row['Locations'];
$date = $row['DateReportedBy'];
$fault = $row['CategoryFault'];





$con1 = new mysqli($servername, $username,$password,$database);
$sql = "SELECT * FROM category WHERE Category_ID = '$fault'";
$result= mysqli_query($con1, $sql);
$row = mysqli_fetch_array($result);
$type = $row['CategoryFault'];

if ($ID == null){
    echo "<strong>Reported By  </strong>"."<br>". "Warden" ."</br>"; 

}else{
echo "<strong>Reported By  </strong>"."<br>". $ID ."</br>"; 
}
echo "</br>";
echo "<strong>Location of fault</strong>"."<br>".$rep ."</br>";
echo "</br>";
echo "<strong>Type of fault</strong> ". "<br>".$type."</br>";
echo "</br>";
echo "<strong>Description of fault</strong> "."<br>".$desc."</br>";
echo "</br>";
echo "<strong>Ticket Status</strong> "."<br>". $status."</br>";
echo "</br>";
echo "<strong>Date reported</strong> ". "<br>".$date."</br>";

$conn = new mysqli($servername, $username,$password,$database);
$sql = "SELECT * FROM photos WHERE Ticket_ID = '$id'";
$result= mysqli_query($conn, $sql);

//$row = mysqli_fetch_array($result);
//$address = $row["Photo_Address"];
//$p_name = $row["Photo_Name"];

?>
</div>
  
<div id="display-image">
    <?php
$conn = new mysqli($servername, $username,$password,$database);
$sql = "SELECT * FROM photos WHERE Ticket_ID = '$id'";
$result= mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <img class = "pics" src=
"../create_ticket/<?php echo $row["Photo_Address"]; ?>">

    <?php
        }
        
    ?>
    
</div>





<form action="change.php" method="POST">
    <div class="comm">
  <p>
<label for="des">Comment</label><br>
    <textarea id="des" name="des" rows="3" cols="40" ></textarea><br>
    <br>
  </p>

  <p>
    
    <?php if($_SESSION['Roles'] !== 'Student' || ($status === "Pending")):?>
    <label for="status">Status of Fault</label><br>
    <select name="status" id="status"> 
        <?php foreach ($options as $value => $label):?>
        <?php echo '<option value="'; ?><?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($label); ?><?php echo '</option>';?><?php endforeach; endif;?>


</select>
    </P>

<p>
  <input type = "hidden" name = "ah"  value = "<?php echo $hell ?>"/>
  <input type="submit" value="Update Record" name = "submit">
    </p>
    </div>
    <div class="comm" id="asd">
        <label>Comments: </label><br>
        <?php
        $sql = "SELECT Username, Content
                        FROM comment
                        WHERE Ticket_ID = '$id';";
        $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<p id='ticket'>" . $row["Username"] . ": ". $row["Content"] . "</p>";
                }              
        ?>


    </div>
    

</form>


</body>
<footer>
    <table id="foottable">
        <tr>
            <td class="fttbltd">
                <img id="footimg" src="../images/logo_pink.jpg">
                <p id="foottxt">© MaintainX 2025 All Rights Reserved &nbsp <a class="spacer"> | </a>
                    <a class="foot_nav_itm" href="../FAQ/faq.php"> T&C's </a> <a class="spacer"> | </a>
                    <a class="foot_nav_itm" href="../FAQ/faq.php"> FAQ </a>
                </p>
            </td>
            <td id="x">
                <h3> Contact us </h3>
                <p> Help: info@maintainx.com </p>
                <p> Inqueries: inqueries@maintainx.com </p>
                <p> tel: 029 098 0928 </p>
            </td>
            <td id="x">
                <h3> Socials </h3>
                <a href="https://www.instagram.com/"> <img id="icon" src="../images/inst_icon.png"></a> 
                <a href="https://www.facebook.com/ /"> <img id="icon" src="../images/faceboon_icon.png"></a> 
                <a href="https://x.com/"> <img id="icon" src="../images/twitter_icon.png"></a> 

            </td>
        </tr>
    </table>
</footer>
</html>
