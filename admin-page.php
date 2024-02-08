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
<body class = "index-body">
    <div class = "backing">
    <div class="main-header">
        <h1>PartnerSphere</h1>
        <div class = "logout">
            <form class = 'logout-button logout'action="index.php" method="post">
                <button class = "logout" type="submit">Logout</button>
            </form>
        </div>
    </div>
    
    

    <br>
    <!-- Search box. -->
    <form action="admin-search-script.php" method="post">
        <label for="searchTerm">Search:</label>
        <input class = "search-bar" type="text" id="searchTerm" name="searchTerm" required>
        
        
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

<form method="post" action="filter.php">
    <label for="dropdown1">Type of Partner</label>
    <select id="dropdown1" name="dropdown1">
        <option value=""></option> <!-- Empty option -->
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

            // Fetching data for dropdown
            $sql = "SELECT DISTINCT Type FROM partners_table";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Type"] . "'>" . $row["Type"] . "</option>";
                }
            }

            // Close connection
            ?>
    </select>

    <label for="dropdown2">Resources From Partner</label>
    <select id="dropdown2" name="dropdown2">
        <option value=""></option> <!-- Empty option -->
        <?php
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
