<?php
// database credentials
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ForminiTn";

// connect to database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// create table
$sql = 
"CREATE TABLE accounts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    motDePasse VARCHAR(50) NOT NULL,
    role VARCHAR(20) NOT NULL ,
) 
";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);
?>
