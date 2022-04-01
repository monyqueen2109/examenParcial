<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Login.php");
    exit;
}

require_once "dbConnection.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){

        $sql = "CALL verifyLogin('".$_POST["username"]." ', '".$_POST["password"]."')";
        
        $res = $conn->query($sql);
        
        if ($res-> num_rows > 0){
            $conn->close();
            $_SESSION['username']=$row["username"];
            echo "Successful Login";
            header("Location: home.php");
        } else {
            $conn->close();
            echo "Invalid password or username";
        }
        
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="usr" name="username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"><br>
            <span class="invalid-feedback"><?php echo $username_err; ?></span> <br>
            <label for="password">Password:</label><br>
            <input type="password" id="pwd" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"> <br>
            <span class="invalid-feedback"><?php echo $password_err; ?></span> <br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>