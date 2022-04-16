<?php
require_once('../conn.php');
if(isset($_POST['topic']) && $_POST['topic'] !=""){
    try{
        $sql_str = "UPDATE topicnum SET num = :topic WHERE id  = 1";
        //執行$conn物件中的prepare()預處理器
        $stmt = $conn->prepare($sql_str);
     
        //接收表單輸入的資料
        $topic    = $_POST['topic'];
     
        //設定準備好的$stmt物件中對應的參數值
        $stmt->bindParam(':topic' ,$topic);
     
        //執行準備好的$stmt物件工作
        $stmt->execute();
        // $_SESSION['money'] = $money;

       ?>
        <script>
        alert('設定成功!');
        window.location.href = "./setTopic.php";
        </script>
       <?php
        // header('Location:./setTopic.php');
    }catch(PDOException $e){
        die('Error!:'.$e->getMessage());
    }
}