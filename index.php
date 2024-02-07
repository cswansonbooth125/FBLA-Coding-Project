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

    <!-- Search box. -->
    <form action="search-script.php" method="post">
        <br>
           
        <input class = 'update-input' type="text" id="searchTerm" name="searchTerm" required placeholder="Search"><br>
        <button class = 'button-13' type="submit">Search</button>
    </form>

    <!-- Filters database for manufacturers. -->
    <form action="filter.php" method="post">
        <label for="dropdown">Select an option:</label>
        <select id="dropdown1" name="dropdown1">
            <option value="option1"></option>
            <option value="option2">Manufacturer</option>
            <option value="option3">Option 3</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <!-- Filters database for resources. -->
    <form action="filter.php" method="post">
        <label for="dropdown">Select an option:</label>
        <select id="dropdown2" name="dropdown2">
            <option value="option1"></option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <!-- Displays the unfiltered or filtered table. -->
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