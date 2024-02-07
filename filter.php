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
    // Initialize variables
    $whereClause = "";
    $params = array();

    // Check if dropdown1 value is set and not empty
    if (isset($_POST["dropdown1"]) && !empty($_POST["dropdown1"])) {
        $selected_option1 = $_POST["dropdown1"];
        $whereClause .= "Type = :option1";
        $params[':option1'] = $selected_option1;
    }

    // Check if dropdown2 value is set and not empty
    if (isset($_POST["dropdown2"]) && !empty($_POST["dropdown2"])) {
        $selected_option2 = $_POST["dropdown2"];
        if (!empty($whereClause)) {
            $whereClause .= " AND ";
        }
        $whereClause .= "Resources = :option2";
        $params[':option2'] = $selected_option2;
    }

    // Prepare and execute SQL query
    if (!empty($whereClause)) {
        $sql = "DELETE FROM filtered_partners WHERE $whereClause";
        $stmt = $db->prepare($sql);
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();

        // Check if any rows were affected
        $rows_affected = $stmt->rowCount();
        if ($rows_affected > 0) {
            echo "Deleted $rows_affected rows from the table.";
        } else {
            echo "No rows deleted. Maybe no matching rows found.";
        }
    } else {
        echo "No filter criteria selected.";
        header("Location: index.php");
        exit();
    }
} else {
    // If form is not submitted
    echo "Form not submitted.";
}

?>
