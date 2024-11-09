<?php
session_start();

// Check if the user has access
if (!isset($_SESSION['access'])) {
    header("Location:login.html");
}

require_once("config.php");

$role = $_SESSION['role'] ;
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

// Fetch hall options
$hall_result = $conn->query("SELECT * FROM hall");
$res_result = null; // Clear the value to prevent further use

// Handle hall change based on selected hall
if (isset($_POST['opt']) && $_POST['opt'] === 'Yes') {
    $selected_hall = $_POST['hall'] ?? '';
    $res_result = $conn->query("SELECT * FROM residence WHERE Hall_ID = '$selected_hall'");
}

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
    html, body {
        background-image: url("Textured\ .png");
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
    }

    img {
        justify-content: center;
        border-radius: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;

    }

    h1 {
        text-align: center;
        position: center;
        margin-left: 100px;
        margin-right: 100px;

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


    .container {
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: auto;
        padding: 20px;
        height: 100vh;
        
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

    a {
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
    }

    a:hover {
        background-color: #ddd;
        color: black;
    }

    .button {
        background-color: #04AA6D;
        color: white;
    }
</style>

<body>
<table class="container">
<th>

    <img src="Profile.jpeg" alt="icon" width="200" height="200">
    <h1><?php echo $fname . " " . $lname; ?></h1>

</th>
<tr>
    
            <td>
                <div class="form-container">
                    <form action="" id="myForm" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="username" value="<?php echo $username; ?>">

                        <label for="fname"><strong>First name: </strong></label>
                        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" required><br><br>

                        <label for="lname"><strong>Last name: </strong></label>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" required><br><br>

                        <label for="email"><strong>Email: </strong></label>
                        <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

                        <label for="role"><strong>Role: </strong></label>
                        <input type="text" name="role" value="<?php echo $role; ?>" readonly><br><br>

                        <!-- Role-specific fields -->
                        <?php if ($role === "Student") { ?>
                            <label for="stuno"><strong>Student number: </strong></label>
                            <input type="text" name="stuno" pattern="g[0-9]{2}[Aa-Zz]{1}[0-9]{4}" maxlength="8"
                                value="<?php echo $stuno; ?>" required><br><br>
                        <?php } else { ?>
                            <label for="stano"><strong>Staff number: </strong></label>
                            <input type="text" name="stano" value="<?php echo $stano; ?>" required><br><br>
                        <?php } ?>

                        <!-- Hall Selection -->
                        <label for="hall"><strong>Hall name: </strong></label>
                        <input type="text" name="hall" value="<?php echo $hall; ?>" readonly><br><br>

                       
                        <label for="opt"><strong>Do you want to change your hall?: </strong></label>
                        <select name="opt" id="opt" onchange="this.form.submit()">
                            <option value="---">---</option>
                            <option value="Yes" <?php if ($_POST['opt'] === 'Yes')
                                echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($_POST['opt'] === 'No')
                                echo 'selected'; ?>>No</option>
                        </select><br><br>

                        <?php if (isset($_POST['opt']) && $_POST['opt'] === 'Yes') { ?>
                            <label for="new_hall"><strong>Select new hall: </strong></label>
                            <select name="hall" id="new_hall">
                                <?php while ($row = $hall_result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['Hall_ID']; ?>" <?php echo ($row['Hall_ID'] == $hall) ? 'selected' : ''; ?>>
                                        <?php echo $hall = $row['Hall_Name']; ?>
                                    </option>
                                <?php } ?>
                            </select><br><br>
                        <?php } ?>



                        <!-- Residence Selection -->
                        <label for="res"><strong>Residence name: </strong></label>
                        <input type="text" name="res" value="<?php echo $res; ?>" readonly><br><br>


                        <label for="change"><strong>Do you want to change your residence?: </strong></label>
                        <select name="change" id="change" onchange="this.form.submit()">
                            <option value="---">---</option>
                            <option value="Yes" <?php if ($_POST['change'] === 'Yes')
                                echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($_POST['change'] === 'No')
                                echo 'selected'; ?>>No</option>
                        </select><br><br>

                        <?php if (isset($_POST['change']) && $_POST['change'] === 'Yes' && $res_result) { ?>
                            <label for="new_res"><strong>Select new residence: </strong></label>
                            <select name="res" id="new_res">
                                <?php while ($res_row = $res_result->fetch_assoc()) { ?>
                                    <option value="<?php echo $res_row['Residence_ID']; ?>" <?php echo ($res_row['Residence_ID'] == $res) ? 'selected' : ''; ?>>
                                        <?php echo $res = $res_row['Residence_Name']; ?>
                                    </option>
                                <?php } ?>
                            </select><br><br>
                        <?php } ?>

                     <button type="button"  onclick="backForm()">Back</button>
                        <button type="button"  onclick="submitForm()">Update Profile</button>

                    </form>

                </div>
            </td>
        </tr>
    </table>

    <script>
        function backForm() {
            // Get the form element by its ID
            var form = document.getElementById('myForm');
            // Set the action to "upd.php"
            form.action = 'dashboard.php';
            // Submit the form
            form.submit();
        }
    </script>

    <script>
        function submitForm() {
            // Get the form element by its ID
            var form = document.getElementById('myForm');
            // Set the action to "upd.php"
            form.action = 'update.php';
            // Submit the form
            form.submit();
        }
    </script>


</body>

</html>