<?php
    session_start();
    $fname=$_SESSION['signup_fname'];
    $email=$_SESSION['signup_email'];
    $password=$_SESSION['signup_password'];
    unset($_SESSION["signup_fname"]);
    unset($_SESSION["invalidOTP"]);

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
        $sql = "select * from users where email = ".$email;
        $result = $conn->query($sql);
        if ($result) {
            echo "User already Exists";
        }
        else {
            $sql="INSERT INTO users(FULLNAME,EMAIL,PASSWORD) VALUES('$fname','$email','$password')";
            if(mysqli_query($conn,$sql)) {
                $sql = "SELECT * from users where id = (select max(id) from users)";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                $id = $row["ID"];
                $sql = "CREATE TABLE ".$id."sh ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, searchquery varchar(200), ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
                $result = $conn->query($sql);
                $sql = "CREATE TABLE ".$id."wh ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, videoid int(6), ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
                $result = $conn->query($sql);
                $sql = "CREATE TABLE ".$id."lh ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, videoid int(6), status varchar(20))";
                $result = $conn->query($sql);
                $sql = "CREATE TABLE ".$id."dh ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, videoid int(6), ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
                $result = $conn->query($sql);
            }
        }
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