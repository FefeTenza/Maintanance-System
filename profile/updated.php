<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['access'])) {
    header("Location: login.html");
    exit();
}

// Fetch the updated user profile details from session
$username = $_REQUEST['username'] ?? null;
$role = $_REQUEST['role'] ?? null;
$fname = $_REQUEST['fname'] ?? null;
$lname = $_REQUEST['lname'] ?? null;
$email = $_REQUEST['email'] ?? null;
$stuno = $_REQUEST['stuno'] ?? null;
$stano = $_REQUEST['stano'] ?? null;
$hall = $_REQUEST['hall'] ?? null;
$res = $_REQUEST['res'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style> /* Ensure that the body and html occupy the full height */
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
</head>
<body>
    <table class="container">
        <th>
            <img src="login 2.0.jpg" alt="icon" width="200" height="200">
            <h1><?php echo $fname . " " . $lname; ?></h1>
        </th>
        <tr>
            <td>
                <div class="form-container">
                    <form action="" id="myForm" method="POST" enctype="multipart/form-data">
                        <label for="fname"><strong>First name: </strong></label>
                        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" readonly><br><br>

                        <label for="lname"><strong>Last name: </strong></label>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" readonly><br><br>

                        <label for="email"><strong>Email: </strong></label>
                        <input type="email" name="email" value="<?php echo $email; ?>" readonly><br><br>

                        <label for="role"><strong>Role: </strong></label>
                        <input type="text" name="role" value="<?php echo $role; ?>" readonly><br><br>

                        <?php if($role === "Student"){ ?>
                        <label for="stuno"><strong>Student number: </strong></label>
                        <input type="text" name="stuno" value="<?php echo $stuno; ?>" readonly><br><br>

                        <?php } else{ ?>
                            <label for="stano"><strong>Staff number: </strong></label>
                            <input type="text" name="stano" value="<?php echo $stano; ?>" readonly><br><br>
                            <?php } ?>
                        <label for="hall"><strong>Hall name: </strong></label>
                        <input type="text" name="hall" value="<?php echo $hall; ?>" readonly><br><br>

                        <label for="res"><strong>Residence name: </strong></label>
                        <input type="text" name="res" value="<?php echo $res; ?>" readonly><br><br>

                        <button type="button" onclick="backForm()">Back to Dashboard</button>
                    </form>
                </div>
            </td>
        </tr>
    </table>

    <script>
        function backForm() {
            var form = document.getElementById('myForm');
            form.action = 'dashboard.php';
            form.submit();
        }
    </script>
</body>
</html>
