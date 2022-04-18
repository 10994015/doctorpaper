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
        body{
            padding: 20px;
        }
        .list{
            width:100%;
            padding: 10px 20px;
            border-bottom: 1px #666 solid;
        }
        .list > p{
            margin:5px 0;
        }
        
        table, th , td{
            border:1px #000 solid;
            border-collapse: collapse;
            padding: 10px;
        }
        table th{
            background-color: #aaa;
        }
        table th:nth-child(1){
            width:50px;
        }
        table th:nth-child(2){
            width:250px;
        }
        table th:nth-child(1){
            width:100px;
        }
        table th:nth-child(1){
            width:100px;
        }
        table th:nth-child(1){
            width:50px;
        }
        table td{
            padding: 10px;
        }
        #btn{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <button id="btn">匯出Excel</button>
    <table id="table">
        <thead>
            <tr>
                <th>姓名</th>
                <th>移動座標</th>
                <th>開始時間</th>
                <th>結束時間</th>
                <th>是否答對</th>
                <th>題號</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($RS_user as $item){ ?>
            <tr>
                <td><?php echo $item['student']; ?></td>
                <td><?php echo $item['coor']; ?></td>
                <td><?php echo $item['timeStart']; ?></td>
                <td><?php echo $item['timeEnd']; ?></td>
                <td><?php echo $item['bingo']; ?></td>
                <td><?php echo $item['qnum']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="../js/table2excel.js"></script>
    <script>
    const btn = document.getElementById('btn');
   
    btn.addEventListener('click',()=>{
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("table"));
    })
    
    </script>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>