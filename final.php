<?php
require_once('./conn.php');
try{
    if(isset($_GET['name']) && $_GET['name'] !== ""){
        $name = $_GET['name'];
        $sql_str = "SELECT * FROM users WHERE student = :name";
        $stmt = $conn->prepare($sql_str);
        $stmt->bindParam(':name',$name);
        $stmt->execute();
        $row_RS_mb = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $y = 0;
        $n = 0;
        foreach($row_RS_mb as $item){
            if( $item['bingo'] == 1){
                $y +=1;
            }elseif( $item['bingo'] == -1){
                $n +=1;
            }
        } 
    }
}catch ( PDOException $e ){
    die("ERROR!!!: ". $e->getMessage());
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
    </style>
</head>
<body>

    <div id="final">
        <h1>答題完成!</h1>
    </div>
</body>
</html>