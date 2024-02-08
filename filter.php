<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$database = "partners";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$sql = "INSERT INTO partners_table_dup SELECT * FROM partners_table;";
$conn->query($sql);
$sql = "SELECT DISTINCT Name FROM partners_table_dup;";
$conn->query($sql);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from dropdowns
    $selectedValue1 = $_POST["dropdown1"];
    $selectedValue2 = $_POST["dropdown2"];

    // Constructing the condition based on the selected dropdown menu
    if (!empty($selectedValue1) && !empty($selectedValue2)) {
        // If both dropdowns are not empty, delete items that don't match either value
        $sql_delete = "DELETE FROM partners_table WHERE Type != '$selectedValue1' AND Resources != '$selectedValue2'";
    } elseif (!empty($selectedValue1)) {
        // If dropdown1 is not empty, delete items that don't match its value
        $sql_delete = "DELETE FROM partners_table WHERE Type != '$selectedValue1'";
    } elseif (!empty($selectedValue2)) {
        // If dropdown2 is not empty, delete items that don't match its value
        $sql_delete = "DELETE FROM partners_table WHERE Resources != '$selectedValue2'";
    } else {
        // Both dropdowns are empty, no action needed
        echo "No action performed as both dropdowns are empty.";
        header("Location: index.php");
        exit; // Exit script
    }

    // Execute the delete operation
    if ($conn->query($sql_delete) !== TRUE) {
        echo "Error deleting records: " . $conn->error;
    } else {
        echo "Records deleted successfully";
        header("Location: index.php");
    }
}

// Close connection
$conn->close();
?>