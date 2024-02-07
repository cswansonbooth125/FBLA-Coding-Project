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
    echo "<h3>Partner Information</h3>";

    // Add a form element for checkbox selection and deletion
    echo "<form id='deleteForm' action='delete-row-script.php' method='post'>";

    echo "<ul class='responsive-table-admin'>";
    
    // Table header
    echo "<li class='table-header'>";
    echo "<div class='col col-0'>Select</div>"; // Checkbox column
    echo "<div class='col col-1'>Name</div>";
    echo "<div class='col col-2'>Type</div>";
    echo "<div class='col col-3'>Resources</div>";
    echo "<div class='col col-4'>Contact Info</div>";
    echo "</li>";

    while ($row = $result->fetch_assoc()) {
        // Table rows with checkboxes
        echo "<li class='table-row'>";
        echo "<div class='col col-0' data-label='Select'><div class='tooltip-container'><input type='checkbox' name='delete[]' value='" . $row["ID"] . "'><span class='tooltip-text'>Click to delete the selected rows from the table</span></div></div>"; // Assuming ID is the primary key
        echo "<div class='col col-1' data-label='Name'>" . $row["Name"] . "</div>";
        echo "<div class='col col-2' data-label='Type'>" . $row["Type"] . "</div>";
        echo "<div class='col col-3' data-label='Resources'>" . $row["Resources"] . "</div>";
        echo "<div class='col col-4' data-label='Contact Info'>" . $row["Contact_info"] . "</div>";
        echo "</li>";
    }

    // End of responsive-table container
    echo "</ul>";

    // Add a delete button
    echo "<div class='tooltip-container'>";
    echo "<button type='submit' name='deleteButton' class='tool'>Delete Selected Rows</button>";
    echo "<span class='tooltip-text'>Click to delete the selected rows from the table</span>";
    echo "</div>";


    // Close the form
    echo "</form>";

    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();
header("Location: admin-search-page.php");
exit();
?>