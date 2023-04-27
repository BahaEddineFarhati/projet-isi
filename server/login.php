<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  // Redirect to the dashboard or home page
  header("Location:/");
  exit();
}

// Get the JSON data from the request body
$data = file_get_contents('php://input');
$json = json_decode($data, true);

// Sanitize the input data

$email = filter_var($json['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($json['password'], FILTER_SANITIZE_STRING);
// Create a new MySQLi object
$conn = new mysqli("localhost", "root", "", "ForminiTn");

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement with placeholders
$stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ? AND password = ? ");

// Bind the sanitized values to the placeholders
$stmt->bind_param("ss", $email, $password);

// Execute the prepared statement
$stmt->execute();

// Get the results
$result = $stmt->get_result();

// Check if there is a match
if ($result->num_rows > 0) {
  // Login successful, set session variables and return some data
  $row = $result->fetch_assoc();
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['user_name'] = $row['name'];
  $_SESSION['user_email'] = $row['email'];
  $_SESSION['user_role'] = $row['role'];


  $response = array(
    "id" => $row["id"],
    "name" => $row["name"],
    "email" => $row["email"],  
    "role" => $row["role"]
  );
  echo json_encode($response);
} else {
  // Login failed, return an error message
  $response = array("message" => "Invalid email or password");
  echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
