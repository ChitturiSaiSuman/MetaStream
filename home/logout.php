<?php
session_start();
session_unset();
session_destroy();
// header("Location: http://localhost/Meta-Stream/home/index.php");
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