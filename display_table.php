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

    $sql = "SELECT * FROM partners_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data and display it in HTML table
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Type</th><th>Resources</th><th>Contact_info</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Type"] . "</td><td>" . $row["Resources"] . "</td><td>" . $row["Contact_info"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
?>