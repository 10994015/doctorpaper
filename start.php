<?php

require_once('./conn.php');

ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');
$let = $_GET['let'];
$userRand = $_GET['rand'];

$timeStart = date("Y-m-d H:i:s");
// $topicNum = $_SERVER['REQUEST_URI'];
$topicNum = explode('=',explode('&',explode('?', $_SERVER['REQUEST_URI'])[1])[0])[1];
$pre = $_SERVER['QUERY_STRING'];
$qs = explode("=",explode("&",$pre)[0])[0];
$prechk = $qs == "q1";
// echo $prechk;
$recordArr = [];
for($n=0;$n<intval($let);$n++){
    array_push($recordArr, 0);
}
// print_r($recordArr);
$record = implode('',$recordArr);
$sql_str = "SELECT * FROM record WHERE user = :userRand";
$stmt = $conn->prepare($sql_str);
$stmt->bindParam(':userRand',$userRand);
$stmt->execute();
$row_RS_record = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo count($row_RS_record);
$row_RS_record_num = count($row_RS_record);
if($row_RS_record_num < 1){
    $sql_str = "INSERT INTO record (user, record ) VALUES (:user, :record)";
    $stmt = $conn -> prepare($sql_str);
    $stmt -> bindParam(':user' ,$userRand);
    $stmt -> bindParam(':record' ,$record);
    $stmt ->execute();
}else{
    $sql_str = "SELECT * FROM record WHERE user = :userRand";
    $stmt = $conn->prepare($sql_str);
    $stmt->bindParam(':userRand',$userRand);
    $stmt->execute();
    $row_RS_record = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "------->".$row_RS_record['record'];
    $recordArr = str_split( $row_RS_record['record'],1);
    // print_r($recordArr);
}
$p = 1;
while(true){
    if(isset($_GET["q$p"])){
        break;
    }
    $p++;
}
$user_ans = $recordArr[$p-1];
// echo "目前是第".$p."題";
// echo "你之前寫".$user_ans;
try{
    $sql_str = "SELECT * FROM topic ORDER BY qnumber ASC";
    $RS_topic = $conn -> query($sql_str);
    $total_RS_topic = $RS_topic -> rowCount();
    
}catch(PDOException $e){
    die('Error!:'.$e->getMessage());
}

