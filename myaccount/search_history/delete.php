<?php
    session_start();
    if(!isset($_POST["data"])) {
        header("Location: searchhistory.php");
    }
    if(!isset($_SESSION["email"])) {
        header("Location: ../../home/index.php");
    }

    $data = json_decode($_POST['data']);
    $user_id = $_SESSION["userid"];

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'user_database');

    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    for($i=0;$i<sizeof($data);$i++) {
        $query = "DELETE FROM ".$user_id."sh WHERE id=".$data[$i];
        $sql=mysqli_query($conn,$query);
    }
?>