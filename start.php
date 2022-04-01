<?php
require_once('./conn.php');

ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');

$timeStart = date("Y-m-d H:i:s");

if(isset($_POST['name']) && $_POST['name'] != ""){
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
    </style>
</head>
<body>


    <div id="app">
        <form action="./send.php" method="post">
            <?php if(isset($_POST['q1'])){
                for($n=2;$n<=10;$n++){
                echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q2'])){
                for($n=3;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q3'])){
                for($n=4;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q4'])){
                for($n=5;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q5'])){
                for($n=6;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q6'])){
                for($n=7;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q7'])){
                for($n=8;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }
            elseif(isset($_POST['q8'])){
                for($n=9;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }elseif(isset($_POST['q9'])){
                for($n=10;$n<=10;$n++){
                    echo "<input type='text' name='q".$n."' value='".$_POST["q$n"]."'>" ;
                }
            }else{
                echo "<input type='hidden' name='finish' value='finish' />";
            }
             ?>
                
              


            <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
            <input type="hidden" name="coor" id="coorText" value="" />
            <input type="hidden" name="timeStart" value="<?php echo $timeStart; ?>" />
            <input type="submit" value="送出" id="btn" />
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