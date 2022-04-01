<?php
require_once "dbConnection.php";
 

$username = $password = "";
$username_err = $password_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    require_once "dbConnection.php";
    
    
    $sql = "Call oneRegister('".$_POST["id"]."')";
    
    
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        

        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $id = $row["id"];
                $username = $row["username"];
                $password = $row["password"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else
            echo "Oops! Something went wrong. Please try again later.";
        }

        $input_username = trim($_POST["username"]);
        if(empty($input_username)){
            $username_err = "Please enter a username.";
        }  else{
            $username = $input_username;
        }
        
        $input_password = trim($_POST["password"]);
        if(empty($input_password)){
            $password_err = "Please enter an password.";     
        } else{
            $password = $input_password;
        }


        if(empty($username_err) && empty($password_err)){

            
            $sql = "Call updateTable('".$_POST["id"]."','".$_POST["username"]."', '".$_POST["password"]."');";
            var_dump($sql); 

            if(isset($conn)){
                echo "conexion";
            }
            if($result = mysqli_query($conn, $sql)){
                header("location: home.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        
        }
    }
    
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit</title>
</head>
<body>
    <h2>Edit</h2>
    <form action="#" method="post">
        <input type="hidden" name="editUser">
        <div>
            <label>username</label>
            <input type="text" name="username" class=" <?php //echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
        </div>
        <div>
            <label>password</label>
            <input type="password" name="password" class=" <?php //echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" value="Submit">
        <a href="home.php">Cancel</a>
    </form>
</body>
</html>