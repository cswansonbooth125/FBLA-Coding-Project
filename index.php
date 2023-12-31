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
        include("display-table.php");
    ?>
    <div>
        <p>If you're an admin, login below.<br></p>
        <input type="text" id="username_input" placeholder="username">
        <input type="text" id="username_input" placeholder="password">
        <button style="font-size: 16px">
            Login
        </button>
    </div>
    

</body>
</html>