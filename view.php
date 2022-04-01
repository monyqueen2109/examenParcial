<?php
 
if(isset($_POST["id"]) && !empty(trim($_POST["id"]))){
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
        
    }
    mysqli_stmt_close($stmt);
    
    mysqli_close($conn);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>View</title>
<body>
    <div>
        <h1>View</h1>
        <div>
            <label>Id</label>
            <b><?php echo $row["id"]; ?></b>
        </div>
        <div>
            <label>Userame</label>
            <b><?php echo $row["username"]; ?></b>
        </div>
        <div>
            <label>Password</label>
            <b><?php echo $row["password"]; ?></b>
        </div>
        <p><a href="home.php">Back</a></p>  
    </div>  
</body>
</html>