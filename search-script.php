<?php

// Database connection parameters
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

// Get search term from the form
$searchTerm = $_POST['searchTerm'];

// SQL query to search in your database (modify it based on your database structure)
$sql = "SELECT * FROM partners_table WHERE Name LIKE '%$searchTerm%'";

$result = $conn->query($sql);

$deleteSQL = "DELETE FROM search_results";
$conn->query($deleteSQL);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Insert the found item into a new table
        $insertSQL = "INSERT INTO search_results (Name, Type, Resources, Contact_info) VALUES ('" . $row["Name"] . "', '" . $row["Type"] . "', '" . $row["Resources"] . "', '" . $row["Contact_info"] ."')";

        // Execute the insert query
        if ($conn->query($insertSQL) === TRUE) {
            echo " - Name: " . $row["Name"] . " - Inserted into found_items_table successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
header('Location: search-page.php');
exit();

?>
