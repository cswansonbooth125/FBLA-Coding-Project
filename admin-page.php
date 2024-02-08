<?php
session_start();
if (isset($_SESSION['id'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@600&display=swap" rel="stylesheet">
    </head>

    <body class="index-body">
        <div class="backing">
            <div class="main-header">
                <h1>PartnerSphere</h1>
                <div class="logout">
                    <form class='logout-button logout' action="index.php" method="post">
                        <button class="logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>

            <br>

            <?php

            if (isset($_SESSION['username'])) {
                $activeUser = $_SESSION['username'];
                echo '<h2> Welcome ' . $activeUser . '</h2>';
            };

            ?>

            <h3>Filter Table</h3>
            <form method="get" action="">
                <label for="type">Select Type:</label>
                <select id="type" name="type">
                    <option value="">All</option>
                    <option value="Manufacturer">Manufacturer</option>
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
                <label for="resources">Select Resources:</label>
                <select id="resources" name="resources">
                    <option value="">All</option>
                    <option value="3D Printers">3D Printers</option>
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
                <input type="submit" value="Filter">
            </form>

            <h3>Search by Name</h3>
            <form method="get" action="">
                <input class = "search-bar" type="text" name="search" >
                <input type="submit" value="Search">
            </form>

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

            // Construct SQL query based on filter criteria
            $sql = "SELECT * FROM partners_table WHERE 1=1";
            if (!empty($_GET['type'])) {
                $type = $_GET['type'];
                $sql .= " AND Type = '$type'";
            }
            if (!empty($_GET['resources'])) {
                $resources = $_GET['resources'];
                $sql .= " AND Resources = '$resources'";
            }

            // Check if a search query is submitted
            if (isset($_GET['search'])) {
                // Get the search query
                $search = $_GET['search'];

                // Modify SQL query to filter results by name
                $sql .= " AND Name LIKE '%$search%'";
            }

            // Execute the SQL query
            $result = $conn->query($sql);

            // Display the filtered results
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

            ?>

            <br>
            <br>
            <br>

            <h3>Create New Table Entry</h3>

            <form class='update' action="update-table-index-script.php" method="post">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Resources</th>
                        <th>Contact Info</th>
                    </tr>
                    <tr>
                        <td class="tooltip-container">
                            <input class='update-input tooltip' type="text" name="col1" placeholder='Name'>
                            <span class="tooltip-text">Enter the name of the business or partner.</span></td>
                        <td class="tooltip-container"><input class='update-input' type="text" name="col2" placeholder='Type'>
                            <span class="tooltip-text">Enter the type of business</span></td>
                        <td class="tooltip-container"><input class='update-input' type="text" name="col3" placeholder='Resources'>
                            <span class="tooltip-text">Enter what this business provides</span></td>
                        <td class="tooltip-container"><input class='update-input' type="text" name="col4" placeholder='Contact Info'>
                            <span class="tooltip-text">Enter the contact info for this business</span></td>
                    </tr>

                </table>

                <!-- Add submit button or other form elements as needed -->
                <div class="tooltip-container">
                    <input class='button-13 tool' type="submit" value="Add to table">
                    <span class="tooltip-text">Click to add the information to the table</span>
                </div>

            </form>
        </div>
    </body>

    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>
