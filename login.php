<?php
$title = 'Login';
$active = 'login';
include("header.php");
?>

<div class="f-container">
  <!-- <form class="needs-validation" action="login.php" method="post" novalidate> -->
  <form class="form-signin border rounded shadow-lg needs-validation" novalidate>
    <div class="d-flex justify-content-center">
      <h1 class="h3 fw-normal">Login to continue</h1>
    </div>
    <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" required placeholder="Enter your email">
      <label for="floatingInput">Email</label>
      <div class="invalid-feedback">
        Please enter your Email.
      </div>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" required placeholder="Enter your password">
      <label for="floatingPassword">Password</label>
      <div class="invalid-feedback">
        Please enter password.
      </div>
    </div>

    <!-- <div class="padding d-flex justify-content-center">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me" >
        <label for="remember-me" class="form-check-label">Remember me</label>
      </div>
    </div> -->

    <div class="d-flex justify-content-center">
      <button class="f-btn rounded" type="submit">Login</button>
    </div>
  </form>
</div>

<?php
include("footer.php");
?>