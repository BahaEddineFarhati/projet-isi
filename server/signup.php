<?php
// Get the JSON data from the request body
$data = file_get_contents('php://input');
$json = json_decode($data, true);

// Sanitize and validate the input data
$name = filter_var($json['name'], FILTER_SANITIZE_STRING);
$email = filter_var($json['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $response = array("message" => "Invalid email format");
  echo json_encode($response);
  exit();
}
$password = filter_var($json['password'], FILTER_SANITIZE_STRING);
if (strlen($password) < 8) {
  $response = array("message" => "Password must be at least 8 characters long");
  echo json_encode($response);
  exit();
}
$role = filter_var($json['role'], FILTER_SANITIZE_STRING);

// Create a new MySQLi object
$conn = new mysqli("localhost", "root", "", "ForminiTn");

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the account already exists
$stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $response = array("message" => "Account with this email already exists");
  echo json_encode($response);
  exit();
}

// Prepare the SQL statement with placeholders
$stmt = $conn->prepare("INSERT INTO accounts (name, email, password, role) VALUES (?, ?, ?, ?)");

// Bind the sanitized values to the placeholders
$stmt->bind_param("ssss", $name, $email, $password, $role);

// Execute the prepared statement
$stmt->execute();

// Return success message
$response = array("message" => "Account created successfully");
echo json_encode($response);

// Close the database connection
$conn->close();
?>

