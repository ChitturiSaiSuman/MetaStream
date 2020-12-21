<?php
    session_start();
    $email=$_SESSION['signup_email'];
    $password=$_SESSION['signup_password'];
    
    unset($_SESSION["signup_email"]);
    unset($_SESSION["signup_password"]);

    if(isset($_SESSION["invalidOTP"])) {
        unset($_SESSION["invalidOTP"]);
    }

    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";

    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysqli_connect_error()){
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());

    }
    else{
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "UPDATE users SET `PASSWORD` = '$password' WHERE EMAIL = '$email';";
        $result = $conn->query($sql);
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
<script>
    localStorage["previewLogin"]="true";
    localStorage["signUpSuccessful"] = "true";
    window.location.href='http://localhost/Meta-Stream/home/index.php';
</script>
</html>