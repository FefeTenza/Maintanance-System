<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />

</head>

<header id="titlesec">

    <img id="logoimg" src="../images/logo_pink.jpg">

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="..\php\home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../About/about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="../profile/dashboard/dashboard.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm"

            <?php if (isset($_SESSION['username'])): ?>
            href='..\profile\dashboard\dashboard.php'> <img id="prfico" src="../images/Profile.png"> <a class="nav_itm" href="..\php\logout.php">Logout </a>
        <?php else: ?>
            href='..\profile\login\login.html'> Login </a>
    <?php endif; ?>


    <!--href="login.php"> Login -->


    </a>
    </nav>

</header>

<body>
    <div id="container">
        <div class="wrapper">

            <H1> Frequently Asked Questions</H1>

            <div class="faq">
                <button class="accordion">
                    What is the Residence Maintenance System about?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p>The system is specifically designed for university students that live on campus to easily report and track maintenance issues in their residence, and it is available to all students who reside on campus as well as university staff involved in residence maintenance.</p>

                </div>
            </div>


            <div class="faq">
                <button class="accordion">
                    What should I do in case of an emergency manitenance issue?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p>The students request will prioritized, after they have communicated with their warden and will be dealt with immediately.</p>

                </div>
            </div>


            <div class="faq">
                <button class="accordion">
                    How can I track the progress of my maintenance request?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p>Once request is submitted, the student will receive an email or message that they can use to log into the system at any time to check their status.</p>

                </div>
            </div>


            <div class="faq">
                <button class="accordion">
                    What type of issues can be reported through the system?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p> Common issues like plumbing problems, electrical outages and general repairs like broken windows or doors. </p>

                </div>
            </div>


            <div class="faq">
                <button class="accordion">
                    Who will handle my maintenance request?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p> The warden will hand over the students request to the Hall secretary, who will then send it to the Maintetnace staff to fix the reported issue.</p>

                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    Is my personal information secure in the Residence Maintenance System?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p> The system follows strict security measures, where only authorized personnel can access the users data which would be soley used for managing maintenance requests and improving residence issues.</p>

                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    How can a student log in a ticket?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="panel">
                    <p>A student would have to log into their account click on the option of logging a maintenance ticket, fill in the required then submit the form and after they will receive a confirmation message where they can track the status of their ticket on the dashboard.</p>


                </div>
            </div>
            <div>

            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        this.parentElement.classList.toggle("active");

                        var panel = this.nextElementSibling;
                        if (panel.style.display === "block") {
                            panel.style.display = "none";
                        } else {
                            panel.style.display = "block"
                        }
                    })
                }
            </script>
            </div></div></div>
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