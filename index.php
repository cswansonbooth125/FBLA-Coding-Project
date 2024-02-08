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

<body>
    <div class="backing">
        <div class="main-header">
            <h1>PartnerSphere</h1>
        </div>
        <br>
        <!-- Search box. -->
        <form action="" method="get">
            <label for="searchTerm">Search:</label>
            <input class="search-bar" type="text" id="searchTerm" name="searchTerm">
            <button class="button-13" type="submit">Search</button>
        </form>

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


        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $database = "partners";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

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
        if (isset($_GET['searchTerm'])) {
            // Get the search query
            $searchTerm = $_GET['searchTerm'];

            // Modify SQL query to filter results by name
            $sql .= " AND Name LIKE '%$searchTerm%'";
        }

        // Execute the SQL query
        $result = $conn->query($sql);

        // Display the filtered results
        if ($result->num_rows > 0) {
            // Start of responsive-table container
            echo "<div class='container'>";
            echo "<h3>Partner Information</h3>";

            echo "<ul class='responsive-table-admin'>";

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

        ?>

        <br>
        <br>
        <br>

        <form class='login-form' action="login-script.php" method="post">
            <p>If you are an admin you can login below.</p>
            <label for="Username"></label>
            <input class='update-input' type="text" name="uname" placeholder="Username"><br>

            <label for="Password"></label>
            <input class='update-input' type="password" name="password" placeholder="Password"><br>

            <button class='button-13' type="submit">Login</button>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </form>
    </div>
</body>

</html>
