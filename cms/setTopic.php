<?php
require_once('../conn.php');
session_start();
try{
    $sql_str = "SELECT * FROM topicNum WHERE id = 1";
    $stmt = $conn->prepare($sql_str);
    $stmt->execute();
    $row_topic = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM topic";
    $RS_topic = $conn -> query($sql);
    $total_RS_topic = $RS_topic -> rowCount();
}catch(PDOException $e){
    die('Error!:'.$e->getMessage());
}

if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>設定題數</title>
</head>
<body>
<a href="./">回前頁</a>
    <form action="topicChk.php" method="post">
        <h4>最多題數: <?php echo $total_RS_topic; ?></h4>
        <input type="text" name="topic" value="<?php echo $row_topic['num']; ?>">
        <input type="submit" value="設定">
    </form>
</body>
</html>


<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>