if(isset($_GET['name']) && $_GET['name'] != ""){
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>論文</title>
    <style>
        *{
            margin:0;
            padding: 0;
        }
        #app{
            width:100%;
            min-height: 100vh;
            height: auto;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            padding:50px 0;
        }
        #app .topicImg{
            width:500px;
            height: auto;
            object-fit: cover;
        }
        form{
            display: flex;
            flex-direction: column;

        }
        .topicBox{
            margin:5px 0;
            font-family: Arial, Helvetica, sans-serif
        }
        .topicBox > input {
            margin-right:3px;
        }
        #btn{
            margin-bottom: 10px;
        }
        .stepBtn{
            display: flex;
            justify-content: space-between;
        }
        .chkfinalLable{
            order:5;
        }
        .finish{
            position: absolute;
            top: -99999999999999px;
            right:-99999999999999px;
            z-index: -99999999999999;
            width:0px;
            height: 0px;
            overflow: hidden;
            display:block;
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
    </style>
</head>
<body>
  

    <div id="app">
        <form action="./send.php" method="get">
            <!-- <a href="javascript:;" id="finish" onclick="finishFn()">交卷</a> -->
           
            <!-- <input type="submit" id="finish" value="交卷"> -->
              <?php
                $n=0;
                $isfinal = false;
                while(true){
                    $n++;
                    if(isset($_GET["q$n"])){
                        $s = 0;
                        for($i=$n+1;$i<=$let;$i++){
                            echo "<input name='q".$i."' value='".$_GET["q$i"]."' type='hidden'>";
                            $s++;
                        }
                        if($s == 0){
                            $isfinal = true;
                        }
                        break;
                    }
                }
                if($isfinal){
                    // echo "<label for='chkfinal' class='chkfinalLable'><input type='checkbox' class='chkfinal' id='chkfinal' />確定檢查完畢</label>";
                    echo "<input name='final' value='final' type='hidden' />";
                }
              ?>
           <?php
           $num = 0;
           foreach($RS_topic as $item){
            $num ++;
            if($num == $topicNum){
            ?>
                <input type="hidden" name="ans" value="<?php echo $item['ans']; ?>">
                <input type="hidden" name="qnumber" value="<?php echo $item['qnumber']; ?>">
                <img src="./images/img_upload2/<?php echo $item['topic']; ?>" class="topicImg">
                <?php $abcde = ['A','B','C','D','E']; ?>
                <?php for($t=1;$t<=5;$t++){ 
                    if($t==$user_ans){
                ?>
                    <label class="topicBox" for="q<?php echo $t; ?>"><input type="radio" class="topicRadio" id="q<?php echo $t; ?>" name="op" value="<?php echo $t; ?>" checked><?php echo $abcde[$t-1]; ?></label>
                <?php 
                    }else{
                ?>
                    
                    <label class="topicBox" for="q<?php echo $t; ?>"><input type="radio" class="topicRadio" id="q<?php echo $t; ?>" name="op" value="<?php echo $t; ?>"><?php echo $abcde[$t-1]; ?></label>
                <?php } } ?>
                <!-- <label class="topicBox" for="q1"><input type="radio" class="topicRadio" id="q1" name="op" value="1">A</label>
                <label class="topicBox" for="q2"><input type="radio" class="topicRadio" id="q2" name="op" value="2">B</label>
                <label class="topicBox" for="q3"><input type="radio" class="topicRadio" id="q3" name="op" value="3">C</label>
                <label class="topicBox" for="q4"><input type="radio" class="topicRadio" id="q4" name="op" value="4">D</label>
                <label class="topicBox" for="q5"><input type="radio" class="topicRadio" id="q5" name="op" value="5">E</label> -->
            <?php
            }
           }
           
           ?>
            <input type="hidden" name="name" value="<?php echo $_GET['name'];?>">
            <input type="hidden" name="coor" id="coorText" value="" />
            <input type="hidden" name="timeStart" value="<?php echo $timeStart; ?>" />
            <input type="hidden" name="let" value="<?php echo $let; ?>">
            <input type="hidden" name="tosend" value="n" id="tosend">
            <input type="hidden" name="rand" value="<?php echo $userRand; ?>">
            <a href=""></a>
            <input type="submit" value="送出" name="btn" id="btn" disabled />
           <div class="stepBtn">
            <?php
                if(!$prechk){
                    echo '<input type="submit" value="上一題" name="btn" id="btn2"  />';
                }else{
                    echo '<input type="submit" value="上一題" name="btn" id="btn2" disabled />';
                }
                ?>
                
                <?php
                if(!$isfinal){
                    echo '<input type="submit" value="下一題" name="btn" id="btn3"  />';
                }else{
                    echo '<input type="submit" value="下一題" name="btn" id="btn3" disabled />';
                }
                ?>
           </div>
           <input type="submit" value="交卷" id="btn4" class="finish" name="btn">
           <a href="javascript:;" id="sendBtn" onclick="finishFn()">交卷</a>
        </form>
        
    </div>
    <!-- <div id="app">
        <form action="./send.php" method="post">
            <input type="hidden" name="coor" id="coorText" value="" />
            <input type="hidden" name="timeStart" value="<?php echo $timeStart; ?>" />
            <input type="submit" value="送出" id="btn" />
        </form>
    </div> -->

    <script src="script.js"></script>
    <script>
    function preventBack(){ window.history.forward();}
    setTimeout("preventBack()",0);
    window.onunload = function(){null;}
    // const chkfinal = document.getElementsByClassName('chkfinal');
    // const btn = document.getElementById('btn');
    const tosend = document.getElementById('tosend');
    const topicRadio = document.getElementsByClassName('topicRadio');
    for(let i=0;i<topicRadio.length;i++){
        topicRadio[i].addEventListener('change',disabledFn);
    }
    for(let i=0;i<5;i++){
        if(topicRadio[i].checked){
            btn.disabled = false;
        }
    }
    // chkfinal[0].addEventListener('change',disabledFn);
    let chkfor = false;

    btn.addEventListener('click',()=>{
        tosend.value = "y";
    })
    function disabledFn(){
        // if(chkfinal.length>=1){
        //     // console.log('哈哈');
        //     for(let i=0;i<topicRadio.length;i++){
        //         if(topicRadio[i].checked){
        //             chkfor = true;
        //         }
        //     }
        //     if(chkfinal[0].checked && chkfor){
        //         btn.disabled = false;
        //     }else{
        //         btn.disabled = true;
        //     }
        //     return;
        // }
        btn.disabled = false;
        
    }
    function finishFn(){
        let chk = confirm('確定要交卷嗎?');
        if(chk){
            document.getElementById('btn4').click();
            return;
        }
    }
  
    </script>
</body>
</html>

<?php }else{
    echo "錯誤!";
} ?>