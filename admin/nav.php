<?php
if(!isset($active)){
  $active = '';
}
?>

<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
<div class="container d-flex justify-content-center justify-content-md-between">
  <div class="contact-info d-flex align-items-center">
    <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">easy-salon@gmail.com</a>
    <i class="bi bi-phone-fill phone-icon"></i> +91 9876543210
  </div>
  <!-- <div class="social-links d-none d-md-block">
    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
  </div> -->
</div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
<div class="container d-flex align-items-center justify-content-between">

  <h1 class="logo"><a href="index.php">Easy Salon</a></h1>
  <!-- Uncomment below if you prefer to use an image logo -->
  <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->

  <nav id="navbar" class="navbar">
    <ul>
      <li><a class="nav-link scrollto<?php if($active == 'home'){echo " active";} ?>" href="index.php">Home</a></li>

      <?php
      // ----------------- checking if the user is logged in or not
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
      ?>
      <li class="dropdown">
        <a href="#" class="<?php if(strchr($active, 'salon')){echo " active";} ?>">
          <span>Salon</span>
          <i class="bi bi-chevron-down"></i>
        </a>
        <ul>
          <li><a class="nav-link scrollto<?php if($active == 'addsalon'){echo " active";} ?>" href="add.php">Add Salon</a></li>
          <li><a class="nav-link scrollto<?php if($active == 'rmvsalon'){echo " active";} ?>" href="rmv.php">Remove Salon</a></li>
          <li><a class="nav-link scrollto<?php if($active == 'viewsalon'){echo " active";} ?>" href="view.php">View Salons</a></li>
        </ul>
      </li>
      <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
          <li><a href="#">Drop Down 1</a></li>
          <li><a href="#">Drop Down 2</a></li>
          <li><a href="#">Drop Down 3</a></li>
          <li><a href="#">Drop Down 4</a></li>
        </ul>
      </li> -->

      <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>

      <?php
      } else{
      ?>

      <li><a class="nav-link scrollto<?php if($active == 'login'){echo " active";} ?>" href="login.php">Login</a></li>

      <?php
      }
      ?>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->

</div>
</header><!-- End Header -->