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
    $_SESSION['Roles'] = $role; // Store the role in the session if needed
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
            background-image: url("Textured .png");
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            display: inline-flex;


        }

        .header2 {
            /*padding: 95px 95px;*/
            text-align: center;
            font-size: 50px;
        }

        .sidebar {
            width: 200px;
            /* Adjusted sidebar width */
            background-color: grey;
            height: 120vh;
            margin: 0;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            margin: 2px 0;
        }

        .sidebar a:hover {
            background-color: pink;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            /* Allows wrapping on smaller screens */
            gap: 20px;
            /* Space between cards */
            padding: 20px;
            flex-grow: 1;
            /* Allows the content to take up remaining space */
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }

        .card {
            background-color: pink;
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            /* Fixed width of the cards */
            height: 200px;
            transition: transform 0.3s;
            margin: 50px;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        body {
            margin: 0;
            padding: 0;

            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;


        }

        nav {
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .nav_itm {
            font-size: 20px;
            width: auto;
            color: black;
            text-decoration: none;
        }

        .foot_nav_itm {
            text-decoration: none;
            color: black;
        }

        a {
            padding-right: 5px;
        }

        header {
            position: relative;
            width: auto;
            background-color: #FBDADE;
            height: 120px;
        }

        #logoimg {
            float: left;
            width: 80px;
            height: auto;
            padding-top: 10px;
        }

        #profileimg {
            position: absolute;
            width: 50px;
            height: auto;
            right: 0;
            bottom: 20px;
        }

        #maintlt {
            position: absolute;
            bottom: 15px;
            text-align: left;
            margin-top: 0;
            padding-left: 100px;
            text-decoration: underline;
            text-decoration-color: white;
            text-decoration-thickness: 2px;

        }

        #titlesec {
            font-family: Arial, Helvetica, sans-serif;
        }

        .spacer {
            color: white;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            margin: 0px;

            vertical-align: bottom;
            background-color: #FBDADE;
        }

        #foottable {
            width: 100%;
            bottom: 0;
        }

        .fttbltd {
            text-align: left;
            vertical-align: bottom;
            padding: 0;
        }

        #footimg {
            bottom: 0;
            width: 80px;
            height: auto;

        }

        #foottxt {
            bottom: 0;
            margin-bottom: 0;
            text-align: left;
        }

        #x {
            text-align: center;
            width: 300px;
            line-height: 0.8;
            padding: 0;
        }

        #icon {
            width: 80px;
            height: auto;

        }


        .footerh {
            font-size: 1.17em;
            font-style: normal;
            color: black;
        }

        #prfico {
            position: absolute;
            top: -90px;
            right: 0;
            width: 50px;
            height: auto;
        }

        #spacer {
            color: white;
            font-size: 40px;
            margin-top: 0;
        }

        .btn {
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            background-color: white;

        }

        .noti {

            background-color: white;
            text-align: center;
            padding-bottom: 5px;
            padding-top: 5px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
        }
        #ticket{
            padding: 0;
            margin: 0;
        }

    </style>

</head>
<!-- -->

<header id="titlesec">

    <img id="logoimg" src="../../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="../../php/home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../../About/about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm"

            <?php if (isset($_SESSION['username'])): ?>
            href='dashboard.php'> <img id="prfico" src="../../images/Profile.png"> <a class="nav_itm" href="../../php/logout.php">Logout </a>
        <?php else: ?>
            href='..\login\login.html'> Login </a>
    <?php endif; ?>


    <!--href="login.php"> Login -->


    </a>
    </nav>

</header>

<?php

require_once("config.php");

