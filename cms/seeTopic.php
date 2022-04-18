<?php
require_once('../conn.php');
session_start();
try{
    $sql_str = "SELECT * FROM topic";
    $RS_topic = $conn -> query($sql_str);
    $total_RS_topic = $RS_topic -> rowCount();
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
    <title>查看題目</title>
    <style>
        *{
            margin:0.;
            padding:0;
        }
    .list{
        width:100%;
        border-bottom:1px #666 solid;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .list img{
        width:150px;
        height: 150px;
        object-fit: cover;
        padding: 10px 0;
    }
    .list > .btn{
        display: flex;
        flex-direction: column;
        margin-left: 30px;
    }
    .list > .ans{
        margin-left: 10px;
    }
    .list > .btn > a{
        margin:10px 0;
    }
    </style>
</head>
<body>
    <div id="app">
        <a href="./">回前頁</a>
        <?php foreach($RS_topic as $item){ ?>
            <div class="list">
                <img src="../images/img_upload2/<?php echo $item['topic']; ?>" alt="">
                <div class="ans">答案: <?php if($item['ans'] ==1){echo "A";}elseif($item['ans'] ==2){echo "B";}elseif($item['ans'] ==3){echo "C";}else{echo "D";} ?><br>題號:<?php echo $item['qnumber']; ?></div>
                <div class="btn">
                    <a href="./updataTopic.php?id=<?php echo $item['id']; ?>">編輯題目</a>
                    <a href="javascript:;"" onclick="deleteTopicFn(<?php echo $item['id']; ?>)">刪除題目</a>
                </div>
            </div>
         <?php } ?>
    </div>

    <script>
    const deleteLink = document.getElementById('deleteLink');
    deleteLink.addEventListener('click',()=>{
        
    })
    function deleteTopicFn(id){
        let chk = confirm('確定要刪除嗎?');
        if(chk){
            window.location.href = `./deleteTopic.php?id=${id}`;
            return;
        }
    }
    </script>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>