<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        <a class="nav_itm" href="about.php"> About Us </a> <a class="spacer"> | </a>
        <a class="nav_itm" href="dash.php"> Dashboard </a><a class="spacer"> | </a>
        <a class="nav_itm" href="login.php"> Login </a>
    </nav>

</header>

<body>

    <?php

    require_once("config.php");

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    ?>
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <body>

        <h1 id="AHeader">Analytics </h1>
        <br><br>

        <br><br>

        <div class='container'>
            <div id="PerSemester" style="width:100%; max-width:600px; height:500px;"></div>

        </div>

        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                // Set Data
                
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

        
        var data = google.visualization.arrayToDataTable([          ['Residence', '1st Semester', '2nd Semester']
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


        var options = {
          chart: {
            title: 'Tickets per semester per residence',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('PerSemester'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
        </script>

    </body>

    <footer>
        <table id="foottable">
            <tr>
                <td class="fttbltd">
                    <img id="footimg" src="../images/logo_pink.jpg">
                    <p id="foottxt">© MaintainX 2025 All Rights Reserved &nbsp <a class="spacer"> | </a>
                        <a class="foot_nav_itm" href="https://www.youtube.com/watch?v=GFq6wH5JR2A"> T&C's </a> <a class="spacer"> | </a>
                        <a class="foot_nav_itm" href="https://www.youtube.com/watch?v=GFq6wH5JR2A"> FAQ </a>
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
                    <img id="icon" src="../images/inst_icon.png">
                    <img id="icon" src="../images/faceboon_icon.png">
                    <img id="icon" src="../images/twitter_icon.png">

                </td>
            </tr>
        </table>
    </footer>

</html