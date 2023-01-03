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

// retriving salons from database
$sql = "SELECT * FROM salons;";
$result = query($sql);
$salons = array();
for($i=1;$i<=mysqli_num_rows($result);$i++){
  $row = mysqli_fetch_assoc($result);
  $salons[] = $row['salon_name'].", ".$row['address'];
}

// error checking and making appointment
$salon = "";
$time = "11:00";
$error = "";
$success = false;
if(isset($_POST['submit'])){
  $salon = $_POST['salon'];
  $time = $_POST['time'];

  if(empty(trim($salon)) || trim($salon) == "none"){
    $error = "salon";
  }

  if(empty(trim($time))){
    $error = "time";
  }

  if(empty($error)){
    date_default_timezone_set('Asia/Kolkata');
    $time = date('Y-m-d').' '.$time.':00';
    $sql = "INSERT INTO appointments VALUES(default, '{$_SESSION['login_info']['email']}', '$salon', '$time');";
    query($sql);
    $success = true;
  }
}


con_close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $title = 'Appointment';
    include("header.php");
    ?>
  </head>

  <body>
    <?php
    $active = "make_appointment";
    include("nav.php");  
    ?>
    <div class="f-container">
      <?php
      if($success){
        ?>
        <div class="d-flex flex-column justify-content-center form-signup">
          <p class="h5">
            <b>Your appointment is created successfully.</b>
          </p>
          <button class="f-btn rounded" style="width:auto;"><a href="appointment.php">Make Another Appointment</a></button>
        </div>
        <?php
      }else {
      ?>
      <form action="appointment.php" class="form-signup border rounded shadow-lg" method="post">
        <div class="d-flex justify-content-center">
          <p class="h5">
            <b>Select Salon and Time according to your prefference</b>
          </p>
        </div>

        <div class="line mb-4"></div>

        <select name="salon" class="form-select mb-3 <?php if($error == "salon"){echo "is-invalid";} ?>">
          <option value="none" selected="selected">Select salon</option>
          <?php
          foreach($salons as $salon){
            echo '<option value="'."$salon".'">'."$salon".'</option>';
          }
          ?>
        </select>
        <div class="invalid-feedback">
          Please select a salon of your prefference.
        </div>

        <label for="timeValidation" class="h5">Choose time accordingly:</label>
        <!-- <div class="input-group" id="time">
          <span class="input-group-text"><div class="icon"><i class="bi bi-clock"></i></div></span>
          <input type="number" class="form-control" name="hour" value="08" min="01" max="12" size="2">
          <input type="number" class="form-control" name="min" value="00" min="00" max="59" step="05" size="2">
          <select name="meridian" id="" class="form-select">
            <option value="am">AM</option>
            <option value="pm" selected>PM</option>
          </select>
        </div> -->

        <div class="input-group mb-3">
          <span class="input-group-text"><div class="icon"><i class="bi bi-clock"></i></div></span>
          <input class="form-control <?php if($error == "time"){echo "is-invalid";} ?>" type="time" id="timeValidation" name="time" value="11:00" min="11:00" max="20:00">
          <span class="input-group-text bi"></span>
          <div class="invalid-feedback">
            Please choose a time of your prefference between 11:00 AM to 08:00 PM.
          </div>
        </div>

        <!-- <label for="salon-services" class="h5">
          Select the services you want:
        </label>
        <div class="d-flex flex-column" id="salon-services">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hair-cut" name="haircut" checked>
            <label for="hair-cut" class="form-check-label">Hair cut</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hair-cut" name="haircut">
            <label for="hair-cut" class="form-check-label">Hair cut</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="hair-cut" name="haircut">
            <label for="hair-cut" class="form-check-label">Hair cut</label>
          </div>
        </div> -->

        <div class="d-flex justify-content-center mt-3">
          <button class="f-btn rounded" type="submit" name="submit" style="width:auto;">Book Appointment</button>
        </div>

      </form>
      <?php
      }
      ?>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>