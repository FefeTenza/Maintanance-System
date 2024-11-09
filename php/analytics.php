<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location:..\profile\login\login.html");
}


 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics </title>
    <link rel="stylesheet" href="../css/analytics.css" />
    <link href="../images/logo_white.jpg" rel="icon" type="image/x-icon" />


</head>
<!-- -->

<header id="titlesec">

    <img id="logoimg" src="../images/logo_pink.jpg">
    <!--<img id="profileimg" src="../images/account.png">-->

    <h1 id="maintlt"> MAINTAINX </h1>
    <nav>
        <a class="nav_itm" href="home.php"> Home </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="..\About\about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="..\profile\dashboard\dashboard.php"> Dashboard </a><a class="spacer"> | </a>
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
<div class="tester">
  <a class="picbt" href="home.php"><img src="..\create_ticket\pics\ihome.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\create_ticket\ct.php"><img src="..\create_ticket\pics\iticket.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="analytics.php"><img src="..\create_ticket\pics\igraph.png"
      style="width:60px;height:60px;" /></a>
</div>
    <?php

    require_once("config.php");

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    ?>
  
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <body>

        <h1 id="AHeader">Analytics </h1>
        <br><br>

        <div id='container2'>
            <div id="myChart">
                <br>
                <h2>Open Tickets </h2>
                <?php
                $sql = "SELECT COUNT(Ticket_ID) AS ticket_count
                        FROM ticket
                        WHERE Status_Update != 'Closed'";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Query failed to execute");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<strong id='ticket'>" . $row["ticket_count"] . "</strong>";
                }
                ?>

                <h2>Closed Tickts </h2>

                <?php
                $sql = "SELECT COUNT(Ticket_ID) AS ticket_count
                        FROM ticket
                        WHERE Status_Update = 'Closed'";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Query failed to execute");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<strong id='ticket'>" . $row["ticket_count"] . "</strong>";
                }
                ?>
            </div>
            <div id="myChart">
                <br>
                <h2>Students</h2>
                <?php
                $sql = "SELECT COUNT(Student_Number) AS student_count
                        FROM student ";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Query failed to execute");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<strong id='ticket'>" . $row["student_count"] . "</strong>";
                }
                ?>

                <h2>Staff</h2>
                <?php
                $sql = "SELECT (SELECT COUNT(user.Username) FROM user) - (SELECT COUNT(student.Student_Number) FROM student) AS staff_count";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Query failed to execute");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<strong id='ticket'>" . $row["staff_count"] . "</strong>";
                }
                ?>
            </div>
            <div id="myChart">
                <br>
                <h2>Avg Turnaround</h2>
                <?php
                $sql = "(SELECT AVG(DateClosedBy  - DateReportedBy) +1  AS TurnAround From ticket where  DateClosedBy IS NOT NULL) ";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Query failed to execute");
                }
                while ($row = $result->fetch_assoc()) { 
                    echo "<strong id='ticket'>" . round($row["TurnAround"], 1) . " days </strong>";
                }
                ?>

            
                
            </div>
        </div>
        <br><br>
        <div class='container'>
            <div id="TicketsPerRes" style="width:100%; max-width:600px; height:500px;"></div>
            <div id="Catago" style="width:100%; max-width:600px; height:500px;"></div>
            <div id="TicketsPerHall" style="width:100%; max-width:600px; height:500px;"></div>
        </div>

        <div class='container'>
            <div id="TicketStatus" style="width:100%; max-width:600px; height:500px;"></div>
            <div id="PerSemester" style="width:100%; max-width:600px; height:500px;"></div>
            <div id="CatagoHist" style="width:100%; max-width:600px; height:500px;"></div>
        </div>

        <script>
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                // Set Data
                <?php
                $sql = "SELECT residence.Residence_Name, COUNT(ticket.Ticket_ID) AS ticket_count
                        FROM ticket, residence
                        WHERE residence.Residence_ID = ticket.Residence_ID
                        GROUP BY residence.Residence_Name;";
                $result = $conn->query($sql);
                ?>
                const data = new google.visualization.arrayToDataTable(
                    [
                        ['res', 'tickets']
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo ",['";
                            echo $row["Residence_Name"];
                            echo "', ";
                            echo $row["ticket_count"];
                            echo "]";
                        }
                        ?>
                    ]);

                <?php
                $sql1 = "SELECT category.CategoryFault, COUNT(ticket.CategoryFault) AS cat_count
                        FROM category, ticket
                        WHERE category.Category_ID = ticket.CategoryFault AND NOT ticket.Status_Update = 'Closed'
                        GROUP BY category.CategoryFault;";
                $result1 = $conn->query($sql1);
                ?>
                const data1 = new google.visualization.arrayToDataTable(
                    [
                        ['Catagory', 'tickets']
                        <?php
                        while ($row1 = $result1->fetch_assoc()) {
                            echo ",['";
                            echo $row1["CategoryFault"];
                            echo "', ";
                            echo $row1["cat_count"];
                            echo "]";
                        }
                        ?>
                    ]);

                <?php
                $sql2 = "SELECT hall.Hall_Name, COUNT(ticket.Ticket_ID) AS ticket_count
                        FROM ticket, residence, hall
                        WHERE residence.Residence_ID = ticket.Residence_ID 
                        AND residence.Hall_ID = hall.Hall_ID
                        GROUP BY hall.Hall_Name;";
                $result2 = $conn->query($sql2);
                ?>
                const data2 = new google.visualization.arrayToDataTable(
                    [
                        ['Hall', 'tickets']
                        <?php
                        while ($row = $result2->fetch_assoc()) {
                            echo ",['";
                            echo $row["Hall_Name"];
                            echo "', ";
                            echo $row["ticket_count"];
                            echo "]";
                        }
                        ?>
                    ]);


                <?php
                $sql3 = "SELECT Status_Update, COUNT(Ticket_ID) AS ticket_count
                        FROM ticket
                        WHERE NOT Status_Update = 'Closed'
                        GROUP BY Status_Update;";
                $result3 = $conn->query($sql3);
                ?>
                const data3 = new google.visualization.arrayToDataTable(
                    [
                        ['Status Update', 'tickets']
                        <?php
                        while ($row = $result3->fetch_assoc()) {
                            echo ",['";
                            echo $row["Status_Update"];
                            echo "', ";
                            echo $row["ticket_count"];
                            echo "]";
                        }
                        ?>
                    ]);

                <?php
                $sql4 = "SELECT 
            residence.Residence_Name, 
            COUNT(CASE WHEN ticket.DateReportedBy < '2024-06-01' THEN ticket.Ticket_ID END) AS ticket_count_before,
            COUNT(CASE WHEN ticket.DateReportedBy >= '2024-06-01' THEN ticket.Ticket_ID END) AS ticket_count_after
        FROM residence
        LEFT JOIN ticket ON residence.Residence_ID = ticket.Residence_ID 
        GROUP BY residence.Residence_Name;";
                $result4 = $conn->query($sql4);
                ?>
                const data4 = new google.visualization.arrayToDataTable(
                    [
          ['Residence', '1st Semester', '2nd Semester']
                        <?php
                        while ($row4 = $result4->fetch_assoc()) {
                            echo ",['";
                            echo $row4["Residence_Name"];
                            echo "', ";
                            echo $row4["ticket_count_before"];
                            echo ", ";
                            echo $row4["ticket_count_after"];
                            echo "]";
                        }
                        ?>
                    ]); 

                <?php
                $sql6 = "SELECT category.CategoryFault, COUNT(ticket.CategoryFault) AS cat_count
                        FROM category, ticket
                        WHERE category.Category_ID = ticket.CategoryFault AND ticket.Status_Update = 'Closed'
                        GROUP BY category.CategoryFault;";
                $result6 = $conn->query($sql6);
                ?>
                const data5 = new google.visualization.arrayToDataTable(
                    [
                        ['Catagory', 'tickets']
                        <?php
                        while ($row1 = $result6->fetch_assoc()) {
                            echo ",['";
                            echo $row1["CategoryFault"];
                            echo "', ";
                            echo $row1["cat_count"];
                            echo "]";
                        }
                        ?>
                    ]);

                // Set Options
                const options = {
                    title: 'Tickerts per residence'
                };
                const options1 = {
                    title: 'Open tickerts per category'
                };

                const options2 = {
                    title: 'Tickerts per hall'
                };

                const options3 = {
                    title: "Open ticket's status"
                };

                const options4 = {
                    title: "Open ticket's per semester"
                };
                const options5 = {
                    title: "Tickerts per category Historical"
                };

                // Draw
                const chart = new google.visualization.BarChart(document.getElementById('TicketsPerRes'));
                chart.draw(data, options);

                const chart1 = new google.visualization.PieChart(document.getElementById('Catago'));
                chart1.draw(data1, options1);

                const chart2 = new google.visualization.BarChart(document.getElementById('TicketsPerHall'));
                chart2.draw(data2, options2);

                const chart3 = new google.visualization.PieChart(document.getElementById('TicketStatus'));
                chart3.draw(data3, options3);

                const chart4 = new google.visualization.BarChart(document.getElementById('PerSemester'));
                chart4.draw(data4, options4);

                const chart5 = new google.visualization.PieChart(document.getElementById('CatagoHist'));
                chart5.draw(data5, options5);
            }
        </script>

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

</html