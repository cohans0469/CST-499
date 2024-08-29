<?php
// Include the db.php file to access the $conn variable
require 'db.php';

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to enroll a student in a course
function enrollStudent($conn) {
  // Start the session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
    // Get the student_id and course_id from the session variables
    $student_id = $_SESSION['id'] ?? false;
    $course_id = $_SESSION['course_id'] ?? false;

    // Check if the student is already enrolled or waitlisted in the course
  $sql = "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND status IN ('enrolled', 'waiting', 'canceled')";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $student_id, $course_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['status'] == 'canceled') {
      // Update the status to enrolled
      $sql = "UPDATE enrollments SET status = 'enrolled' WHERE user_id = ? AND course_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $student_id, $course_id);
      $stmt->execute();
      echo "<p style='text-align: center;'>You are now enrolled in this course.</p>";
      return;
    } else {
      echo "<p style='text-align: center;'>You are already enrolled or waitlisted in this course.</p>";
      return;
    }
  }

  // Insert the student's enrollment into the database
  $sql = "INSERT INTO enrollments (user_id, course_id, status) VALUES (?, ?, 'enrolled')";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $student_id, $course_id);
  $stmt->execute();
}

// Function to cancel enrollment
function cancelEnrollment($conn, $user_id, $course_id) {
  $sql = "SELECT status FROM enrollments WHERE user_id = ? AND course_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $user_id, $course_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row['status'] == 'waiting') {
    // Delete the row from the waiting_lists table
    $sql = "DELETE FROM waiting_lists WHERE user_id = ? AND course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
  }

  // Update the status to 'canceled' in the enrollments table
  $sql = "UPDATE enrollments SET status = 'canceled' WHERE user_id = ? AND course_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $user_id, $course_id);
  $stmt->execute();

  header('Location: schedule.php');
  exit;
}
function coursesTable($conn) {
  // Retrieve the enrolled/waitlisted courses from the database
  $sql = "SELECT c.*, s.start_date, s.end_date, (c.capacity - (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id AND status = 'enrolled')) AS openings
          FROM courses c
          JOIN semesters s ON c.semester_id = s.id";
  $result = $conn->query($sql);
 

  // Display the courses 
  echo "<h1 style='text-align: center; text-decoration: underline;'>Available Courses</h1>";
  echo "<table style='margin: 0 auto; border-collapse: collapse;'>";
  echo "<tr>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Course ID</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Course Name</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Description</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Semester</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Start Date</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>End Date</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Openings</th>
          <th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Action</th>
        </tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["id"] . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["name"] . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["description"] . "</td>";
          $semester = ($row["semester_id"] == 1) ? 'Spring' : 'Fall';
          echo "<td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $semester . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["start_date"] . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["end_date"] . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["openings"] . "</td>
                  <td style='padding: 10px; border: 1px solid black; text-align: center;'>";
          if ($row["openings"] > 0) {
              echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"><input type="hidden" name="course_id" value="' . $row["id"] . '"><input type="submit" name="enroll" value="Enroll" class="btn btn-primary"></form>';
          } elseif ($row["openings"] == 0) {
            echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"><input type="hidden" name="course_id" value="' . $row["id"] . '"><input type="submit" name="waitlist" value="Wait List" class="btn btn-warning"></form>';
        } 
           
          
          echo "</td>
              </tr>";
      }
  echo "</table>";
}

