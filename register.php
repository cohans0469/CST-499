<?php
session_start();
$pageTitle = "Student Registration";
$pageHeader = "Student Registration";
$_SESSION["pageTitle"] = $pageTitle;
$_SESSION["pageHeader"] = $pageHeader;
require 'db.php';
require 'master.php';
require 'functions.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip_code = $_POST["zip_code"];
  $ssn = $_POST["ssn"];
  $phone = $_POST["phone"];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

  // Define the SQL query
  if (registerUser($username, $hashed_password, $first_name, $last_name, $email, $address, $city, $state, $zip_code, $phone, $ssn, $conn)) {
    echo "User registered successfully!";
} else {
    echo "Error registering user!";
    sleep(3);
    // Redirect to login.php
    header("Location: login.php");
    exit(); // Stop further execution
  }
}

$conn->close();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display: flex; flex-direction: column; max-width: 300px; margin: 0 auto;">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <label for="firstName">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" required>

    <label for="zip_code">Zip Code:</label>
    <input type="text" id="zip_code" name="zip_code" required>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="ssn">SSN:</label>
    <input type="text" id="ssn" name="ssn" required>


    <div style="display: flex; justify-content: space-between; margin-top: 10px; margin-bottom: 20px;">
        <input type="submit" value="Register" style="flex: 1; margin-right: 5px;">
        <input type="reset" value="Reset" style="flex: 1; margin-left: 5px;">
    </div>
</form>
<?php require 'footer.php'; ?>
