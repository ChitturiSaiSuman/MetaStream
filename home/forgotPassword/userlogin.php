<?php
    session_start();
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";

    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query="SELECT * FROM users WHERE EMAIL='$email'";

    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row["PASSWORD"])) {
            $_SESSION['userid']=$row["ID"];
            $_SESSION['username']=$row["FULLNAME"];
            $_SESSION['email'] = $row["EMAIL"];
            $_SESSION["invalidLogin"] = "false";
        }
        else {
            $_SESSION["invalidLogin"] = "true";
        }
    }

    else {
        $_SESSION["invalidLogin"] = "true";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserLogin</title>
</head>
<body>
    <script>
        localStorage["invalidLogin"] = "<?php echo $_SESSION["invalidLogin"]?>"
        window.location.href='http://localhost/Meta-Stream/home/index.php';
    </script>
</body>
</html>