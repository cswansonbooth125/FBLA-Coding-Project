<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "admins";

try 
{
    $conn = new mysqli($servername, $username, $password, $dbname);
} 
catch (Exception $e) 
{
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['uname']) && isset($_POST['password'])) 
{
        function validate($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) 
    { 
        header("Location: index.php?error=Username is required");
        exit();
    } 
    else if (empty($pass)) 
    {
        header("Location: index.php?error=Password is required");
        exit();
    } 
    else 
    {
        $sql = "SELECT * FROM admin_accounts WHERE username='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            echo "found";
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: admin-page.php");
        }
        else
        {
            header("Location: index.php?error=Incorrect Username or Password");
            exit();
        }
    }

    
} 
else 
{
    header("Location: index.php");
    exit();
}

?>  