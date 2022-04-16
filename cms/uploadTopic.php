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
    <title>Document</title>
</head>
<body>
    
<a href="./">回前頁</a>
    <form action="./uploadChk.php" enctype="multipart/form-data" method="POST">
        <h2>上傳圖片</h2>
        <input type="file" name="upload_img" id="file" />
        <input type="radio" name="ans" value="1" />A
        <input type="radio" name="ans" value="2" />B
        <input type="radio" name="ans" value="3" />C
        <input type="radio" name="ans" value="4" />D
        <input type="submit" value="上傳"  id="submit" />
    </form>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>