function addStudentToWaitlist($conn) {
  
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $student_id = $_SESSION['id'] ?? false;
  $course_id = $_SESSION['course_id'] ?? false;

  // Check if the student is already enrolled or waitlisted in the course
  $sql = "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND status IN ('enrolled', 'waiting', 'canceled')";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $student_id, $course_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['status'] == 'canceled') {
      // Update the status to waiting
      $sql = "UPDATE enrollments SET status = 'waiting' WHERE user_id = ? AND course_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $student_id, $course_id);
      $stmt->execute();
      echo "<p style='text-align: center;'>You are now waitlisted in this course.</p>";
      return;
    } 
    else if ($row['status'] == 'enrolled') {
      echo "<p style='text-align: center;'>You are already enrolled in this course.</p>";
      return;
    } 
    else if ($row['status'] == 'waiting') {
      echo "<p style='text-align: center;'>You are already waitlisted in this course.</p>";
      return;
    }
  } 
  else if ($result->num_rows == 0) {
    $sql = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
  
    $sql = "UPDATE enrollments SET status = 'waiting' WHERE user_id = ? AND course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();

    $sql = "INSERT INTO waiting_lists (user_id, course_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
  
    echo "<p style='text-align: center;'>You are now waitlisted in this course.</p>";
  }
}
// Function to display the  enrolled table
function displayTable($result) {
  // Start the session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
  echo "<h1 style='text-align: center; text-decoration: underline;'>Your Schedule</h1>";
  if ($result->num_rows > 0) {
      echo "<table style='margin: 0 auto; border-collapse: collapse;'>";
      echo "<tr><th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Course Number</th><th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Course Name</th><th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Status</th><th style='padding: 10px; border: 1px solid black; text-align: center; text-decoration: underline;'>Action</th></tr>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr><td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["id"] . "</td><td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["name"] . "</td><td style='padding: 10px; border: 1px solid black; text-align: center;'>" . $row["status"] . "</td><td style='padding: 10px; border: 1px solid black; text-align: center;'>";
          if ($row["status"] == "enrolled") {
              echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><input type='hidden' name='enrollment_id' value='" . $row["id"] . "'><input type='submit' name='cancel' value='Cancel' class='btn btn-danger'></form>";
          } elseif ($row["status"] == "waiting") {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><input type='hidden' name='enrollment_id' value='" . $row["id"] . "'><input type='submit' name='cancel' value='Cancel' class='btn btn-danger'></form>";
        }
          echo "</td></tr>";
      }
      echo "</table>";
      return;
  } else {
      echo "<p style='text-align: center;'>You have no courses enrolled at this time.</p>";
      return;
  }
}

// Function to register a user
function registerUser($username, $password, $first_name, $last_name, $email, $address, $city, $state, $zip_code, $phone, $ssn, $conn) {
  // Start the session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
  // Sanitize input data
  $username = sanitizeInput($username);
  $password = sanitizeInput($password);
  $first_name = sanitizeInput($first_name);
  $last_name = sanitizeInput($last_name);
  $email = sanitizeInput($email);
  $address = sanitizeInput($address);
  $city = sanitizeInput($city);
  $state = sanitizeInput($state);
  $zip_code = sanitizeInput($zip_code);
  $phone = sanitizeInput($phone);
  $ssn = sanitizeInput($ssn);

  // Check if connection is established
  if (!$conn) {
      throw new Exception('Connection failed: ' . mysqli_connect_error());
  }

  // Prepare SQL query
  $sql = "INSERT INTO users (username, password, first_name, last_name, email, address, city, state, zip_code, phone, ssn) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  // Bind parameters
  $stmt->bind_param("sssssssssss", $username, $password, $first_name, $last_name, $email, $address, $city, $state, $zip_code, $phone, $ssn);

  // Execute query
  if (!$stmt->execute()) {
      throw new Exception('Error registering user: ' . $stmt->error);
  }

  // Close statement
  $stmt->close();
}

// Function to log in a user
function loginUser($username, $password, $conn) {
  // Start the session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

  // Sanitize input data
  $username = sanitizeInput($username);
  $password = sanitizeInput($password);

  // Prepare SQL query
  $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);

  // Bind parameters
  $stmt->bind_param("ss", $username, $password);

  // Execute query
  if (!$stmt->execute()) {
      throw new Exception('Error logging in user: ' . $stmt->error);
  }

  // Get result
  $result = $stmt->get_result();

  // Check if user exists
  if ($result->num_rows > 0) {
      return true;
  } else {
      return false;
  }

 
}

// Function to sanitize input
function sanitizeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Check if the form has been submitted
if (isset($_POST['login'])) {
    // Get the form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Check if the username and password are valid
    if (loginUser($username, $password, $conn)) {
        // Set the session variables
        $_SESSION['username'] = $username;

        // Redirect to the home page
        header("Location: index.php");
        exit;
    } else {
        // Display an error message
        $error_message = "Invalid username or password";
    }
}
