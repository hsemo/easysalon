<?php

// global connection object uninitialized
$con = 0;
$root = "/phpCode/phpProjects/easysalon";

function create_con($host = 'localhost', $user = 'root', $passw = "", $db = 'easysalon'){
  global $con;
  global $root;
  if($con == 0){
    $con = mysqli_connect($host, $user, $passw, $db);
    // checking connection error
    if($con->connect_errno){
      $errno = $con->connect_errno;
      $error = urlencode($con->connect_error);
      header("Location: $root/error.php?errno={$errno}&error={$error}");
      die();
    }
  }
}


// closes the connection to database
function con_close(){
  global $con;
  $con->close();
  $con = 0;
}

// for checking error in executed mysql queries
function check_error(){
  global $con;
  global $sql;
  global $root;

  if($con->errno){
    $errno = $con->errno;
    $error = urlencode($con->error);
    header("Location: $root/error.php?errno={$errno}&error={$error}");
    con_close();
    die();
  }
}

function query($qry){
  global $con;
  global $root;

  $result = $con->query($qry);
  // error checking
  if($con->errno){
    $errno = $con->errno;
    $error = urlencode($con->error);
    header("Location: $root/error.php?errno={$errno}&error={$error}");
    con_close();
    die();
  }

  return $result;
}

create_con();
?>