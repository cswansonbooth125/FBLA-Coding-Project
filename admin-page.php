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
        <img src="images/CTHS-logo.png" alt="CTHS-logo" style="width: 10%;">
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
        include("display-table.php");
    ?>
    
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