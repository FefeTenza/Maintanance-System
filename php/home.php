<?php
session_start();

 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css" />
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />


</head>
<!-- -->

<header id="titlesec">

    <img id="logoimg" src="../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../About/about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../profile/dashboard/dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm" 
        
        <?php if (isset($_SESSION['username'])):?>
             href='..\profile\dashboard\dashboard.php'> <img id="prfico" src="../images/Profile.png"> <a class="nav_itm" href="logout.php">Logout </a>
             <?php else: ?>
            href='..\profile\login\login.html'> Login </a>
          <?php endif;?>
        
        
        <!--href="login.php"> Login -->


        </a>
    </nav>

</header>

<body>

    <div id="topthings">
        <br>
        <h2 id="heading"> Maintenance Solutions Tailored To Your Needs And <br> Comfortability </h2>

        <p> Explore and discover an efficient residence maintenance system that will allow for efficient management of residence issues creating a home away home</p>
        <br><br>

        <img class="fix_icon" src="../images/fix_icon.png">
        <a id="getbtn" href="../profile/login/login.html">Get started</a>
        <img class="fix_icon" src="../images/fix_icon.png">
        <p id="spacer"> __________________________________________________ </p>
    </div>

    <img id="stockstu" src="../images/stockstudent.jpg">
    <div id="fstele">
        <h3> Take full advantage of: </h3>
        <ul>
            <li>Easy reporting of issues. </li>
            <li>Faster delivery of services.</li>
            <li>Ensures well-kept and safe environment.</li>
            <li>Increased student satisfaction.</li>
            <li>Streamlined communication.</li>
        </ul>
    </div>

    <br><br><br><br><br><br><br>

    <img id="home_res" src="../images/res_home.jpg">
    <div id="bstele">

        <ul>
            <h4 id="faciH">FACILITIES</h4>
            <strong> Operations: </strong>
            <li>Identification, prioritization, tracking, and resolution of maintenance tasks. </li>
            <li>Automation of maintenance procedures. </li>
            <strong> Analytics: </strong>
            <li>Maintenance reports. </li>
            <li>Analysis of maintenance trends. </li>
        </ul>
    </div>

    <div id="idk">

        <div class="stats">
            <div class="stattxt">
            <h3 class="stathead"> 32 </h3>
            <p> Residences under MaintainX's care </p>
            </div>
        </div>

        <div class="stats">
            <img id="pie" src="../images/pie.png">
            <h3 class="stathead"> 98% </h3>
            <p> User satisfaction rate</p>
        </div>

        <div class="stats">
            <div class="stattxt">
            <h3 class="stathead"> 3264 </h3>
            <p> Registered students </p>
            </div>
        </div>

        <div id="bubble">
            <img id="speech" src="../images/speech.png">
            <img id="otter" src="../images/file.png">
            <p id="ottertxt"> Your comfort <br> and <br> safety guaranteed </p>
        </div>
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