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

    <form action="login.php" method="post">
        <p>If you are an admin you can login below.</p>
        <label for="Username"></label>
        <input type="text" name="uname" placeholder="Username"><br>

        <label for="Password"></label>
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Login</button>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
            
        
    </form>
    

</body>
</html>