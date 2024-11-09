<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<style>
    *{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}

.login{
    height: 100vh;
    background-color: #FBDADE;
    background-position: center;
    background-repeat: no-repeat;
    background-size: auto;
    border: 20px;
    justify-content: center;
    align-items: center;
    display: flex;
    
}

.container{
    background-image: url(background.png);
    background-color: white;
    display: flex;
    flex-direction: column;
    width: 600px;
    height: 700px;
    justify-content: center;
    align-items: center;
    border-radius: 15px;
    box-shadow: 0 0 20px;
    
}


.input{
    padding: 8px 20px;
    margin: 5px;
    width: 100px;
    border: 1px solid #ccc;
    border-radius: 4px;
    
}

.lgn{
    margin-top: 20px;
    margin-bottom: 20px;
    
    
}
#login{
    padding: 10px 10px;
    text-decoration: none;
    color:black
    
   
}


#pass{
    margin-bottom: 10px;
}

#signUp{
    padding: 10px 46px;
    text-decoration: none;
    color: white;
    border: 2px solid silver;
}

#fgpass{
   padding: 10px 10px;
    color: black;
   
}
button{
    background-color: #e05780;
    color: white;
    padding: 14px 18px;
    margin:8px 0;
    border:none;
    cursor:pointer;
    width: 30%;
}
button:hover{
    opacity: 0.8;
} 

.sgnUp{
   display: contents;
}

#member{
    margin-right: 5px;
}
#sgn_now{
    text-decoration: none;
    
}

.login_btn:hover{
    background-color: transparent;
    transition:  .5s;
}


.cancelbtn {
    width: 100%;
 }
#username{
    padding: 5px 5px;
    text-decoration: none;
    color: none;
}

#password{
    padding: 5px 5px;
    text-decoration: none;
    color: none;
    width:183px;
    height:29px;

}
.imgcontainer{
    padding: 10px 20px;
}
#errorlbl{
    color: red;
}
</style>
<body>
    <form action="auth.php" method= "POST">
    <section class="login">
        <div class="container">
            <img src="Profile.png" width="130" height="130"><br>
                
            <h1>Login </h1>
            <div class="imgcontainer">
                
                
            </div>
           
    
            <input type="text" name= "Username" id="username" placeholder="Username" Required><br><br>
            <input type="password" name= "Passwords" id="Passwords" placeholder="Password" required><br><br>
            
            <!--<label id="errorlbl">

<?php if(isset($_SESSION['error']))
{   $y = $_SESSION['error'];
    if($y){
    echo "Ticket was Updated";} } //TICKET HAS UPDATED

?>  </label>-->

          <button type="submit" name="Login">Login</button>
          <br>
            <div class="signUp">
                <p id="Member">Not a Member? </p><br>
                <a href="..\signup\signUpRole.php" id="SignUp" class="SignUp">SignUp Now</a>

            </div>
            <br>
                <label id="errorlbl">

<?php if(isset($_SESSION['error']))
{   $y = $_SESSION['error'];
    if($y == "Log In Failed"){
    echo "Password or Username incorrect";} } //TICKET HAS UPDATED
    unset($_SESSION['error']);
?>  </label>
        </div>

    </section>
</form>

    

</body>
</html>