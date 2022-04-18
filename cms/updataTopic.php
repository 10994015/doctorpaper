<?php
require_once('../conn.php');
session_start();
try {
    if(isset($_GET['id']) && $_GET['id'] !== ""){
        $id = $_GET['id'];
        $sql_str = "SELECT * FROM topic WHERE id = :id";
        $stmt = $conn->prepare($sql_str);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $row_RS_mb = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row_RS_mb['ans']==1){
            $ans = "A";
        }elseif($row_RS_mb['ans']==2){
            $ans = "B";
        }elseif($row_RS_mb['ans']==3){
            $ans = "C";
        }else{
            $ans = "D";
        }
            
    }

   } 
   catch ( PDOException $e ){
     die("ERROR!!!: ". $e->getMessage());
   }
   if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    form > img{
        width:400px;
        height: auto;
    }
    </style>
</head>
<body>
<a href="./seeTopic.php">回前頁</a>
    <form action="updateTopicChk.php" method="post">
        <img src="../images/img_upload2/<?php echo $row_RS_mb['topic']; ?>" alt=""><br>
        答案(請輸入A、B、C、D):<input type="text" value="<?php echo $ans;?>" name="topic">
        題號:<input type="number" name="qnumber" value="<?php echo $row_RS_mb['qnumber']; ?>">
        <input type="hidden" name="id" value="<?php echo $row_RS_mb['id']; ?>">
        <input type="submit" value="更改">
    </form>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>