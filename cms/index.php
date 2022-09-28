<?php
session_start();

if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>後臺中心</title>
    <style>
    #app > a{
        display: block;
        width:120px;
        height: 35px;
        background-color: #212121;
        color:#fff;
        text-align: center;
        line-height: 35px;
        flex-wrap: 600;
        text-decoration: none;
        margin:5px 0;
    }
    #app > a:hover{
        background-color: #000;
        transition: .5s;
    }
    
    </style>
</head>
<body>
    <div id="app">
        <h1>後臺管理中心</h1>
        <a href="./setTopic.php">設定題數</a>
        <a href="./uploadTopic.php">新增題目</a>
        <a href="./seeTopic.php">查看題目</a>
        <a href="./userData.php">實驗資料</a>
        <a href="./logout.php">登出</a>
    </div>
</body>
</html>

<?php }else{ ?>
    <style>
    *{
        margin:0;
        padding: 0;
    }
    .error{
        width:100%;
        height: 100vh;
        background-color: #212121;
        display: flex;
        justify-content: center;
        align-items: center;
        color:#fff;
        flex-direction: column;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.6;
    }
    .error a{
        color:#f00;
        text-decoration: none;
    }
    </style>
    <div class="error">
        <h2>你無權限訪問此網站，請先登入！</h2>
        <p>You do not have permission to enter this website!</p>
        <a href="./login.php">點擊登入</a>
    </div>

<?php } ?>