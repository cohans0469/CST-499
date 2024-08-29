<?php
error_reporting (E_ALL ^ E_NOTICE);

session_start();

$pageTitle = "Student Portal"; 
$pageHeader = "Welcome To The Student Portal";
$_SESSION["pageTitle"] = $pageTitle;
$_SESSION["pageHeader"] = $pageHeader;
require 'db.php';
require 'master.php';
require 'functions.php';
require 'footer.php';
 
