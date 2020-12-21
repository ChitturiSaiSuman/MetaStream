<?php
    session_start();
    if(!isset($_POST["data"])) {
        header("Location: myaccount.php");
    }
    $email = $_POST["data"][0];
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        header("Location: myaccount.php");
    }
    $sql = "select * from users";
    $emails = array();
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($emails,$row["EMAIL"]);
        }
    }
    $flag = 1;
    for($i=0;$i<sizeof($emails);$i++) {
        if($emails[$i]==$email) {
            echo "true";
            $flag = 0;
            break;
        }
    }
    if($flag == 1) {
        echo "false";
    }
?>