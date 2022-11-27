<?php
$host = 'localhost';
$user = 'root';
$passw = "";
$db = 'easysalon';
// $db = '';
// $port = '';

// $con = new mysqli($host, $user, $pass, $db);
$con = mysqli_connect($host, $user, $passw, $db);

// checking connection error
if($con->connect_errno){
  header("Location: error.php?errno=$con->connect_errno&error=$con->connect_error");
  die();
}

// closes the connection to database
function con_close(){
  global $con;
  $con->close();
}

// for checking error in executed mysql queries
function check_error(){
  global $con;
  global $sql;
  if($con->errno){
    header("Location: error.php?errno=$con->errno&error=$con->error and Query: $sql");
    con_close();
    die();
  }
}

function query($qry){
  global $con;

  $result = $con->query($qry);
  // error checking 
  if($con->errno){
    header("Location: error.php?errno=$con->errno&error=$con->error and Query: $qry");
    con_close();
    die();
  }

  return $result;
}

?>