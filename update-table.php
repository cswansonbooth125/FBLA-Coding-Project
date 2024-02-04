<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "partners";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data

$column1 = $_POST['col1'];
$column2 = $_POST['col2'];
$column3 = $_POST['col3'];
$column4 = $_POST['col4'];

// Insert data into the database
$sql = "INSERT INTO partners_table (Name, Type, Resources, Contact_info) VALUES ('$column1', '$column2', '$column3', '$column4')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

header("Location: admin-page.php");
exit();
?>