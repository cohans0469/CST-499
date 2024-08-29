<?php
require 'db.php';
// Start the session
if(session_status() === PHP_SESSION_NONE) {
  session_start();

  $pageTitle = isset($_SESSION['pageTitle']) ? $_SESSION['pageTitle'] : 'Default Title';
  $pageHeader = isset($_SESSION['pageHeader']) ? $_SESSION['pageHeader'] : 'Default Header';
}


if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


  $loggedIn = isset($_SESSION['masterVar']) ? true : false;

  // Display navbar based on login status
  if($loggedIn) {
    // Fetch user data based on the session variable
    $userName = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE username = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);

    
    require 'logged_in_nav.php';
    echo "Welcome " . $row["first_name"]. " " . $row["last_name"] . "<br>";
  } else {
    require 'logged_out_nav.php';
    echo "Welcome Guest";
  }


// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .container {
      height: 25vh;
      display: flex;
      justify-content: top;
      align-items: center;
      flex-direction: column;
    }

    .links {
      display: flex;
      justify-content: space-between;
      width: 125px;
    }
  </style>
</head>
<body>
  <h1 class="text-center"><?php echo $pageHeader; ?></h1>
</body>
</html>