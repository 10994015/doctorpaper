<?php
require_once('./conn.php');

ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');
$let = $_GET['let'];
$timeStart = date("Y-m-d H:i:s");
// $topicNum = $_SERVER['REQUEST_URI'];
$topicNum = explode('=',explode('&',explode('?', $_SERVER['REQUEST_URI'])[1])[0])[1];
echo $topicNum;

try{
    $sql_str = "SELECT * FROM topic";
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
            height: 100vh;
            background-color: #ccc;
        }
        #app .topicImg{
            width:300px;
            height: 300px;
            object-fit: cover;
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
                <img src="./images/img_upload2/<?php echo $item['topic']; ?>" class="topicImg">
                <input type="radio" name="op" value="1">A
                <input type="radio" name="op" value="2">B
                <input type="radio" name="op" value="3">C
                <input type="radio" name="op" value="4">D
            <?php
            }
           }
           
           ?>

            <input type="hidden" name="name" value="<?php echo $_GET['name'];?>">
            <input type="hidden" name="coor" id="coorText" value="" />
            <input type="hidden" name="timeStart" value="<?php echo $timeStart; ?>" />
            <input type="hidden" name="let" value="<?php echo $let; ?>">
            <input type="submit" value="送出" id="btn" />
            <!-- <a href="javascript:;" id="btn">送出</a> -->
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
</body>
</html>

<?php }else{
    echo "錯誤!";
} ?>