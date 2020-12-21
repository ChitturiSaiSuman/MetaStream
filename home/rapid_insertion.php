<?php
    $userid = "1";
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
        for($i=1;$i<=120;$i++) {
            $entry = "ab".$i;
            $timestamp = date("Y-m-d H:i:s");
            $endTime = strtotime("+270 minutes", strtotime($timestamp));
            $timestamp = date('Y-m-d H:i:s', $endTime);
            $sql = "insert into ".$userid."sh(searchquery, ts) values ('$entry', '$timestamp')";
            $result = $conn->query($sql);
            echo "inserted $entry\n";
        }
        $conn->close();
    }
?>