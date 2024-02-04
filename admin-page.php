<?php
<<<<<<< HEAD
=======
//this shit only works at my dads wtf
session_start();
>>>>>>> 0661f7df3a0693046137529f7c1100465aa9eb67

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
    
    <form action="update-table.php" method="post">
        <input type="text">
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
