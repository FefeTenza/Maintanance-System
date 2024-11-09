<?php
session_start();

// Check if the user has access
if (!isset($_SESSION['access'])) {
    header("Location:..\login\login.html");
}

require_once("config.php");

$role = $_SESSION['Roles'] ;
$username = $_SESSION['username'] ;

// Database connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<style>
    /* Ensure that the body and html occupy the full height */
/* HEADER AND FOOTER CSS PLEASE DO NOT TOUCH */
body {
    margin: 0;
    padding: 0;
    background-image: url('../../images/background.png');
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
    
    position: absolute;

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
    vertical-align: bottom;
}

#footimg {
    bottom: 0;
    width: 80px;
    height: auto;
}

#foottxt {
    bottom: 0;
    margin-bottom: 0;
}

#x {
    text-align: center;
    width: 300px;
    line-height: 0.8;
}

#icon {
    width: 80px;
    height: auto;

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

 #profile2{
        justify-content: center;
        border-radius: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;

    }

    #name {
        text-align: center;
        position: center;
        margin-left: 80px;
        margin-right: 80px;

    }

    
    

    /* Style the form container */
    .form-container {
        
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: pink;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        /* Limit form width */
    }


    /* Form elements */
    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        /* Ensure padding doesn't affect total width */
    }



    input[type = "submit"] {
        background-color: white;
        color: black;
        border-radius: 10%;
        border: hidden;
        padding: 5px;
    }

    


.container {
    display: flex;
    align-items: center;
    flex-direction: column;
    align-items: center; /* Center horizontally */
    justify-content: flex-start;
    padding: 60px;
   

        }

        .picbt{
float:right;
margin-left: auto;
}


.tester{
    position: relative;
    margin-top:10px;


}


</style>
<header id="titlesec">

    <img id="logoimg" src="../../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="../../php/home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../../about/about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../dashboard/dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm" 
        
        <?php if (isset($_SESSION['username'])):?>
             href='..\dashboard\dashboard.php'> <img id="prfico" src="../../images/Profile.png"> <a class="nav_itm" href="../../php/logout.php">Logout </a>
             <?php else: ?>
            href='..\profile\login\login.html'> Login </a>
          <?php endif;?>
        
        
        <!--href="login.php"> Login -->


        </a>
    </nav>

</header>

<body>
<div class="tester">
  <a class="picbt" href="..\..\php\home.php"><img src="..\..\create_ticket\pics\ihome.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\..\create_ticket\ct.php"><img src="..\..\create_ticket\pics\iticket.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\..\php\analytics.php"><img src="..\..\create_ticket\pics\igraph.png"
      style="width:60px;height:60px;" /></a>
</div>



<table class="container">


<th>
   
    <img id="profile2"src="Profile.png" alt="icon" width="200" height="200">
    <h1 id="name"><?php echo $fname . " " . $lname; ?></h1>
    
</th>
<tr>
    
            <td>
                <div class="form-container">
                    <form action="../dashboard/dashboard.php" id="myForm" >

                        <input type="hidden" name="username" value="<?php echo $username; ?>">

                        <label for="fname"><strong>First name: </strong></label>
                        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" readonly><br><br>

                        <label for="lname"><strong>Last name: </strong></label>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" readonly><br><br>

                        <label for="email"><strong>Email: </strong></label>
                        <input type="email" name="email" value="<?php echo $email; ?>" readonly><br><br>

                        <label for="role"><strong>Role: </strong></label>
                        <input type="text" name="role" value="<?php echo $role; ?>" readonly><br><br>

                        <!-- Role-specific fields -->
                        <?php if ($role === "Student") { ?>
                            <label for="stuno"><strong>Student number: </strong></label>
                            <input type="text" name="stuno" pattern="g[0-9]{2}[Aa-Zz]{1}[0-9]{4}" maxlength="8"
                                value="<?php echo $stuno; ?>" required><br><br>
                        <?php } else { ?>
                            <label for="stano"><strong>Staff number: </strong></label>
                            <input type="text" name="stano" value="<?php echo $stano; ?>" readonly ><br><br>
                        <?php } ?>

                        <label for="hall"><strong>Hall name: </strong></label>
                        <input type="text" name="hall" value="<?php echo $hall; ?>" readonly><br><br>

                        <label for="res"><strong>Residence name: </strong></label>
                        <input type="text" name="res" value="<?php echo $res; ?>" readonly><br><br>

                     <input type = "submit" name = "submit" value = "OK">

                    </form>

                </div>
            </td>
        </tr>
    </table>

  


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