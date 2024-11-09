<?php
session_start();

// Check if the user has access
if (!isset($_SESSION['access'])) {
    header("Location:..\\login\login.html");
}

require_once("config.php");

$username = $_SESSION['username'];


// Database connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result1 = $conn->query("SELECT Roles FROM user WHERE username = '$username'");


if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $role = $row1['Roles'];
    $_SESSION['role'] = $role; // Store the role in the session if needed
}

// Fetch user details based on the role
$sql = "";
if ($role === "Student") {
    $sql = "SELECT * FROM student
                INNER JOIN user ON student.Username = user.Username
                INNER JOIN residence ON student.Residence = residence.Residence_Name
                INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
                WHERE user.Username = '$username'";
} elseif ($role === "Secretary") {
    $sql = "SELECT * FROM secretary
                INNER JOIN user ON secretary.Username = user.Username
                INNER JOIN residence ON secretary.Staff_No = residence.Secretary_ID
                INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
                WHERE secretary.Username = '$username'";
} elseif ($role === "Warden") {
    $sql = "SELECT * FROM warden
                INNER JOIN user ON warden.Username = user.Username
                INNER JOIN residence ON warden.Staff_No = residence.Warden_ID
                INNER JOIN hall ON residence.Hall_ID = hall.Hall_ID
                WHERE warden.Username = '$username'";
} elseif ($role === "Maintenance") {
    $sql = "SELECT * FROM maintenance_staff
                INNER JOIN user ON maintenance_staff.Username = user.Username
                WHERE maintenance_staff.Username = '$username'";
}

$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed to execute: " . $conn->error);
}

// Fetch user data
$row = $result->fetch_assoc();
$fname = $row['First_Name'] ?? null;    // exists and is not null, assign its value to $fname else is not set or is null, assign an empty string '' to $fname
$lname = $row['Last_Name'] ?? null;
$email = $row['Email'] ?? null;
$role = $row['Roles'] ?? null;
$stuno = $row['Student_Number'] ?? null;
$hall = $row['Hall_Name'] ?? null;
$res = $row['Residence_Name'] ?? null;
$stano = $row['Staff_No'] ?? null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
       body {
    background-image: url("Textured\ .png");
    font-family: Arial, sans-serif;
    margin: 0;
}

.container {
    display: flex;
    flex-direction: row;
}

.header {
    background-color: pink;
    color: white;
    padding: 10px 20px;
    text-align: center;
}

.sidebar {
    width: 200px; /* Adjusted sidebar width */
    background-color: grey;
    height: 100vh;
    margin: 0;
}

.sidebar a {
    text-decoration: none;
    color: white;
    display: block;
    padding: 10px;
    margin: 5px 0;
}

.sidebar a:hover {
    background-color: pink;
}

.content {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping on smaller screens */
    gap: 20px; /* Space between cards */
    padding: 20px;
    flex-grow: 1; /* Allows the content to take up remaining space */
}

.card {
    background-color: pink;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px; /* Fixed width of the cards */
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-10px);
}

    </style>

