<?php
session_name('EASYSALON-ADMIN');
$prms = session_get_cookie_params();
session_set_cookie_params($prms['lifetime'], 'admin/', $prms['domain'], $prms['secure'], $prms['httponly']);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    // session_start();
    $title = "Easy-Salon Admin";
    $active = '';
    include("header.php");
    ?>
  </head>

<body>
  <?php
  $active = 'home';
  include("nav.php");
  ?>

  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <h1>Welcome to Easy Salon Administrator Page</h1>
      <h2>You can add, remove and edit a new salon from here or delete a previously added salon.</h2>
      <a href="add.php" class="btn-get-started">Add salon</a>
      <a href="rmv.php" class="btn-get-started">Remove salon</a>
      <a href="view.php" class="btn-get-started">View salons</a>
    </div>
  </section>

  <!-- <div class="f-container"> -->
    
  <!-- </div> -->



  <?php
  include("footer.php");
  ?>
</body>
</html>