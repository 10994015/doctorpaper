<?php
require_once('./conn.php');
$sql_str = "SELECT * FROM topicnum WHERE id = 1";
$stmt = $conn->prepare($sql_str);
$stmt->execute();
$row_topic = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM topic ORDER BY qnumber ASC";
$RS_topic = $conn -> query($sql);
$total_RS_topic = $RS_topic -> rowCount();

$let = intval($row_topic['num']);

$qnum = 1;
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首頁</title>
    <style>
        *{
            margin:0;
            padding: 0;
        }
        #app{
            width:100%;
            height: 100vh;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            line-height: 2;
        }
        
    </style>
</head>
<body>
   <div id="app">

    <form action="./start.php" method="get">
        <?php foreach($RS_topic as $item){?>
            <input type="hidden" name="<?php echo 'q'.$item['qnumber']; ?>" value="<?php echo $item['qnumber']; ?>" />
        <?php  if($qnum==$let){break;} $qnum++;  } ?>
            請輸入編號:<br>
            <input type="text" name="name" id="name" /><br>
            <input type="hidden" name="let" value="<?php echo $let; ?>">
            <input type="submit" value="開始作答" id="btn" disabled />
        </form>
   </div>

   <script>
    const name = document.getElementById('name');
    const btn = document.getElementById('btn');


    const disabledFn = ()=>{
        if(name.value !=""){
            btn.disabled = false;
        }else{
            btn.disabled = true;
        }
    }
    name.addEventListener('keyup',disabledFn);
   
   </script>
</body>
</html>