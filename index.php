<?php
$randArr = [];
while(true){
    $randNum = rand(1,20);
    foreach($randArr as $item){
        if($randNum == $item){
            continue;
        }
    }
    array_push($randArr, $randNum);
    if(count($randArr)==10){
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
    <title>Document</title>
</head>
<body>
    <form action="./start.php" method="post">
        <?php foreach($randArr as $item){?>
            <input type="hidden" name="<?php echo "q".$qnum; ?>" value="<?php echo $item; ?>" />
        <?php $qnum++; } ?>
            姓名:<input type="text" name="name" />
            <input type="submit" value="開始作答" />

    </form>
</body>
</html>