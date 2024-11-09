<!DOCTYPE html>
<html>
<body>

<?php
$servername = "is3-dev.ict.ru.ac.za";
$username = "OrderoftheHexes";
$password = "O6ttC2G0";
$database= "OrderoftheHexes";

$conn = new mysqli($servername, $username, $password, $database);
if($conn -> connect_error){

    die ("connection failed: " . $conn -> connect_error);

}
 $query = "SELECT * FROM category";
 $result = $conn -> query($query);

if ($result->num_rows > 0){

    while ($row = $result-> fetch_assoc()){
        echo "id". $row["Category_ID"]." type ".$row["CategoryFault"]."<br>";
    }

}
?>




</body>
</html>