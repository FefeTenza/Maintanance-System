<?php
session_start(); 

if(isset($_REQUEST['Roles'])){
$_SESSION['Roles'] = $_REQUEST['Roles'];
$role = $_SESSION['Roles'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>

<style>

 body {
        background-image: url("Textured .png");
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

.container{
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #FBDADE;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
}

label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], input [type="password"], select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
       
    }
    </style>

<body>

<?php if ($role === "Student"){ ?>

<div class = "container">
<h2>Create Account</h2>
        <form  method="POST" action = "addprofile.php">
        <label for="FirstName">First Name: <span style="color: red;">*</span></label><br><br>
        <input type="text" name="FirstName" id="FirstName" required><br><br>
        
        <label for="LastName">Last Name: <span style="color: red;">*</span> </label><br><br>
        <input type="text" name="LastName" id="LastName" required><br><br>

        <label for="Email">Email <span style="color: red;">*</span></label><br><br>
        <input type="text" name= "email" id = "email" pattern="g\d{2}[A-Za-z]\d{4}@campus\.ru\.ac\.za" title ="Email must start with 'g', followed by 2 digits, 1 letter, 4 digits, and end with '@campus.ru.ac.za'"required><br><br>

        <label for="StudentNumber">Student Number <span style="color: red;">*</span></label><br><br>
        <input type="text" name="StudentNumber" id="StudentNumber" maxlength="8"  pattern="g\d{2}[A-Za-z]\d{4}" 
        title = "Student number must start with 'g', followed by 2 digits, 1 letter, and 4 digits" required> <br><br>

        <label for="Residence">Residence Name <span style="color: red;">*</span></label><br><br>
        <select  name="Residence" id="Residence" required>
        <?php
            require_once("config.php");
            $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT  Residence_ID, Residence_Name FROM residence"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {?> 
            <option value = "" >--Select a residence--</option>
                <?php
                while ($row = $result->fetch_assoc()) {?>
                     <option value= <?php echo "'" . $row['Residence_Name'] . "'" ?> > <?php echo $row['Residence_Name'] ?></option>
              <?php  }
            } else { ?>
                <option value= <?php echo'' ?> >No residences available</option>
            <?php }

            $conn->close();
            ?> 
        </select><br><br>

        <label for="Username">Create Username <span style="color: red;">*</span></label><br><br>
        <input type="text" name="Username" id=" Username" required><br><br>

        <label for="Password">Create Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="Passwords" id="Passwords" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$" 
        title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&#)" 
        required><br><br>
        
        <label for="ConfirmPassword">Confirm Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="ConfirmPassword" id="ConfirmPassword" required><br><br>   

        <label id="errorlbl">

        <?php if(isset($_SESSION['error']))
        {   $x = $_SESSION['error'];
            if($x){
            echo "Passwords do not match";} }
        
        ?>  </label>

        <input type="submit" value="Create Account">               

        </form>
</div>


<?php 
}elseif($role === "Warden"){ ?>

    <div class = "container">
    <h2>Create Account</h2>
        <form  method="POST" action = "addprofile.php">
        <label for="FirstName">First Name: <span style="color: red;">*</span></label><br><br>
        <input type="text" name="FirstName" id="FirstName" required><br><br>
        
        <label for="LastName">Last Name: <span style="color: red;">*</span> </label><br><br>
        <input type="text" name="LastName" id="LastName" required><br><br>

        <label for="Email">Email <span style="color: red;">*</span></label><br><br>
        <input type="text" name= "email" id = "email" pattern="^[Ss]20[Xx]\d{3}@[Cc][Aa][Mm][Pp][Uu][Ss]\.ru\.ac\.za$"  title ="Email must start with 's20x', followed by 3 digits and end with '@campus.ru.ac.za'"required><br><br>

        <label for="StaffNumber">Staff Number <span style="color: red;">*</span></label><br><br>
        <input type="text" name="StaffNumber" id="StaffNumber" maxlength="8"  pattern="^[Ss]20[Xx]\d{3}$"
        title = "Staff number must start with 's20x', followed by 3 digits" required> <br><br>

        <label for="Residence">Residence Name <span style="color: red;">*</span></label><br><br>
        <select  name="Residence" id="Residence" required>
        <?php
            require_once("config.php");
            $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT  Residence_ID, Residence_Name FROM residence"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {?> 
            <option value = "" >--Select a residence--</option>
                <?php
                while ($row = $result->fetch_assoc()) {?>
                     <option value= <?php echo "'" . $row['Residence_Name'] . "'" ?> > <?php echo $row['Residence_Name'] ?></option>
              <?php  }
            } else { ?>
                <option value= <?php echo'' ?> >No residences available</option>
            <?php }

            $conn->close();
            ?> 
        </select><br><br>

        <label for="Username">Create Username <span style="color: red;">*</span></label><br><br>
        <input type="text" name="Username" id=" Username" required><br><br>

        <label for="Password">Create Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="Passwords" id="Passwords" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$" 
        title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&#)" 
        required><br><br>
        
        <label for="ConfirmPassword">Confirm Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="ConfirmPassword" id="ConfirmPassword" required><br><br>   

        <label id="errorlbl">

        <?php if(isset($_SESSION['error']))
        {   $x = $_SESSION['error'];
            if($x){
            echo "Passwords do not match";} }
        
        ?>  </label>

        <input type="submit" value="Create Account">               

        </form>
