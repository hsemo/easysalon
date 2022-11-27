<?php
session_name('EASYSALON');
session_start();

// checking if the user is logged in or not
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true){
  $_SESSION['login_msg'] = "You are not logged in, Please log in to continue";
  header("Location: login.php");
  die();
}
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
    include("nav.php");  
    ?>
    <div class="f-container">
      <form action="appointment.php" class="form-signup border rounded shadow-lg" method="post">
        <select name="city" id="city" class="form-select mb-3">
          <option value="none" selected="selected">Select salon</option>
          <?php
          for($i=1;$i<=10;$i++){
            echo "<option value=\"mandsaur\">Salon $i</option>";
          }
          ?>
        </select>
        <label for="time" class="h5">Choose time accordingly</label>
        <div class="input-group" id="time">
          <span class="input-group-text"><div class="icon"><i class="bi bi-clock"></i></div></span>
          <input type="number" class="form-control" name="hour" value="12" min="1" max="12">
          <input type="number" class="form-control" name="min" value="00" min="0" max="59">
          <select name="meridian" id="" class="form-select">
            <option value="am" selected>AM</option>
            <option value="pm">PM</option>
          </select>
        </div>

      </form>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>