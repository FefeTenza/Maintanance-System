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
    <title>Manage Tickets</title>
    <link rel="stylesheet"  href = "mtw.css"/>
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
 
<div class = "container">
<body>
<h2 class = "heading"> Open Tickets </h2>
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

$conn = new mysqli($servername, $username,$password,$database);
$sql = "SELECT Staff_No, Username from warden where Username = '$yes'";
$result= mysqli_query($conn, $sql);


$row = mysqli_fetch_array($result); 
$ID = $row["Staff_No"];
$us = $row ["Username"];


//$conn = new mysqli($servername, $username,$password,$database);
//$sql = "SELECT Status_Update from ticket where Warden_ID  = '$ID'";
//$row = mysqli_fetch_array($result);

$conn = new mysqli($servername, $username,$password,$database);
$sql = "SELECT  Ticket_ID, ticket.Residence_ID, textDescription, Residence_Name, ticket.Student_ID, Status_Update
FROM ticket, residence
Where ticket.Residence_ID = residence.Residence_ID and ticket.Warden_ID = '$ID' AND ticket.Student_ID IS NULL";
$result= mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result); 


$exclude = ['Closed'];


echo '<table width="80%" border="0" class="three-d-table">
    <tr style=\"background-color:#FBDADE\" id = tt>
    </tr>';

    while ($row = mysqli_fetch_array($result)){
    if (in_array($row['Status_Update'], $exclude)){
        continue;
    }
    echo "<tr>";
    echo "<td><a href=\"update.php?id={$row['Ticket_ID']}\" style=\"text-decoration: none; color: inherit;\"> 
    Ticket No. {$row['Ticket_ID']}<br>
    {$row['Residence_Name']}<br>
    {$row['Status_Update']}
</a></td>";
    }
echo '</table>';
//\\is3-dev.ict.ru.ac.za\SysDev\OrderoftheHexes

?>
</body>
</div>
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
 