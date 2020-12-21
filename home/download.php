<?php
    session_start();
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="videodatabase";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    $dlink = "";
    $sql = "select * from video where id = ".$videoid;
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dlink=$row["downloadlink"];
        }
    }
    $videoid = number_format(substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'?')+1));
    $sql = "UPDATE video set downloads = downloads + 1 where id = ".$videoid;
    $result = $conn->query($sql);
    $sql = "UPDATE video set views = views - 1 where id = ".$videoid;
    $result = $conn->query($sql);
    $conn->close();

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
        $sql = "insert into ".$userid."dh(videoid, ts) values ('$videoid', '$timestamp')";
        $result = $conn->query($sql);
        $conn->close();
    }
    $p = "Location: http://localhost/Meta-Stream/home/videoplayback.php?".$videoid;
    header($p);
?>