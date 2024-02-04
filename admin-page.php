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
    <div class="main-header">
        <h1>Our Partners</h1>
        
    </div>
    
    <?php

    if(isset($_SESSION['username'])) {
        $activeUser = $_SESSION['username'];
        echo '<h2> Welcome ' . $activeUser . '</h2>';
    };

    ?>

    

    <?php
        include("display-table-admin-page-script.php");
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
        <td><input class = 'update-input' type="text" name="col1" placeholder='Name'></td>
        <td><input class = 'update-input' type="text" name="col2" placeholder='Type'></td>
        <td><input class = 'update-input' type="text" name="col3" placeholder='Resources'></td>
        <td><input class = 'update-input' type="text" name="col4" placeholder='Contact Info'></td>
      </tr>
      <!-- Add more rows as needed -->
    </table>

    <!-- Add submit button or other form elements as needed -->
    <input class = 'button-13' type="submit" value="Add to table">
  </form>
  <form class = 'logout-button'action="index.php" method="post">
            <button type="submit">Logout</button>
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
