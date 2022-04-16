<?php


session_start();

if(!isset($_SESSION['username'])){
    ?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登入</title>
    <style>
    *{
        margin:0;
        padding: 0;
        background-color: #ddd;
    }
    #app{
        width:100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #app > form{
        display: flex;
        flex-direction: column;
        align-items: center;
        width:300px;
    }
    #app > form > input{
        margin:15px 0;
        width:100%;
        height: 30px;
        background-color: #fff;
    }
    #app > form > input[type='submit']{
        background-color: #212121;
        color:#fff;
        font-weight: 600;
        cursor: pointer;
    }
    </style>
</head>
<body>
   <div id="app">
   <form action="memberChk.php" method="post">
        <h2>登入</h2>
        <input type="text" placeholder="帳號" name="username">
        <input type="password" placeholder="密碼" name="password">
        <input type="submit" value="登入">
    </form>
   </div>
</body>
</html>

<?php 
}else{
    header('Location:./');  

}?>