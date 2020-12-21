<?php
    session_start();
    if(!isset($_POST["yesOrNo"])) {
        header("Location: myaccount.php");
    }
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $index = 0;
    $dbname="user_database";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $userid = $_SESSION["userid"];
        $sql = "DELETE FROM `USERS` WHERE ID = $userid";
        $result = $conn->query($sql);
        $sql = "DROP TABLE ".$userid."sh";
        $result = $conn->query($sql);
        $sql = "DROP TABLE ".$userid."wh";
        $result = $conn->query($sql);
        $sql = "DROP TABLE ".$userid."dh";
        $result = $conn->query($sql);
        $sql = "DROP TABLE ".$userid."lh";
        $result = $conn->query($sql);
        $conn->close();
        session_unset();
        session_destroy();
        // header("Location: http://localhost/Meta-Stream/home/index.php");
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
    localStorage.clear();
    window.location.href='http://localhost/Meta-Stream/home/index.php';
</script>
</html>