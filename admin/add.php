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

// for error checking
$salon_name = "";
$city = "";
$owner_name = "";
$mobile = "";
$error = "";
$success = false; //for giving message that salon is added successfully

// entering salon into database
if(isset($_POST['submit'])){
  $salon_name = $_POST['salon_name'];
  $city = $_POST['city'];
  $owner_name = $_POST['owner_name'];
  $mobile = $_POST['mobile'];

  if(strlen(trim($salon_name)) < 5){
    $error = "salon_name";
  }

  if(strlen(trim($city)) < 2){
    $error = "city";
  }

  if(strlen(trim($owner_name)) < 5){
    $error = "owner_name";
  }

  if(strlen(trim($mobile)) < 10 || strlen(trim($mobile)) > 10){
    $error = "mobile";
  }

  if(empty($error)){
    // inserting into database
    require("../dbcon.php");

    $sql = "INSERT INTO salons VALUES(default,'$salon_name', '$city', '$owner_name', '$mobile');";
    $result = $con->query($sql);

    $success = true;

    if($con->errno && strchr($con->error, "Duplicate")){
      $err_msg = "Please enter a different name for your salon.This name is taken";
      $error = "salon_name";
      $success = false;
    }

    // data is inserted now close the connection
    con_close();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $title = 'Add Salon';
    include("header.php");
    ?>
  </head>

  <body>
    <?php
    $active = 'addsalon';
    include("nav.php");
    ?>

    <div class="f-container">
      <form action="add.php" class="form-signin border rounded shadow-lg" method="post">
        <div class="d-flex justify-content-center">
          <?php
          if($success == true){
            echo "<p class=\"h4\">Salon added successfully</p>";
          }else {
            echo "<p class=\"h4\">Enter salon details</p>";
          }
          ?>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control<?php if($error == "salon_name"){echo " is-invalid";}?>" id="floatingSalonName" name="salon_name" minlength="5" maxlength="200" required="required" placeholder="Enter your salon name"value="<?php echo $salon_name; ?>">
          <label for="floatingSalonName">Salon name</label>
          <div class="invalid-feedback">
            <?php
            if(isset($err_msg)){
              echo $err_msg;
            }else {
              echo "Salon name is required.";
            }
            ?>
          </div>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control<?php if($error == "city"){echo " is-invalid";}?>" id="floatingSalonCity" name="city" minlength="2" maxlength="100" required="required" placeholder="Enter your salon city" value="<?php echo $city; ?>">
          <label for="floatingSalonCity">Salon city</label>
          <div class="invalid-feedback">
            Salon city is required.
          </div>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control<?php if($error == "owner_name"){echo " is-invalid";}?>" id="floatingSalonOwnerName" name="owner_name" minlength="5" maxlength="30" required="required" placeholder="Enter your salon owner name" value="<?php echo $owner_name; ?>">
          <label for="floatingSalonOwnerName">Salon owner name</label>
          <div class="invalid-feedback">
            Salon owner name is required.
          </div>
        </div>

        <div class="input-group my-input-group">
          <span class="input-group-text">+91</span>
          <div class="form-floating">
            <input type="tel" class="form-control<?php if($error == "mobile"){echo " is-invalid";}?>" id="floatingSalonMobile" name="mobile" minlength="10" maxlength="10" required="required" placeholder="Enter mobile number" pattern="[0-9]*" value="<?php echo $mobile; ?>">
            <label for="floatingSalonMobile">Mobile number</label>
            <div class="invalid-feedback">
              Salon contact information is required.
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between" >
          <button class="f-btn rounded" style="margin-right: 10px;" type="reset">Clear</button>
          <button class="f-btn rounded" style="margin-left: 10px;" type="submit" name="submit">Add Salon</button>
        </div>
      </form>
    </div>

    <?php
    include("footer.php");
    ?>
  </body>
</html>