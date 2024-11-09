<?php
session_start();

 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="about.css" />
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />


</head>
<!-- -->

<header id="titlesec">

    <img id="logoimg" src="../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="..\php\home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../profile/dashboard/dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm" 
        
        <?php if (isset($_SESSION['username'])):?>
             href='..\profile\dashboard\dashboard.php'> <img id="prfico" src="../images/Profile.png"> <a class="nav_itm" href="..\php\logout.php">Logout </a>
             <?php else: ?>
            href='..\\profile\login\login.html'> Login </a>
          <?php endif;?>
        
        
        <!--href="login.php"> Login -->


        </a>
    </nav>

</header>

<body>
    
    <div class="company">
    <h3 class="knowus">Who We Are</h3>
<p><b>Founded in 2011, MaintainX is an award-winning company dedicated to creating top-tier websites for residences, ensuring seamless management and communication for both universities and independent accommodation providers. Our innovative system has been recognized globally for its excellence, providing efficient, user-friendly solutions tailored to the specific needs of each client. We proudly work with universities and accommodation services worldwide, helping them enhance their online presence and improve operational efficiency.</b></p>
</div>  


<table class="mission">
   <tr>

<td id="info" >
    <h4>OUR MISSION</h4>
    <P>At MaintainX, our mission is to create innovative, efficient, and user-friendly maintenance systems that enhance the student experience at residences. We aim to foster a safe, well-maintained, and conducive living environment through streamlined communication, data-driven decision-making, and optimized resource allocation. Our solutions are designed to ensure timely resolutions, efficient operations, and continuous improvement, leaving a lasting positive impact on both residents and management.</P></td>
    <td class="mv"><img src="images\Res students.png" alt="res students"></td>
</tr>
    <tr>
        <td class="mv"><img src="images\maintenance.jpg" alt="maintenance"></td>
        <td id="info"><h4>OUR VISION</h4>
        <P>At MaintainX, our vision is to revolutionize the way residences are managed globally, creating smart, sustainable, and highly efficient living environments. We aspire to be the leading provider of intelligent maintenance systems that foster seamless collaboration, elevate student satisfaction, and set new standards for safety, quality, and operational excellence. Through continuous innovation and data-driven solutions, we envision a future where every student residence enjoys an unparalleled living experience, supported by proactive and efficient management. </P></td>
       
    </tr>
</table>

    
    <table class="difference">
        <tr>
        <th COLSPAN="5"><b>What Sets Our Offerings Apart:</b></th>
    </tr>
        <tr>
            <td>
                <img src="images\proactive.png" alt="proactive icon">
                <h4 >Proactive and Predictive Maintenance</h4>
                <p>Ensure minimal downtime with advanced maintenance strategies that anticipate and resolve issues before they escalate, optimizing asset performance.</p>
            </td>
            <td>
                <img src="images\efficiency.png" alt="Efficiency icon">
                <h4>Efficient and timely service</h4>
                <p>Deliver swift, high-quality services that minimize operational delays. Focus on reducing inefficiencies and improving turnaround times for seamless workflow execution.</p>
            </td>
            <td>
                <img src="images\lock.png" alt="security icon">
                <h4>Safety and Security Integration</h4>
                <p>Integrate cutting-edge security measures to ensure a safe environment for all residents. Combine proactive monitoring with advanced safety protocols to mitigate risks effectively</p>
            </td>
            <td>
                <img src="images\dashboard.png" alt="dashboard">
                <h4>Data-driven Insights and Generated reports</h4>
                <p>Leverage actionable insights and comprehensive reports to make informed decisions, improving operational efficiency and transparency.</p>
            </td>
            <td>
                <img src="images\positive.png" alt="resident experience">
                <h4>Seamless Resident Experience</h4>
                <p>Enhance resident satisfaction with streamlined services and digital solutions that simplify everyday interactions and improve overall convenience.</p>
            </td>
        </tr>
    </table>

    <section class="facts">
        <div class="factbox">
            <h3><b>100,000+</b></h3>
            <p><b>Customers</b></p>
        </div>
        <div class="factbox">
            <h3><b>18,750</b></h3>
            <p><b>Global employees</b></p>
        </div>
        <div class="factbox">
            <h3><b>205</b></h3>
            <p><b>Customer countries and territories</b></p>
        </div>
        
        
    </section>
    <div class="intro">
    <h1><i>Meet our team—the dedicated professionals working to streamline your experience and simplify every maintenance request.</i> </h1>
    <p>Our team’s expertise and dedication ensure the seamless operation of the residence maintenance system. Each member plays a crucial role in addressing technical issues and enhancing user experience. Explore how our combined efforts deliver a reliable and efficient service for you</p>
