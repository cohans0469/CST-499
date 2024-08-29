<?php
// Start the session
session_start();
$pageTitle = "Sign In";
$pageHeader = "Sign In to Your Account";
require 'db.php';
require 'master.php';
require 'functions.php'; 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if username and password are set
  if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call login_user function
    if(!empty($username) && !empty($password)) {
      // Set session variables
      $_SESSION["masterVar"] = true;
      $_SESSION["username"] = $username;
      $_SESSION["pageTitle"] = $pageTitle;
      $_SESSION["pageHeader"] = $pageHeader;

      // Prepare and execute the SQL query to get the user ID
      $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $_SESSION["id"] = $row['id'];

      // Pass the loggedin session variable to master.php
      $loggedIn = isset($_SESSION['loggedin']) ? true : false;
      $masterVar = array();
      $masterVar["logged_in"] = $loggedIn;
      require 'master.php';

      

      // Redirect to index.php
      header('Location: index.php');
      exit;
    } else {
      echo "Invalid User Name or password";
    }
  } else {
    echo "User Name or password not provided";
  }
}


?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display: flex; flex-direction: column; max-width: 300px; margin: 0 auto;">
    <label for="username">User Name:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div style="display: flex; justify-content: space-between; margin-top: 10px; margin-bottom: 20px;">
        <input type="submit" value="Log In" style="flex: 1; margin-right: 5px;">
        <input type="reset" value="Reset" style="flex: 1; margin-left: 5px;">
    </div>
</form>

<?php require 'footer.php'; ?>
