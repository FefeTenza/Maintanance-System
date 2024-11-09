<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location:..\profile\login\login.html");
}
elseif(($_SESSION['Roles']) == "Secretary") {
  header("Location:..\profile\dashboard\dashboard.php");

}


 ?> 

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Ticket</title>
  <link rel="stylesheet" href="ct.css">
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
        
        <?php if (isset($_SESSION['username'])):?>
             href='..\profile\dashboard\dashboard.php'> <img id="prfico" src="../images/Profile.png"> <a class="nav_itm" href="..\php\logout.php">Logout </a>
             <?php else: ?>
            href='..\profile\login\login.html'> Login </a>
          <?php endif;?>
        
        
        <!--href="login.php"> Login -->


        </a>
    </nav>

</header>

<body>
  
<div class="tester">
  <a class="picbt" href="..\php\home.php"><img src="pics\ihome.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="ct.php"><img src="pics\iticket.png"
      style="width:60px;height:60px;" /></a>
  <a class="picbt" href="..\php\analytics.php"><img src="pics\igraph.png"
      style="width:60px;height:60px;" /></a>
</div>

<div class="container">
        
    
<div class="content">
  <h2 div class="header">Create Ticket</h2>


  <?php
  $picture = "";
  $cate = "";
  $location = "";
  $desc = "";
  $status = "";
  $day = "";
  ?>

  <form action="action.php" method="POST" id="form" enctype="multipart/form-data">

    <label for="cat">Type of Fault</label><br>
    <select name="Category" id="Category">
      <?php
      $servername = "is3-dev.ict.ru.ac.za";
      $username = "OrderoftheHexes";
      $password = "O6ttC2G0";
      $database = "OrderoftheHexes";

      $con = new mysqli($servername, $username, $password, $database);
      $sql = "SELECT * FROM `category`";
      $all_categories = mysqli_query($con, $sql);

      while ($category = mysqli_fetch_array(
        $all_categories,
        MYSQLI_ASSOC
      )):;
      ?>
        <option value="<?php echo $category["Category_ID"];
                        ?>">
          <?php echo $category["CategoryFault"];
          ?></option>
      <?php
      endwhile; ?>
    </select>
    <br>
    <p>
      <label for="location">Location</label><br>
      <input type="text" id="location" name="location" required>
      <br>
    </p>

    <label for="des">Description</label><br>
    <textarea id="des" name="des" rows="3" cols="40" required></textarea><br>
    <br>

    <label for=img> Attach Image </label><br>
    <input type="file" name="picture" id="picture" multiple><br><br>

    <label for=img> Attach Image </label><br>
    <input type="file" name="pictures" id="pictures" multiple><br>

    <p>
      <label for="submit">
        <input type="submit" name="submit" value="submit" id="button">
      </label>
    </p>

    <label id="errorlbl">

<?php if(isset($_SESSION['error']))
{   $y = $_SESSION['error'];
    if($y){
    echo "Ticket has been Created!";} } //TICKET HAS UPDATED
    unset($_SESSION['error']);
?>  </label>

  </form>
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