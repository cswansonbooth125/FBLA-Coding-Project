<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=partners';
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "partners";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}


$sql = "DELETE FROM filtered_partners;";
$conn->query($sql);
$sql = "INSERT INTO filtered_partners SELECT * FROM partners_table;";
$result = $conn->query($sql);



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least one dropdown value is set
    if (isset($_POST["dropdown1"]) || isset($_POST["dropdown2"])) {
        // Get selected options from the dropdowns
        $selected_option1 = isset($_POST["dropdown1"]) ? $_POST["dropdown1"] : null;
        $selected_option2 = isset($_POST["dropdown2"]) ? $_POST["dropdown2"] : null;

        // Prepare SQL query
        $sql = "DELETE FROM filtered_partners WHERE ";
        $conditions = array();

        // Add conditions for dropdown1 and dropdown2 if they are not empty
        if ($selected_option1 !== null) {
            $conditions[] = "Type != :option1";
        }
        if ($selected_option2 !== null) {
            $conditions[] = "Resources != :option2";
        }

        // Combine conditions with AND
        $sql .= implode(" AND ", $conditions);

        // Prepare and execute SQL query
        $stmt = $db->prepare($sql);
        if ($selected_option1 !== null) {
            $stmt->bindParam(':option1', $selected_option1);
        }
        if ($selected_option2 !== null) {
            $stmt->bindParam(':option2', $selected_option2);
        }
        $stmt->execute();

        // Check if any rows were affected
        $rows_affected = $stmt->rowCount();
        if ($rows_affected > 0) {
            echo "Deleted $rows_affected rows from the table.";
        } else {
            echo "No rows deleted. Maybe no matching rows found.";
        }

        header("Location: index.php");
        exit();
    } else {
        // If neither dropdown value is set
        echo "Please select at least one option from the dropdowns.";
    }
} else {
    // If form is not submitted
    echo "Form not submitted.";
}

?>
