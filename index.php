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
                <h1>PartnerSphere</h1>
            </div>
            <br>
            <!-- Search box. -->
            <form action="search-script.php" method="post">
                <label for="searchTerm">Search:</label>
                <input class = "search-bar" type="text" id="searchTerm" name="searchTerm" required>
                <button class = "button-13" type = "submit">Search</button> 
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

            
            
        </div>
    </body>
</html>