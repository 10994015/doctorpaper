<?php 
require_once('../conn.php');
session_start();
try{
  

    $sql_str = "SELECT MAX(qnumber) AS qnumber FROM topic";
    $stmt = $conn->prepare($sql_str);
    $stmt->execute();
    $row_RS_mb = $stmt->fetch(PDO::FETCH_ASSOC);
    $max = $row_RS_mb['qnumber']+1;

    
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
    <title>Document</title>
    <style>
    form{
        display: flex;
        flex-direction: column;
        width:300px;
        margin:auto;
    }
    form input[type="submit"]{
        margin-top: 10px;
    }
    </style>
</head>
<body>
    
<a href="./">回前頁</a>
    <form action="./uploadChk.php" enctype="multipart/form-data" method="POST">
        <h2>上傳圖片</h2>
        <input type="file" name="upload_img" id="file" />
        <p>答案:</p>
        <div>
            <label for="a"><input type="radio" name="ans" id="a" value="1" />A</label>
            <label for="b"><input type="radio" name="ans" id="b" value="2" />B</label>
            <label for="c"><input type="radio" name="ans" id="c" value="3" />C</label>
            <label for="d"><input type="radio" name="ans" id="d" value="4" />D</label>
            <label for="e"><input type="radio" name="ans" id="e" value="5" />E</label>
            <label for="null"><input type="radio" name="ans" id="null" value="0" />沒有標準答案</label>
       </div>
        <p>題號:</p>
       
            <input type="number" name="qnumber" value="<?php echo $max; ?>" />
      
        <input type="submit" value="上傳"  id="submit" />
    </form>
</body>
</html>

<?php }else{ ?>
    <h2>請先登入!!!</h2>
    <a href="./login.php">點擊登入</a>

<?php } ?>