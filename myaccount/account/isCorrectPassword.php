<?php
    session_start();
    if(!isset($_POST["data"])) {
        header("Location: myaccount.php");
    }
    else if(!isset($_SESSION["email"])) {
        header("Location: myaccount.php");
    }

    $password = $_POST["data"][0];
    $email = $_SESSION["email"];

    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "failed to connect to db";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        // header("Location: myaccount.php");
    }
    
    $query="SELECT * FROM users WHERE EMAIL='$email'";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row["PASSWORD"])) {
            echo "true";
        }
        else {
            echo "false";
        }
    }
    else {
        echo "false";
    }
?>