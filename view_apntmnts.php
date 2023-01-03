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


con_close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $title = 'View Appointments';
    include("header.php");
    ?>
  </head>

  <body>
    <?php
    $active = "my_appointments";
    include("nav.php");  
    ?>
    
    <div class="n-container">
      <div class="d-flex flex-column form-signin rounded shadow-lg" style="width: auto;">
        <div class="d-flex justify-content-center">
          <p class="h3">
            List of all Appointments
          </p>
        </div>

        <div class="line"></div>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Salon Name</th>
              <th scope="col">Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 1;
            for($i=0;$i<mysqli_num_rows($result);$i++){
              $row = mysqli_fetch_assoc($result);
              $time = explode(':', explode(' ', $row['time'])[1]);
              $time = $time[0].':'.$time[1];
              echo "<tr>";
              echo '<th scope="row">'."{$counter}</th>";
              echo "<td>{$row['salon_name']}</td>";
              echo "<td>{$time}</td>";
              echo "</tr>";
              $counter++;
            }
            ?>
          </tbody>
        </table>
        
        <!-- <div class="d-flex justify-content-center" >
          <button class="f-btn rounded" type="submit" name="submit">Remove</button>
        </div> -->
      </div>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>