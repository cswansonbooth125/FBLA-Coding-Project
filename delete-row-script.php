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

// Check if the form is submitted and the delete button is pressed
if (isset($_POST['deleteButton']) && isset($_POST['delete'])) {
    $idsToDelete = $_POST['delete'];

    // Ensure $idsToDelete is an array to prevent SQL injection
    if (!is_array($idsToDelete)) {
        $idsToDelete = [$idsToDelete];
    }

    // Construct the SQL query to delete rows
    $sql = "DELETE FROM partners_table WHERE ID IN (" . implode(',', $idsToDelete) . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Selected rows deleted successfully.";
        header("Location: admin-page.php");
        exit();
    } else {
        echo "Error deleting rows: " . $conn->error;
    }
} else {
    echo "No rows selected for deletion.";
}

// Close connection
$conn->close();
?>