</div>
    <table class="container">
        <tr class="row1">
            <td>
                <figure>
                <img src="images\Jack.png" alt="Member 1">
                <figcaption><b>Jack Roberts</b></figcaption>
                <figcaption>Software Developer</figcaption>
                </figure>
            </td>
            <td>
                <figure>
                <img src="images\Oyama.png" alt="Member 2">
                <figcaption><b>Oyama Williams</b></figcaption>
                <figcaption>UI/UX Designer</figcaption>
                </figure>
            </td>
            <td>
                <figure>
                <img src="images\Akisa.png" alt="Member 3">
                <figcaption><b>Akisa Kakia</b></figcaption>
                <figcaption>Project Manager</figcaption>
                </figure>
            </td>
        </tr>
            <tr class="row2">
            <td>
                <figure>
                <img src="images\Liyema.png" alt="Member 4">
                <figcaption><b>Liyema Adonis</b></figcaption>
                <figcaption>Database Manager</figcaption>
                </figure>
            </td>
            <td>
                <figure>
                <img src="images\Fefe.png" alt="Member 5">
                <figcaption><b>Nonhlanhla Tenza</b></figcaption>
                <figcaption>Quality Assurance Tester </figcaption>
                </figure>
            </td>
            </tr>
        </tr>
        <p></p>
    </table>

    <div class="quote">
        <h2><i>"Alone we can do so little; together we can do so much." — Helen Keller</i></h2>

    </div>
<section class="review-section">
    <h1>See What Some Of Our Clients Have to Say About MaintainX...</h1>
    <div id="review">
        <img class="picture1" src="images\review picture.png" alt=" reviewer">
        <!-- <div class="column">
            <table>
                <tr>
                <td>  <p class="name"><b>Zeabe Sanderton</b></p></td> --> 
    </tr>
    <!-- <tr id="test">
       <td><img class="picture2" src="images\rating.png" alt="rating star"></td> 
    </tr> -->
    <p class="name"><b>Zeabe Sanderton</b></p>
    <img class="picture2" src="images\rating.png" alt="rating star">
<tr>
<td>   <p class="review-note">Maintain created an efficient maintenance system for my rental property company. Maintenance has been made easier and my tenants are satisfied. My favourite part has to be the generated reports. It helps us analyse and improve our maintenance ,which is a crucial part of a rental business. </p></td> 
    </tr>
    </table>
    </div>

</section>

<section class="contactus">
   
    <table id="contactusinfo">
        <tr>
           <td> <img src="images\contact image.jpg" alt="contactimage"></td>
    <td id="forminfo"> 
        <h2>Collaborate with us and unlock new possibilities!</h2>   
        <p>Have questions or want to learn more about us? Send us a message, and we'll get back to you quickly with all the information you need!</p><br>
   <form action="" method="post">
    <label for="fname">First Name:</label><br>
    <input type="text" id="fname" name="firstname" placeholder="Your name.." required><br>
    <label for="lname">Last Name:</label><br>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.." required><br>
    <label for="email">Email:</label><br>
    <input type="text" placeholder="Enter Email address..." name="email" required><br>
    <label for="Message">Message:</label><br>
    <textarea id="Message" name="Message" placeholder="How can we help you?" required></textarea><br><br>
    <input type="submit" value="submit"><br><br>
</td>
</tr>
   </form>
</table>
</section>
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