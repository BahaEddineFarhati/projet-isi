<?php
// Get the JSON data from the request body
$data = file_get_contents('php://input');
$json = json_decode($data, true);

// Sanitize the input data
$id = filter_var($json['id'], FILTER_SANITIZE_NUMBER_INT);
$name = filter_var($json['name'], FILTER_SANITIZE_STRING);
$email = filter_var($json['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($json['password'], FILTER_SANITIZE_STRING);
$number = filter_var($json['number'], FILTER_SANITIZE_NUMBER_INT);
$role = filter_var($json['role'], FILTER_SANITIZE_STRING);
$domain = filter_var($json['domain'], FILTER_SANITIZE_STRING);

// Create a new MySQLi object
$conn = new mysqli("localhost", "root", "", "ForminiTn");

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement with placeholders
$stmt = $conn->prepare("INSERT INTO accounts (name, email, password, number, role, domain) VALUES (?, ?, ?, ?, ?, ?)");

// Bind the sanitized values to the placeholders
$stmt->bind_param("sssiss", $name, $email, $password, $number, $role, $domain);

// Execute the prepared statement
$stmt->execute();

// Close the database connection
$conn->close();
?>
