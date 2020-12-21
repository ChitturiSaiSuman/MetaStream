<?php
    session_start();
    $query = substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'=')+1);
    $entry = str_replace("+"," ",$query);
    $userid = $_SESSION["userid"];
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
        $timestamp = date("Y-m-d H:i:s");
        $endTime = strtotime("+270 minutes", strtotime($timestamp));
        $timestamp = date('Y-m-d H:i:s', $endTime);
        $sql = "insert into ".$userid."sh(searchquery, ts) values ('$entry', '$timestamp')";
        $result = $conn->query($sql);
        if ($result) {
            $p = "Location: http://localhost/Meta-Stream/home/search.php?query=".$query;
            header($p);
        }
        $conn->close();
    }
?>