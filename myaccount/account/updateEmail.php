<?php
    session_start();
    $email=$_SESSION['changeEmail'];
    $userid = $_SESSION['userid'];

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
        $sql = "UPDATE users SET EMAIL= '$email' WHERE ID = ".$userid.";";
        $result = $conn->query($sql);
        if($result) {
            $_SESSION["email"] = $email;
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