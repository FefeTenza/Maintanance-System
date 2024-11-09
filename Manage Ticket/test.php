<!DOCTYPE html>
<html lang="en">

<body>
<?php
$servername = "is3-dev.ict.ru.ac.za";
      $username = "OrderoftheHexes";
      $password = "O6ttC2G0";
      $database = "OrderoftheHexes";

$id = '39';
    ?>

<div id="display-image">
    <?php
$conn = new mysqli($servername, $username,$password,$database);
$sql = "SELECT * FROM photos WHERE Ticket_ID = '$id'";
$result= mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <img src=
"../create_ticket/<?php echo $row["Photo_Address"]; ?>">

    <?php
        }
        
    ?>
    
</div>
</body>