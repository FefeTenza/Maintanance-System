<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUpRole</title>
</head>

<style>

    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url("Textured .png"); 
    }

.container{
    display: block;
    margin-left: 120px;
    margin-right: 120px;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-color: #FBDADE;
    width:400px;
    border-radius: 30px;
   
}

  
   label {
        display: block;
        margin-bottom: 5px;
    }

    select {
        width: 50%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        
    }
</style>

<body>
    <div class = "container">
        <h2>SignUp<h2>
        <form action = "signup.php" METHOD = POST>
            <img src = "logo_pink.jpg" alt = "Logo"><br><br>
            <select name = "Roles" id = "Role" required>
                <option value = "">--Select Your Role--</option>
                <option value = "Student">Student</option>
                <option value = "Warden">Warden</option>
                <option value = "Secretary">Secretary</option>
                <option value = "Maintenance">Maintenance</option>
            </select><br>

            <input type = "submit" value = "submit" name = "submit">
        </form>
</div>

</html>