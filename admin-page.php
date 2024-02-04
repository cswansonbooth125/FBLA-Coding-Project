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
</head>
<body>
    <div class="main-header">
        <h1>Our Partners</h1>
    </div>
    
    <?php

    if(isset($_SESSION['username'])) {
        $activeUser = $_SESSION['username'];
        echo '<p> Welcome ' . $activeUser . '</p>';
    };

    ?>

    <form action="index.php" method="post">
        <button type="submit">Logout</button>
    </form>

    <?php
        include("display-table-admin.php");
    ?>

    <br>
    <br>
    <br>

    <h1>Create New Table Entry</h1>

    <form action="update-table.php" method="post">
    <table>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Resources</th>
        <th>Contact_info</th>
      </tr>
      <tr>
        <td><input type="text" name="col1"></td>
        <td><input type="text" name="col2"></td>
        <td><input type="text" name="col3"></td>
        <td><input type="text" name="col4"></td>
      </tr>
      <!-- Add more rows as needed -->
    </table>

    <!-- Add submit button or other form elements as needed -->
    <input type="submit" value="Add to table">
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
