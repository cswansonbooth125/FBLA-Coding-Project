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
<body class = 'index-body'>
    <div class="main-header">
        <h1>Our Partners</h1>
    </div>

    <!-- Search box. -->
    <form action="search-script.php" method="post">
        <br>
           
        <input class = 'update-input' type="text" id="searchTerm" name="searchTerm" required placeholder="Search"><br>
        <button class = 'button-13' type="submit">Search</button>
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
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="dropdown1">Type of Partner</label>
    <select id="dropdown1" name="dropdown1">
        <option value=""></option> <!-- Empty option -->
        <?php
        // Fetching data for first dropdown
        $sql = "SELECT DISTINCT Type FROM partners_table";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["Type"] . "'>" . $row["Type"] . "</option>";
            }
        }
        ?>
    </select>

    <label for="dropdown2">Resources From Partner</label>
    <select id="dropdown2" name="dropdown2">
        <option value=""></option> <!-- Empty option -->
        <?php
        // Fetching data for second dropdown
        $sql = "SELECT DISTINCT Resources FROM partners_table";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["Resources"] . "'>" . $row["Resources"] . "</option>";
            }
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Submit">
</form>


<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from dropdowns
    $selectedValue1 = $_POST["dropdown1"];
    $selectedValue2 = $_POST["dropdown2"];

    // Clear existing records from the new table
    $sql_clear = "TRUNCATE TABLE filtered_partners";
    if ($conn->query($sql_clear) !== TRUE) {
        echo "Error clearing table: " . $conn->error;
    }

    // Check if both dropdowns are set to empty option
    if (empty($selectedValue1) && empty($selectedValue2)) {
        // If both dropdowns are empty, insert all items from the original table into the new table
        $sql_insert_all = "INSERT INTO filtered_partners SELECT * FROM partners_table";
        if ($conn->query($sql_insert_all) !== TRUE) {
            echo "Error inserting all records: " . $conn->error;
        }
    } else {
        // Search for items in the table based on dropdown selections
        $sql = "SELECT * FROM partners_table WHERE Type = '$selectedValue1' OR Resources = '$selectedValue2'";
        $result = $conn->query($sql);

        // If matching items found, add them to a new table
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Insert entire row into the new table
                $sql_insert = "INSERT INTO filtered_partners (Name, Type, Resources, Contact_info) 
                               VALUES ('" . $row["Name"] . "', '" . $row["Type"] . "', '" . $row["Resources"] . "', '" . $row["Contact_info"] . "')";
                if ($conn->query($sql_insert) !== TRUE) {
                    echo "Error inserting record: " . $conn->error;
                }
            }
            echo "Records inserted successfully";
        } else {
            echo "No matching records found";
        }
    }
}
$conn->close();
// Close connection
?>

    <!-- Displays the unfiltered or filtered table. -->
    <?php
        include("display-table-script.php");
    ?>

    <form class = 'login-form' action="login-script.php" method="post">
        <p>If you are an admin you can login below.</p>
        <label for="Username"></label>
        <input class = 'update-input' type="text" name="uname" placeholder="Username"><br>

        <label for="Password"></label>
        <input class = 'update-input' type="password" name="password" placeholder="Password"><br>

        <button class = 'button-13' type="submit">Login</button>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
            
        
    </form>

    
    

</body>
</html>