// Database connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($role === "Student") { ?>

    <div class="container">
        <div class="sidebar">
            <a href="..\profile\profile.php"><b>Profile</b></a>
            <a href="..\..\php\analytics.php"><b>Analytics</b></a>
            <a href="..\..\php\logout.php"><b>Logout</b></a>
        </div>
        <div>
            <h1><?php $role; ?><h1>
                    <h1 class="header2">Welcome Back, <?php echo $fname; ?>...</h1>

                    <div class="content">
                        <table>
                            <tr>
                                <div class="card">

                                    <img src="Profile.png" alt="Icon" style="width:145px"><br>
                                    <label><b>View Profile</b></label><br><br>
                                    <a class="btn" href="..\profile\profile.php">Profile</a>

                                </div>
                            </tr>


                            <tr>
                                <div class="card">
                                    <img src="add-ticket.png" alt="icon" style="width:100px"><br><br>
                                    <h3>Create a Ticket</h3>
                                    <a class="btn" href="..\..\create_ticket\ct.php">Create a new ticket</a>
                                </div>
                            </tr>




                            <tr>
                                <div class="card">

                                    <img src="ticket.png" alt="icon" style="width:100px"><br><br><br>
                                    <label><b>View Tickets in Your Residence</b></label><br><br>
                                    <a class="btn" href="..\..\View_Tickets\View_Tickets.php">View all tickets</a>

                                </div>
                            </tr>



                            <tr>
                                <div class="card">
                                    <img src="ticket (1).png" alt="Icon" style="width:120px"><br>
                                    <h3>Manage your submitted Tickets</h3>
                                    <a class="btn" href="..\..\Manage%20Ticket\stu.php">Manage tickets</a>
                                </div>
                            </tr>


                            <tr>
                                <div class="card">
                                    <img src="online-analytic-processing.png" alt="Icon" style="width:100px"><br><br>
                                    <h3>Analytics</h3>
                                    <a class="btn" href="..\..\php\analytics.php">View All analytics</a>
                                </div>
                            </tr>
                        </table>
                    </div>
        </div>
    <?php } elseif ($role === "Warden") { ?>
        <div class="container">
            <div class="sidebar">
                <a href="..\profile\profile.php"><b>Profile</b></a>
                <a href="..\..\php\analytics.php"><b>Analytics</b></a>
                <a href="..\..\php\logout.php"><b>Logout</b></a>
            </div>
            <div>



                <h1><?php $role; ?><h1>
                        <h1 class="header2">Welcome Back, <?php echo $fname; ?>...</h1>
                        <?php
                        $sql = "SELECT count(Ticket_ID) AS 'ticket_count' FROM ticket WHERE Warden_ID = '$stano' AND Status_Update = 'Pending';";
                        $result = $conn->query($sql);
                        if ($result === FALSE) {
                            die("Query failed to execute");
                        }
                        while ($row = $result->fetch_assoc()) {
                            $count = $row["ticket_count"];
                            if ($count > 0) {
                                echo "<div class='noti'> <h2>Tickets awaiting your approval</h2>";
                                echo "<h2 id='ticket'>" . $row["ticket_count"] . "</h2> </div>";
                            }
                        }
                        ?>

                        <div class="content">
                            <table>
                                <tr>
                                    <div class="card">

                                        <img src="Profile.png" alt="Icon" style="width:145px"><br>
                                        <label><b>View Profile</b></label><br><br>
                                        <a class="btn" href="..\profile\profile.php">Profile</a>

                                    </div>
                                </tr>
                                <tr>
                                    <div class="card">
                                        <img src="add-ticket.png" alt="icon" style="width:100px"><br><br>
                                        <h3>Create a Ticket</h3>
                                        <a class="btn" href="..\..\create_ticket\ct.php">Create a new ticket</a>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="card">
                                        <img src="ticket (1).png" alt="Icon" style="width:120px"><br>
                                        <h3>Manage your submitted Tickets</h3>
                                        <a class="btn" href="..\..\Manage%20Ticket\ward.php">Manage tickets</a>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="card">
                                        <img src="ticket (1).png" alt="Icon" style="width:120px"><br>
                                        <h3>Manage Residence Tickets</h3>
                                        <a class="btn" href="..\..\Manage%20Ticket\mtw.php">Manage tickets</a>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="card">

                                        <img src="ticket.png" alt="icon" style="width:100px"><br><br><br>
                                        <label><b>View Tickets in Your Residence</b></label><br><br>
                                        <a class="btn" href="..\..\View_Tickets\View_Tickets.php">View all tickets</a>

                                    </div>
                                </tr>
                                <tr>
                                    <div class="card">
                                        <img src="online-analytic-processing.png" alt="Icon" style="width:100px"><br><br>
                                        <h3>Analytics</h3>
                                        <a class="btn" href="..\..\php\analytics.php">View All analytics</a>
                                    </div>
                                </tr>
                            </table>
                        </div>




            </div>
        </div>


    <?php } elseif ($role === "Secretary") { ?>
        <div class="container">
            <div class="sidebar">
                <a href="..\profile\profile.php"><b>Profile</b></a>
                <a href="..\..\php\analytics.php"><b>Analytics</b></a>
                <a href="..\..\php\logout.php"><b>Logout</b></a>
            </div>
            <div>




                <h1><?php $role; ?><h1>
                        <h1 class="header2">Welcome Back, <?php echo $fname; ?>...</h1>
                        <div id='notifi'>
                            <?php
                            $sql = "SELECT COUNT(t.Ticket_ID) AS Confirmed_Ticket_Count
                                    FROM residence r
                                    LEFT JOIN ticket t ON r.Residence_ID = t.Residence_ID
                                    WHERE t.Status_Update = 'Confirm' AND r.Secretary_ID ='$stano'
                                    GROUP BY r.Secretary_ID";

                            $result = $conn->query($sql);

                            if ($result === FALSE) {
                                die("Query failed to execute");
                            }
                            while ($row = $result->fetch_assoc()) {
                                $count = $row["Confirmed_Ticket_Count"];
                                if ($count > 0) {
                                    echo "<div class='noti'> <h2>Tickets awaiting your approval</h2>";
                                    echo "<h2 id='ticket'>To Requisition: " . $row["Confirmed_Ticket_Count"] . "</h2>  </div>";
                                }
                            }
                            $sql = "SELECT COUNT(t.Ticket_ID) AS Confirmed_Ticket_Count
                                    FROM residence r
                                    LEFT JOIN ticket t ON r.Residence_ID = t.Residence_ID
                                    WHERE t.Status_Update = 'Resolved' AND r.Secretary_ID ='$stano'
                                    GROUP BY r.Secretary_ID";

                            $result = $conn->query($sql);

                            if ($result === FALSE) {
                                die("Query failed to execute");
                            }
                            while ($row = $result->fetch_assoc()) {
                                $count2 = $row["Confirmed_Ticket_Count"];
                                if ($count2 > 0) {
                                    echo "<div class='noti'>";
                                    if(!isset($count)){
                                        echo "<h2 >Tickets awaiting your approval</h2>";
                                    }
                                    echo "<h2 id='ticket'>To Close: " . $row["Confirmed_Ticket_Count"] . "</h2>  </div>";
                                }
                            }


                            ?>
                        </div>
                        <div class="content">
                            <table>
                                <tr>
                                    <div class="card">

                                        <img src="Profile.png" alt="Icon" style="width:145px"><br>
                                        <label for="LogTicket"><b>View Profile</b></label><br><br>
                                        <a class="btn" href="..\profile\profile.php">Profile</a>

                                    </div>
                                </tr>



                                <tr>
                                    <div class="card">
                                        <img src="ticket (1).png" alt="Icon" style="width:120px"><br>
                                        <h3>Manage Ticket</h3>
                                        <a class="btn" href="..\..\Manage%20Ticket\mts.php">Manage ticket</a>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="card">

                                        <img src="ticket.png" alt="icon" style="width:100px"><br><br><br>
                                        <label><b>View Tickets in Your Hall</b></label><br><br>
                                        <a class="btn" href="..\..\View_Tickets\View_Tickets.php">View all tickets</a>

                                    </div>
                                </tr>
                                <tr>
                                    <div class="card">
                                        <img src="online-analytic-processing.png" alt="Icon" style="width:100px"><br><br>
                                        <h3>Analytics</h3>
                                        <a class="btn" href="..\..\php\analytics.php">View All analytics</a>
                                    </div>
                                </tr>
                            </table>

                        </div>


            </div>
        </div>

    <?php } elseif ($role === "Maintenance") { ?>
        <div class="container">
            <div class="sidebar">
                <a href="..\profile\profile.php"><b>Profile</b></a>
                <a href="..\..\php\analytics.php"><b>Analytics</b></a>
                <a href="..\..\php\logout.php"><b>Logout</b></a>
            </div>
            <div>




                <h1><?php $role; ?><h1>
                        <h1 class="header2">Welcome Back, <?php echo $fname; ?>...</h1>
                        <?php
                        $sql = "SELECT count(Ticket_ID) AS 'ticket_count' FROM ticket WHERE Status_Update = 'Requisition';";
                        $result = $conn->query($sql);

                        if ($result === FALSE) {
                            die("Query failed to execute");
                        }
                        while ($row = $result->fetch_assoc()) {
                            $count = $row["ticket_count"];
                            if ($count > 0) {
                                echo "<div class='noti'> <h2>Tickets awaiting your approval</h2>";
                                echo "<h2 id='ticket'>" . $row["ticket_count"] . "</h2> </div>";
                            }
                        }
                        ?>
                        <div class="content">
                            <table>
                                <tr>
                                    <div class="card">

                                        <img src="Profile.png" alt="Icon" style="width:145px"><br>
                                        <label for="LogTicket"><b>View Profile</b></label><br><br>
                                        <a class="btn" href="..\profile\profile.php">Profile</a>

                                    </div>
                                </tr>



                                <tr>
                                    <div class="card">
                                        <img src="ticket (1).png" alt="Icon" style="width:120px"><br>
                                        <h3>Manage Tickets</h3>
                                        <a class="btn" href="..\..\Manage%20Ticket\mtm.php">Manage ticket</a>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="card">
                                        <img src="online-analytic-processing.png" alt="Icon" style="width:100px"><br><br>
                                        <h3>Analytics</h3>
                                        <a class="btn" href="..\..\php\analytics.php">View All analytics</a>
                                    </div>
                                </tr>
                            </table>
                        </div>




            </div>
        </div>
    <?php
} ?>
    </div>
    </body>
    <footer>
        <table id="foottable">
            <tr>
                <td class="fttbltd">
                    <img id="footimg" src="../../images/logo_pink.jpg">
                    <p id="foottxt">© MaintainX 2025 All Rights Reserved &nbsp <a class="spacer"> | </a>
                        <a class="foot_nav_itm" href="../../FAQ/faq.php"> T&C's </a> <a class="spacer"> | </a>
                        <a class="foot_nav_itm" href="../../FAQ/faq.php"> FAQ </a>
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
                    <a href="https://www.instagram.com/"> <img id="icon" src="../../images/inst_icon.png"></a>
                    <a href="https://www.facebook.com/ /"> <img id="icon" src="../../images/faceboon_icon.png"></a>
                    <a href="https://x.com/"> <img id="icon" src="../../images/twitter_icon.png"></a>

                </td>
            </tr>
        </table>
    </footer>

</html>