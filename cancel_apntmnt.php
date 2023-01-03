<?php
session_name('EASYSALON');
session_start();

// checking if the user is logged in or not
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true){
  $_SESSION['login_msg'] = "You are not logged in, Please log in to continue";
  header("Location: login.php");
  die();
}

require("dbcon.php");

// retriving appointments from database
$sql = "SELECT * FROM appointments WHERE user_email='{$_SESSION['login_info']['email']}';";
$result = query($sql);

// removing the cancelled appointments from database
if(isset($_POST['submit'])){
  $ids = $_POST;
  unset($ids['submit']);
  $ids = array_values($ids);

  foreach($ids as $id){
    $sql = "DELETE FROM appointments WHERE id='$id';";
    query($sql);
  }

  $sql = "SELECT * FROM appointments WHERE user_email='{$_SESSION['login_info']['email']}';";
  $result = query($sql);

}

con_close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $title = 'Cancel Appointments';
    include("header.php");
    ?>
  </head>

  <body>
    <?php
    $active = "cancel_appointment";
    include("nav.php");  
    ?>
    
    <div class="n-container">
      <form action="cancel_apntmnt.php" class="d-flex flex-column form-signin rounded shadow-lg" method="post">
        <div class="d-flex justify-content-center">
          <p class="h5">
            Select the appointments you want to cancel and hit the cancel button
          </p>
        </div>

        <div class="line mb-3"></div>

        <?php
        $counter = 111111;
        for($i=1;$i<=mysqli_num_rows($result);$i++){
          $row = mysqli_fetch_assoc($result);
          $time = explode(':', explode(' ', $row['time'])[1]);
          $time = $time[0].':'.$time[1];
          $appointment = $row['salon_name']." @ ".$time;
          $id = $row['id'];
          ?>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="<?php echo $appointment; ?>" id="<?php echo $counter; ?>" value="<?php echo $id; ?>">
            <label for="<?php echo $counter; ?>" class="form-check-label"><?php echo $appointment; ?></label>
          </div>
          <?php
          $counter++;
        }
        ?>
        
        <div class="d-flex justify-content-center mt-3" >
          <button class="f-btn rounded" type="submit" name="submit">Cancel</button>
        </div>
      </form>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>