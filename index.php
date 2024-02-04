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