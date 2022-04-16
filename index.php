<?php
require_once('./conn.php');
$sql_str = "SELECT * FROM topicNum WHERE id = 1";
$stmt = $conn->prepare($sql_str);
$stmt->execute();
$row_topic = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM topic";
$RS_topic = $conn -> query($sql);
$total_RS_topic = $RS_topic -> rowCount();
$max = intval($total_RS_topic);
$randArr = [];
$let = intval($row_topic['num']);
while(true){
    $randNum = rand(1,$max);
    if(in_array($randNum, $randArr)){
        continue;
    }
    array_push($randArr, $randNum);
    if(count($randArr)==$let){
        break;
    }
}
$qnum = 1;
// echo $url;
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
            <?php foreach($randArr as $item){?>
                <input type="hidden" name="<?php echo "q".$qnum; ?>" value="<?php echo $item; ?>" />
            <?php $qnum++; } ?>
                請輸入姓名:<br>
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