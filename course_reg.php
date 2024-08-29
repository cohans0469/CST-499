<?php
// Connect to the database
session_start();
$pageTitle = "Course Registration";
$pageHeader = "Select a Course to Enroll";
$_SESSION["pageTitle"] = $pageTitle;
$_SESSION["pageHeader"] = $pageHeader;
require 'db.php';
require 'master.php';
require 'functions.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// function call to display the courses in a table

coursesTable($conn);


// Check if the form has been submitted
if (isset($_POST['enroll'])) {
  // Get the course_id from the form submission
  $course_id = $_POST['course_id'];

  // Store the course_id in the session variable
  $_SESSION['course_id'] = $course_id;

  // Enroll the student in the course
  enrollStudent($conn);

} elseif (isset($_POST['waitlist'])) {
  // Get the course_id from the form submission
  $course_id = $_POST['course_id'];

  // Store the course_id in the session variable
  $_SESSION['course_id'] = $course_id;

  addStudentToWaitlist($conn);
}

// Close the database connection
$conn->close();

require 'footer.php';

