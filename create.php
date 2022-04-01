<?php

require_once "dbConnection.php";

$username = $password = "";
$username_err = $password_err = "";
 

if(isset($_POST["newUser"])){

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty($username_err) && empty($password_err)){
            $sql = "Call insertInto('".$_POST["username"]." ', '".$_POST["password"]."')";
             
            if(mysqli_query($conn, $sql)){
                echo "Probando";
            } else {
                echo "Failed";
            }
        }
        
        mysqli_close($conn);
    }
}
?>

 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>New User</title>
</head>
<body>
    <div>
        <h2>Create a new User</h2>
        <form action="#" method="post">
            <input type="hidden" name="newUser" value="newUser">
            <div>
                <label>username</label>
                <input type="text" name="username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
            <div>
                <label>Password</label>
                <input type="password" name="password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            </div>
            <input type="submit" value="Submit">
            <a href="create.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>         
</body>
</html>