<?php

session_start();


//include database credentials
require_once("Config.php");

//make connection to database
$conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);

//check if connection is successful
if ($conn->connect_error){
    die("<p class=\"error\"> Connection to database unsuccessfull!</p>");
}

// get user role from session

$role= $conn->real_escape_string($_SESSION['Roles']);
$user_id= $conn->real_escape_string($_SESSION['username']);


// Check if the user has access
if (!isset($_SESSION['access'])) {
    header("Location:..\profile\login\login.html");
}


//query instruction
$sql="";

if ($role == 'Student') {
    // Students can only see their own tickets
    $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
    $query= "SELECT Residence FROM student WHERE Username='$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $residence = $row ['Residence'];

    
$conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
$sql= "SELECT student.First_Name ,student.Last_Name ,ticket.DateReportedBy,textDescription,ticket.Ticket_ID, ticket.Status_Update,residence.Residence_Name,category.CategoryFault,ticket.Locations,ticket.Student_ID,ticket.DateClosedBy
FROM ticket
LEFT JOIN category ON category.Category_ID = ticket.CategoryFault
LEFT JOIN warden ON ticket.Warden_ID = warden.Staff_No
LEFT JOIN residence ON ticket.Residence_ID = residence.Residence_ID
LEFT JOIN student ON student.Student_Number = ticket.Student_ID
WHERE residence.Residence_Name = '$residence' AND NOT ticket.Status_Update = 'Closed'";
$result = mysqli_query($conn, $sql);
}



if ($role == 'Warden') {
    // Wardens can only see their own tickets
    $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
    $query = "SELECT Staff_No FROM warden WHERE Username='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) { 
        // Fetch the Staff Number
        $row = mysqli_fetch_assoc($result);
        $staffnum = $row['Staff_No'];

        // Get Residence Name based on the Warden's Staff Number
        $query = "SELECT Residence_Name FROM residence WHERE Warden_ID='$staffnum'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the Residence Name
            $row = mysqli_fetch_assoc($result);
            $residence = $row['Residence_Name'];

            $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
     $sql ="SELECT student.First_Name ,student.Last_Name ,ticket.DateReportedBy,textDescription,ticket.Ticket_ID, ticket.Status_Update,residence.Residence_Name,category.CategoryFault,ticket.Locations,ticket.Student_ID,ticket.DateClosedBy
FROM ticket
LEFT JOIN category ON category.Category_ID = ticket.CategoryFault
LEFT JOIN warden ON ticket.Warden_ID = warden.Staff_No
LEFT JOIN residence ON ticket.Residence_ID = residence.Residence_ID
LEFT JOIN student ON student.Student_Number = ticket.Student_ID
WHERE residence.Residence_Name = '$residence' AND NOT ticket.Status_Update = 'Closed'" ;
 $result= $conn->query($sql);
 
} }}

elseif ($role == 'Secretary') {   
    // Secretaries can see tickets for their residence hall
    $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
    $query = "SELECT Staff_No FROM secretary WHERE Username='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the Secretary's Staff Number
        $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
        $row = mysqli_fetch_assoc($result);
        $secnum = $row['Staff_No'];

        // Get Hall_ID managed by the Secretary
        $query = "SELECT Hall_ID FROM residence WHERE Secretary_ID='$secnum'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the Hall ID
            $row = mysqli_fetch_assoc($result);
            $hall_id = $row['Hall_ID'];

            $conn= new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
    $sql="SELECT student.First_Name ,student.Last_Name, ticket.DateReportedBy,textDescription,ticket.Ticket_ID, ticket.Status_Update,residence.Residence_Name,category.CategoryFault,ticket.Locations,ticket.Student_ID,ticket.DateClosedBy
FROM ticket
LEFT JOIN category ON category.Category_ID = ticket.CategoryFault
LEFT JOIN warden ON ticket.Warden_ID = warden.Staff_No
LEFT JOIN residence ON ticket.Residence_ID = residence.Residence_ID
LEFT JOIN student ON student.Student_Number = ticket.Student_ID
WHERE residence.Hall_ID = '$hall_id' AND NOT ticket.Status_Update = 'Closed'";
$result= $conn->query($sql);

}  
    }}

 
$result= $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed to execute: " . $conn->error);
}


$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tickets</title>
    <link rel="stylesheet" href="View_Tickets.css">
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />
    

</head>
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
    <div id = container>
<div class="tester">
  <a class="picbt" href="..\php\home.php"><img src="pics\ihome.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\create_ticket\ct.php"><img src="pics\iticket.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\php\analytics.php"><img src="pics\igraph.png"
      style="width:60px;height:60px;" /></a>
</div>


       
        
      



    <h1>Tickets Submitted:</h1>
    <table class="display">
        <thead>
            <tr>
                <th>Ticket_ID </th>
                <th>Report Date </th>
                <th>Submitted By </th>
                <th>Residence_Name</th>
                <th>Details</th>
                <th>Location </th>
                <th>Fault Category</th>
                <th>Status</th>
           </tr>
        </thead>

        <?php
        
         
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='data'>" . $row['Ticket_ID'] . "</td>";
                echo "<td>" . $row['DateReportedBy'] . "</td>";
                if ($row['Student_ID'] == null){
                    echo "<td>" . "Warden" . "</td>";
                }else{
                echo "<td>" . $row['First_Name'] . " ". $row['Last_Name'] ."</td>";
                }
                echo "<td>" . $row['Residence_Name'] . "</td>";
                echo "<td>" . $row['textDescription'] . "</td>";
                echo "<td>" . $row['Locations'] . "</td>";
                echo "<td>" . $row['CategoryFault'] . "</td>";
                echo "<td>" . $row['Status_Update'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<p>No tickets found.</p>";
        }

        ?>

    </table>



    </div>
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


