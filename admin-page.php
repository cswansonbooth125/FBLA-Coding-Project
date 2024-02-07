<?php

session_start();
if (isset($_SESSION['id']))
{

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
<body>
    <div class = "backing">
    <div class="main-header">
        <h1>Our Partners</h1>
        <div class = "logout">
            <form class = 'logout-button logout'action="index.php" method="post">
                <button class = "logout" type="submit">Logout</button>
            </form>
        </div>
    </div>
    
    

        <!-- Search box. -->
        <br>
        <form action="admin-search-script.php" method="post">
            <label for="searchTerm">Search:</label>
            <input class= "textInput" type="text" id="searchTerm" name="searchTerm" required>
            
        </form>
    
        <?php

        if(isset($_SESSION['username'])) {
            $activeUser = $_SESSION['username'];
        echo '<h2> Welcome ' . $activeUser . '</h2>';
        };

        ?>

    

        <?php
            include("display-table-admin-script.php");
        ?>

        <br>
        <br>
        <br>

        <h3>Create New Table Entry</h3>

        <form class = 'update' action="update-table-index-script.php" method="post">
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
                <!-- Add more rows as needed -->
            </table>


   
            <div class="tooltip-container">
                <input class='button-13 tool' type="submit" value="Add to table">
                <span class="tooltip-text">Click to add the information to the table</span>
            </div>
        
        </form>
    </div>
    </div>
    
    

    <!-- Search box. -->
    <form action="admin-search-script.php" method="post">
        <label for="searchTerm">Search:</label>
        <input type="text" id="searchTerm" name="searchTerm" required>
        <button type="submit">Search</button>
    </form>
    
    
    
    <?php

    if(isset($_SESSION['username'])) {
        $activeUser = $_SESSION['username'];
        echo '<h2> Welcome ' . $activeUser . '</h2>';
    };

    ?>

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
        } else {
            echo "All records inserted successfully";
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

    <?php
        include("display-table-admin-script.php");
    ?>

    <br>
    <br>
    <br>

    <h3>Create New Table Entry</h3>

    <form class = 'update' action="update-table-index-script.php" method="post">
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
  <!-- Add more rows as needed -->
</table>


    <!-- Add submit button or other form elements as needed -->
    <div class="tooltip-container">
        <input class='button-13 tool' type="submit" value="Add to table">
        <span class="tooltip-text">Click to add the information to the table</span>
    </div>

  </form>
  
</body>
</html>

<?php 
} 
else 
{
    header("Location: index.php");
    exit();
}
?>
