<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

    require_once "dbConnection.php";
    $sql = "Call deleteFrom('".$_POST["id"]."')";

    var_dump($sql);
    
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: home.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        echo "True";
    }
     
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else{
    if(empty(trim($_POST["id"]))){
        header("location: home.php");
        exit();
    } else {
        echo "Not existent";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Delete Record</title>
</head>
<body>
    <h2 >Delete Record</h2>
    <form action="#" method="post">
        <div>
            <input type="hidden" name="id" value="<?php echo trim($_POST["id"]); ?>"/>
            <p>Are you sure you want to delete this employee record?</p>
            <p>
                <input type="submit" value="Yes">
                <a href="home.php">No</a>
            </p>
        </div>
    </form>
</body>
</html>