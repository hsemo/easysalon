<?php
session_name('EASYSALON-ADMIN');
$prms = session_get_cookie_params();
session_set_cookie_params($prms['lifetime'], 'admin/', $prms['domain'], $prms['secure'], $prms['httponly']);
session_start();

// checking if the user is logged in or not
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true){
  $_SESSION['login_msg'] = "You are not logged in, Please log in to continue";
  header("Location: login.php");
  die();
}

require("../dbcon.php");
$sql = "SELECT * FROM salons;";
$result = query($sql);

if(isset($_POST['submit'])){
  $salons = $_POST;
  unset($salons['submit']);
  $salons = array_keys($salons);

  foreach($salons as $salon){
    $salon = str_replace('_', ' ', $salon);
    $sql = "DELETE FROM salons WHERE salon_name='$salon';";
    query($sql);
  }
}

$sql = "SELECT * FROM salons;";
$result = query($sql);

con_close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $title = 'Remove Salon';
    include("header.php");
    ?>
  </head>

  <body>
    <?php
    $active = 'rmvsalon';
    include("nav.php");  
    ?>
    <div class="n-container">
      <form action="rmv.php" class="d-flex flex-column form-signin rounded shadow-lg" method="post">
        <div class="d-flex justify-content-center">
          <p class="h6">
            Select the salons you want to remove and hit the remove button
          </p>
        </div>

        <?php
        $counter = 111111;
        for($i=0;$i<mysqli_num_rows($result);$i++){
          $arr = mysqli_fetch_assoc($result);
          ?>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="<?php echo $arr['salon_name']; ?>" id="<?php echo $counter; ?>">
            <label for="<?php echo $counter; ?>" class="form-check-label"><?php echo $arr['salon_name']; ?></label>
          </div>
          <?php
          $counter++;
        }
        ?>
        
        <div class="d-flex justify-content-center" >
          <button class="f-btn rounded" type="submit" name="submit">Remove</button>
        </div>
      </form>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>