</head>

    <div class="header">
        <h1><?php $role; ?><h1>
        <h1>Welcome, <?php echo $fname; ?></h1>
    </div>
    
    <!-- <h2>Dashboard Overview</h2>
    <p><?php echo date('F j, Y'); ?></p> <!-- Displays the date --> <!-- -->

    <?php

    require_once("config.php");

    // Database connection
  $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  

  if($role === "Student"){ ?>


    <div class="container">
    <table>
        <tr>
            <td>
                <div class="sidebar">
                    <a href="profile.php">Profile</a>
                    <a href="analytics.php">Analytics</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </td>

            <td>
                <div class="content">
                    <div class="card">
                    <img src="Profile.jpeg" alt="icon" style="width:100%">
                        <h3>Your Profile</h3>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Role: <?php echo $role; ?></p>
                        <?php echo "<a href=\"..\\profile\profile.php?id={$username}\">Update Profile</a>"; ?>
                    </div>

                    <div class="card">
                    <img src="Requisition.jpg" alt="icon" style="width:100%">
                        <h3>Lodge a Ticket</h3>
                        <a href="lodge_ticket.php">Lodge a new ticket</a>
                    </div>

                    <div class="card">
                        <h3>View Tickets in Your Residence</h3>
                        <a href="view_tickets.php">View all tickets</a>
                    </div>

                    <div class="card">
                        <h3>Analytics</h3>
                        <a href="analytics.php">View All analytics</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
  <?php } elseif($role === "Warden"){?>
    <form action = "view_ticket.php" method = "POST">
          <i class="fa-solid fa-magnifying-glass"></i>
           <input type = "hidden" name = "Residence_ID" id = "Residence_ID">
            <input type = "search" name = "txtSearch" placeholder = "">
            <input type = "submit" name = "submit" value  = "Search">
</form>
    <div class="container">
    <table>
        <tr>
            <td>
                <div class="sidebar">
                    <a href="profile.php">Profile</a>
                    <a href="analytics.php">Analytics</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </td>

            <td>
                <div class="content">
                    <div class="card">
                    <img src="Profile.jpeg" alt="icon" style="width:100%">
                        <h3>Your Profile</h3>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Role: <?php echo $role; ?></p>
                        <?php echo "<a href=\"..\\profile\profile.php?id={$username}\">Update Profile</a>"; ?>
                    </div>

                    <div class="card">
                    <img src="Requisition.jpg" alt="icon" style="width:100%">
                        <h3>Lodge a Ticket</h3>
                        <a href="lodge_ticket.php">Lodge a new ticket</a>
                    </div>

                    <div class="card">
                    <img src="slide2.png" alt="icon" style="width:100%">
                        <h3>Manage Ticket</h3>
                        <a href="manage_ticket.php">Manage ticket</a>
                    </div>

                    <div class="card">
                        <h3>View Tickets in Your Residence</h3>
                        <a href="view_tickets.php">View all tickets</a>
                    </div>

                    <div class="card">
                        <h3>Analytics</h3>
                        <a href="analytics.php">View All analytics</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
    <?php } elseif($role === "Secretary"){?>
      <form action = "p5ex1.php" method = "POST">
          <i class="fa-solid fa-magnifying-glass"></i>
            <input type = "search" name = "txtSearch" placeholder = "">
            <input type = "submit" name = "submit" value  = "Search">
</form>
    <div class="container">
    <table>
        <tr>
            <td>
                <div class="sidebar">
                    <a href="profile.php">Profile</a>
                    <a href="analytics.php">Analytics</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </td>

            <td>
                <div class="content">
                    <div class="card">
                    <img src="Profile.jpeg" alt="icon" style="width:100%">
                        <h3>Your Profile</h3>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Role: <?php echo $role; ?></p>
                        <?php echo "<a href=\"..\\profile\profile.php?id={$username}\">Update Profile</a>"; ?>
                    </div>

                    <div class="card">
                    <img src="Requisition.jpg" alt="icon" style="width:100%">
                        <h3>Lodge a Ticket</h3>
                        <a href="lodge_ticket.php">Lodge a new ticket</a>
                    </div>

                    <div class="card">
                    <img src="slide2.png" alt="icon" style="width:100%">
                        <h3>Manage Ticket</h3>
                        <a href="manage_ticket.php">Manage ticket</a>
                    </div>

                    <div class="card">
                        <h3>View Tickets in Your Residence</h3>
                        <a href="view_tickets.php">View all tickets</a>
                    </div>

                    <div class="card">
                        <h3>Analytics</h3>
                        <a href="analytics.php">View All analytics</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
      <?php } elseif($role === "Maintenance"){?>
        
    <div class="container">
    <table>
        <tr>
            <td>
                <div class="sidebar">
                    <a href="profile.php">Profile</a>
                    <a href="analytics.php">Analytics</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </td>

            <td>
                <div class="content">
                    <div class="card">
                    <img src="Profile.jpeg" alt="icon" style="width:100%">
                        <h3>Your Profile</h3>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Role: <?php echo $role; ?></p>
                        <?php echo "<a href=\"..\\profile\profile.php?id={$username}\">Update Profile</a>"; ?>
                    </div>

                    <div class="card">
                    <img src="Requisition.jpg" alt="icon" style="width:100%">
                        <h3>Lodge a Ticket</h3>
                        <a href="lodge_ticket.php">Lodge a new ticket</a>
                    </div>

                    <div class="card">
                    <img src="slide2.png" alt="icon" style="width:100%">
                        <h3>Manage Ticket</h3>
                        <a href="manage_ticket.php">Manage ticket</a>
                    </div>

                    <div class="card">
                        <h3>View Tickets in Your Residence</h3>
                        <a href="view_tickets.php">View all tickets</a>
                    </div>

                    <div class="card">
                        <h3>Analytics</h3>
                        <a href="analytics.php">View All analytics</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
        <?php } ?>

</body>

</html>