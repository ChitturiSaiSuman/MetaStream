<?php
    session_start();
    if(!isset($_POST["username"])) {
        header("Location: ../home/index.php");
    }

    $userid = $_SESSION['userid'];
    $username = $_POST['username'];

    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";

    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());

    }
    else {
        $sql = "UPDATE users SET FULLNAME = '$username' WHERE ID = ".$userid.";";
        $result = $conn->query($sql);
        if($result) {
            $_SESSION['username'] = $username;
        }
        else {
            echo "Failed";
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
    window.location.href='http://localhost/Meta-Stream/myaccount/account/myaccount.php';
</script>
</html>
