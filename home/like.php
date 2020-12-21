<?php
    session_start();
    if(!isset($_SESSION['email'])) {
        header("Location: index.php");
    }

    $userid = $_SESSION["userid"];
    $data = json_decode($_POST['data']);
    $videoid = number_format($data[0]);

    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";

    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    
    $sql = "select * from ".$userid."lh where videoid = $videoid";
    $result = $conn->query($sql);
    $status = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row["status"];
    }
    else {
        $status = "null";
    }
    $conn->close();

    if($status == "null") {
        // Increment likes in video table
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="videodatabase";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE video set likes = likes + 1 where id = ".$videoid;
        $result = $conn->query($sql);

        // Insert into user lh like
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="user_database";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "insert into ".$userid."lh (videoid, status) values($videoid, 'liked')";
        $result = $conn->query($sql);
    }
    else if($status == "none") {
        // Increment likes in video table
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="videodatabase";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE video set likes = likes + 1 where id = ".$videoid;
        $result = $conn->query($sql);

        // Update status to liked in user lh
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="user_database";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE ".$userid."lh set status = 'liked' where videoid = ".$videoid;
        $result = $conn->query($sql);
    }
    else if($status == "liked") {
        // Decrement likes in video table
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="videodatabase";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE video set likes = likes - 1 where id = ".$videoid;
        $result = $conn->query($sql);
        
        // Update status to none
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="user_database";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE ".$userid."lh set status = 'none' where videoid = ".$videoid;
        $result = $conn->query($sql);
    }
    else {
        // Increment likes in video table
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="videodatabase";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE video set likes = likes + 1 where id = ".$videoid;
        $result = $conn->query($sql);

        // Decrement dislikes in video table
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="videodatabase";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE video set dislikes = dislikes - 1 where id = ".$videoid;
        $result = $conn->query($sql);

        // Update status to liked
        $host="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbname="user_database";
        $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
        $sql = "UPDATE ".$userid."lh set status = 'liked' where videoid = ".$videoid;
        $result = $conn->query($sql);
    }
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="videodatabase";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    $sql = "UPDATE video set views = views - 1 where id = ".$videoid;
    $result = $conn->query($sql);
    $conn->close();

?>