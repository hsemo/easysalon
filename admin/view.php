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
    $active = 'viewsalon';
    include("nav.php");  
    ?>
    <div class="n-container">
      <div class="d-flex flex-column form-signin rounded shadow-lg" style="width: 70%;">
        <div class="d-flex justify-content-center">
          <p class="h3">
            List of all salons
          </p>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Salon Name</th>
              <th scope="col">City</th>
              <th scope="col">Owner Name</th>
              <th scope="col">Mobile Number</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 1;
            for($i=0;$i<mysqli_num_rows($result);$i++){
              $row = mysqli_fetch_assoc($result);
              echo "<tr>";
              echo '<th scope="row">'."{$counter}</th>";
              echo "<td>{$row['salon_name']}</td>";
              echo "<td>{$row['address']}</td>";
              echo "<td>{$row['owner_name']}</td>";
              echo "<td>{$row['mobile']}</td>";
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