</div>


<?php 
}elseif($role === "Secretary"){ ?>
<div class = "container">
<h2>Create Account</h2>
        <form  method="POST" action = "addprofile.php">
        <label for="FirstName">First Name: <span style="color: red;">*</span></label><br><br>
        <input type="text" name="FirstName" id="FirstName" required><br><br>
        
        <label for="LastName">Last Name: <span style="color: red;">*</span> </label><br><br>
        <input type="text" name="LastName" id="LastName" required><br><br>

        <label for="Email">Email <span style="color: red;">*</span></label><br><br>
        <input type="text" name= "email" id = "email" pattern="^[Ss]21[Xx]\d{3}@[Cc][Aa][Mm][Pp][Uu][Ss]\.ru\.ac\.za$"
        title ="Email must start with 's21x', followed by 3 digits and end with '@campus.ru.ac.za'"required><br><br>

        <label for="StaffNumber">Staff Number <span style="color: red;">*</span></label><br><br>
        <input type="text" name="StaffNumber" id="StaffNumber" maxlength="8"  pattern="^[Ss]21[Xx]\d{3}$" 
        title = "Staff number must start with 's21x'  followed by 3 digits" required> <br><br>

        <label for="hall">Hall Name <span style="color: red;">*</span></label><br><br>
            <select name="hall" id="hall" required><br><br>

            <?php
            require_once("config.php");
            $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT  Hall_ID, hall_name FROM hall";  
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {?> 
            <option value = "" >--Select a hall--</option>
                <?php
                while ($row = $result->fetch_assoc()) {?>
                     <option value= <?php echo "'" . $row['Hall_ID'] . "'" ?> > <?php echo $row['hall_name'] ?></option>
              <?php  }
            } else { ?>
                <option value= <?php echo'' ?> >No halls available</option>
            <?php }

            $conn->close();
            ?> 
        </select><br><br>
          
        <label for="Username">Create Username <span style="color: red;">*</span></label><br><br>
        <input type="text" name="Username" id=" Username" required><br><br>

        <label for="Password">Create Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="Passwords" id="Passwords" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$" 
        title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&#)" 
        required><br><br>
        
        <label for="ConfirmPassword">Confirm Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="ConfirmPassword" id="ConfirmPassword" required><br><br>   

        <label id="errorlbl">

        <?php if(isset($_SESSION['error']))
        {   $x = $_SESSION['error'];
            if($x){
            echo "Passwords do not match";} }
        
        ?>  </label>

        <input type="submit" value="Create Account">               

        </form>
</div>


<?php
 }elseif($role === "Maintenance"){ ?>
<div class = "container">
<h2>Create Account</h2>
        <form  method="POST" action = "addprofile.php">
        <label for="FirstName">First Name: <span style="color: red;">*</span></label><br><br>
        <input type="text" name="FirstName" id="FirstName" required><br><br>
        
        <label for="LastName">Last Name: <span style="color: red;">*</span> </label><br><br>
        <input type="text" name="LastName" id="LastName" required><br><br>

        <label for="Email">Email <span style="color: red;">*</span></label><br><br>
        <input type="text" name= "email" id = "email" pattern="^[Ss]22[Xx]\d{3}@[Cc][Aa][Mm][Pp][Uu][Ss]\.ru\.ac\.za$"  title ="Email must start with 's22x', followed by 3 digits and end with '@campus.ru.ac.za'"required><br><br>

        <label for="StaffNumber">Staff Number <span style="color: red;">*</span></label><br><br>
        <input type="text" name="StaffNumber" id="StaffNumber" maxlength="8"  pattern="^[Ss]22[Xx]\d{3}$"  
        title = "Staff number must start with 's22x', followed by 3 digits" required> <br><br>

        <label for="Username">Create Username <span style="color: red;">*</span></label><br><br>
        <input type="text" name="Username" id=" Username" required><br><br>

        <label for="Password">Create Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="Passwords" id="Passwords" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$" 
        title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&#)" 
        required><br><br>
        
        <label for="ConfirmPassword">Confirm Password <span style="color: red;">*</span></label><br><br>
        <input type="password" name="ConfirmPassword" id="ConfirmPassword" required><br><br>   

        <label id="errorlbl">

        <?php if(isset($_SESSION['error']))
        {   $x = $_SESSION['error'];
            if($x){
            echo "Passwords do not match";} }
        
        ?>  </label>

        <input type="submit" value="Create Account">               

        </form>
</div>
<?php } ?>

    
</body>
</html>