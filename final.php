<?php
require_once('./conn.php');

ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');
// try{
//     if(isset($_GET['name']) && $_GET['name'] !== ""){
//         $name = $_GET['name'];
//         $sql_str = "SELECT * FROM users WHERE student = :name";
//         $stmt = $conn->prepare($sql_str);
//         $stmt->bindParam(':name',$name);
//         $stmt->execute();
//         $row_RS_mb = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         $y = 0;
//         $n = 0;
//         foreach($row_RS_mb as $item){
//             if( $item['bingo'] == 1){
//                 $y +=1;
//             }elseif( $item['bingo'] == -1){
//                 $n +=1;
//             }
//         } 
//     }
    
// }catch ( PDOException $e ){
//     die("ERROR!!!: ". $e->getMessage());
//   }
try{
    $sql_str = "SELECT * FROM topicnum WHERE id = :id";
    $id = 1;
    $stmt = $conn->prepare($sql_str);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $row_RS_topic = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo $row_RS_topic['num'];
    $let = $row_RS_topic['num'];

    $name = $_GET['name'];
    $rand = $_GET['rand'];
    
}catch(PDOException $e){
    die('Error!:'.$e->getMessage());
}
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
    #final{
        width:100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #d1d1d1;
        flex-direction: column;
    }
    #finish{
            position: absolute;
            top: 100px;
            right:200px;
            width:80px;
            height: 30px;
            display:block;
            background-color: #EFEFEF;
            text-decoration: none;
            text-align: center;
            line-height: 30px;
            color:#000;
            border:1px #000 solid;
        }
        #sendBtn{
            position: absolute;
            top: 100px;
            right:100px;
            width:80px;
            height: 30px;
            border:1px #000 solid;
            background-color: #efefef;
            text-decoration: none;
            display: block;
            color:#000;
            line-height: 30px;
            text-align: center;
        }
        .finishInput{
            position: absolute;
            top: -99999999999999px;
            right:-99999999999999px;
            z-index: -99999999999999;
            width:0px;
            height: 0px;
            overflow: hidden;
            display:block;
        }
    </style>
</head>
<body>

    <div id="final">
        <h1>還需要檢查嗎?完成的話請交卷!</h1>
        <form action="./send.php" method="get">
            <input type="hidden" name="let" value="<?php echo $let; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="rand" value="<?php echo $rand; ?>">
            <input type="hidden" name="finish" value="0" id="finish">
            <input type="submit" value="上一題" name="btn" id="pre">
            <input type="submit" value="交卷" name="btn" class="finishInput" id="btn4">
            <a href="javascript:;" id="sendBtn" onclick="finishFn()">交卷</a>
        </form>
    </div>

    <script>
    const finish = document.getElementById('finish');
    const pre  = document.getElementById('pre')
    function finishFn(){
        let chk = confirm('確定要交卷嗎?');
        if(chk){
            document.getElementById('btn4').click();
            return;
        }
    }
    pre.addEventListener('click',()=>{
        finish.value = 1;
    });
    </script>
</body>
</html>