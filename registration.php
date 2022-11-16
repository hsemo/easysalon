<?php
$title = 'Registration';
$active = 'registration';
include("header.php");
?>

<main class="f-container">
  <form class="form-signup border rounded shadow-lg" action="registration.php" method="post">
    <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <div class="d-flex justify-content-center">
      <h1 class="h3 fw-normal">Register to continue</h1>
    </div>

    <div class="d-flex">
      <div class="form-floating">
        <input type="text" class="form-control" id="fname" required placeholder="Enter your name">
        <label for="fname">First Name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="lname" required placeholder="Enter your name">
        <label for="lname">Last Name</label>
      </div>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" required placeholder="Enter your email">
      <label for="email">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="pass" required placeholder="Enter your password">
      <label for="pass">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" id="confirmPass" class="form-control" required placeholder="Confirm your password">
      <label for="confirmPass">Confirm Password</label>
    </div>

    <div class="d-flex justify-content-center">
      <button class="f-btn rounded" type="submit">Register</button>
    </div>
  </form>
</main>

<?php
include("footer.php");
?>