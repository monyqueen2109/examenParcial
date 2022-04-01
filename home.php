<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>   
</head>
<body>
    <div>
        <h2 >Users resume</h2>
        <a href="create.php"> Add New User</a>
    </div>
    <?php
    require_once "dbConnection.php";
    

    $sql = "Call showAll()";
    if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
            echo '<table>';
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Username</th>";
                        echo "<th>Password</th>";
                        echo "<th>Options</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        ?>
                        <td>
                            <form action="view.php" method="post">
                                <input type="hidden" name="id" value = <?= $row["id"] ?> >
                                <input type="submit" value = "view">
                            </form>
                        </td>
                        <td>
                            <form action="update.php" method="post">
                                <input type="hidden" name="id" value = <?= $row["id"] ?> >
                                <input type="submit" value = "edit">
                            </form>
                        </td>
                        <td>
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value = <?= $row["id"] ?> >
                                <input type="submit" value = "delete">
                            </form>
                        </td>
                        <?php
                        echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";                            
            echo "</table>";

            mysqli_free_result($result);
        } else{
            echo 'Not found';
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }

    mysqli_close($conn);
    ?>
            
</body>
</html>