<?php
// Connect to the database
session_start();
$pageTitle = "Registered Courses";
$pageHeader = "You are Registered for the Following Courses";
$_SESSION["pageTitle"] = $pageTitle;
$_SESSION["pageHeader"] = $pageHeader;
require 'db.php';
require 'master.php';
require 'functions.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Retrieve the student's enrollments from the database
$student_id = $_SESSION['id'] ?? false;
$sql = "SELECT courses.id, courses.name, enrollments.status 
        FROM enrollments 
        JOIN courses ON enrollments.course_id = courses.id 
        WHERE enrollments.user_id = $student_id";
$result = $conn->query($sql);

// Display the student's enrollments
displayTable($result);

// Check if the form has been submitted
if (isset($_POST['cancel'])) {
    // Get the enrollment_id from the form submission
    $enrollment_id = $_POST['enrollment_id'] ?? false;
    // Get the student_id associated with the enrollment
    $sql = "SELECT user_id FROM enrollments WHERE id = $enrollment_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row = $result->fetch_assoc()) {
    $student_id = $row['user_id'];
    $student_id = $row['user_id'];
    if ($row = $result->fetch_assoc()) {
        $student_id = $row['user_id'];
        
    }
    header("Location: schedule.php");
}
    // Call the cancelEnrollment function
    if (cancelEnrollment($conn, $student_id, $enrollment_id)) {
        echo "Status updated to 'canceled' successfully";
    } else {
        echo "Error updating status: {$conn->error}";
    }
}
