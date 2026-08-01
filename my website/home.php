    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <link rel="stylesheet" href="home.css">
        <form action="" method="post">
            <input type="text" name="username" id="user" required>  
            <br><br>  
            <input type="password" name="password" id="pss" required>  
            <br>  <br>  
            <input type="submit" name="submit" id="sub">  
        </form>
    </body>
    </html>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    }elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
    $ip = '';
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if (!empty($_SERVER['REMOTE_ADDR'])){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $usr = $_SERVER['HTTP_USER_AGENT'];
    $text = "$ip : $usr - " . date('Y-m-d H:i:s') . " - $username : $hash\n";
    $filename = "logs.log";
    file_put_contents($filename, $text , FILE_APPEND);
    
    
    $_SESSION["username"] = $_POST["username"];

    }
    if (!empty($_SESSION["username"])) {
        header("Location: dash.php");
        exit();
    }else {
        echo "please enter your username and password";
    }

    ?>

<?php
$ip = '';
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if (!empty($_SERVER['REMOTE_ADDR'])){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
$filename = "req.log";
$usr = $_SERVER['HTTP_USER_AGENT'];
$data = "$ip : $usr - " . date('Y-m-d H:i:s') . "\n";
file_put_contents($filename, $data , FILE_APPEND);
?>