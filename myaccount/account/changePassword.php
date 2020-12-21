<?php
    session_start();
    if(!isset($_POST["password"])) {
        header("Location: myaccount.php");
    }

    $userid = $_SESSION['userid'];
    $password = $_POST["npassword"];

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
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "UPDATE users SET PASSWORD = '$password' WHERE ID = ".$userid.";";
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
    localStorage["modifiedPass"] = "true";
</script>
</html>