<?php 
session_start();
include "../php/server.php";
include '../php/onload.php';

if (isset($_POST['logout'])){
  $_SESSION = array();
  session_destroy();
  header("Location: ../pages/account-login.html");
  exit();
}

?>