<?php
require_once('./conn.php');

ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');
$let = $_GET['let'];
$timeStart = date("Y-m-d H:i:s");
// $topicNum = $_SERVER['REQUEST_URI'];
$topicNum = explode('=',explode('&',explode('?', $_SERVER['REQUEST_URI'])[1])[0])[1];
$pre = $_SERVER['QUERY_STRING'];
$qs = explode("=",explode("&",$pre)[0])[0];
$prechk = $qs == "q1";
// echo $prechk;
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
        
    </style>
</head>
<body>
  

    <div id="app">
        <form action="./send.php" method="get">
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
                <label class="topicBox" for="q1"><input type="radio" class="topicRadio" id="q1" name="op" value="1">A</label>
                <label class="topicBox" for="q2"><input type="radio" class="topicRadio" id="q2" name="op" value="2">B</label>
                <label class="topicBox" for="q3"><input type="radio" class="topicRadio" id="q3" name="op" value="3">C</label>
                <label class="topicBox" for="q4"><input type="radio" class="topicRadio" id="q4" name="op" value="4">D</label>
            <?php
            }
           }
           
           ?>
            <input type="hidden" name="name" value="<?php echo $_GET['name'];?>">
            <input type="hidden" name="coor" id="coorText" value="" />
            <input type="hidden" name="timeStart" value="<?php echo $timeStart; ?>" />
            <input type="hidden" name="let" value="<?php echo $let; ?>">
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
    window.location.replace('https://google.com');
    const topicRadio = document.getElementsByClassName('topicRadio');
    for(let i=0;i<topicRadio.length;i++){
        topicRadio[i].addEventListener('change',disabledFn);
    }
    function disabledFn(){
        btn.disabled = false;
    }

    </script>
</body>
</html>

<?php }else{
    echo "錯誤!";
} ?>