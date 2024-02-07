<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "partners";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM search_results";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start of responsive-table container
    echo "<div class='container'>";
    echo "<h2>Partner Information</h2>";
    echo "<ul class='responsive-table'>";
    
    // Table header
    echo "<li class='table-header'>";
    echo "<div class='col col-1'>Name</div>";
    echo "<div class='col col-2'>Type</div>";
    echo "<div class='col col-3'>Resources</div>";
    echo "<div class='col col-4'>Contact Info</div>";
    echo "</li>";

    while ($row = $result->fetch_assoc()) {
        // Table rows
        echo "<li class='table-row'>";
        echo "<div class='col col-1' data-label='Name'>" . $row["Name"] . "</div>";
        echo "<div class='col col-2' data-label='Type'>" . $row["Type"] . "</div>";
        echo "<div class='col col-3' data-label='Resources'>" . $row["Resources"] . "</div>";
        echo "<div class='col col-4' data-label='Contact Info'>" . $row["Contact_info"] . "</div>";
        echo "</li>";
    }

    // End of responsive-table container
    echo "</ul>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();

