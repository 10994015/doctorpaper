<?php

require_once('../conn.php');
session_start();
try{
    $sql_str = "SELECT * FROM users";
    $RS_user = $conn -> query($sql_str);
    $total_RS_user = $RS_user -> rowCount();
    
}catch(PDOException $e){
    die('Error!:'.$e->getMessage());
}
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding: 0;
        }
    .list{
        width:100%;
        padding: 10px 20px;
        border-bottom: 1px #666 solid;
    }
    .list > p{
        margin:5px 0;
    }
    </style>
</head>
<body>
    <div id="app">
    <?php foreach($RS_user as $item){ ?>
        <div class="list">
            <p><b>姓名:</b><?php echo $item['student'];?></p>
            <p><b>移動座標:</b><?php echo $item['coor'];?></p>
            <p><b>開始作答時間:</b><?php echo $item['timeStart'];?></p>
            <p><b>結束作答時間:</b><?php echo $item['timeEnd'];?></p>
            <p><b>是否答對:</b><?php echo $item['bingo'];?></p>
        </div>
    <?php }?>
    </div>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>