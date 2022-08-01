<?php
require_once('../conn.php');
if(isset($_POST['topic']) && $_POST['topic'] != ""){
    $ansstr = strtoupper($_POST['topic']);
    if( $ansstr=="A" ||  $ansstr=="B" ||  $ansstr=="C" || $ansstr=="D" || $ansstr=="E"){
        if($ansstr=="A"){
            $ans = 1;
        }elseif($ansstr=="B"){
            $ans = 2;
        }elseif($ansstr=="C"){
            $ans = 3;
        }elseif($ansstr=="D"){
            $ans = 4;
        }else{
            $ans = 5;
        }
       
        try{
            $sql_str = "UPDATE topic SET ans = :ans,qnumber=:qnumber WHERE id  = :id";
            //執行$conn物件中的prepare()預處理器
            $stmt = $conn->prepare($sql_str);
         
            //接收表單輸入的資料
            $id = $_POST['id'];
            $qnumber = $_POST['qnumber'];
            //設定準備好的$stmt物件中對應的參數值
            $stmt->bindParam(':id' ,$id);
            $stmt->bindParam(':ans' ,$ans);
            $stmt->bindParam(':qnumber' ,$qnumber);
         
            //執行準備好的$stmt物件工作
            $stmt->execute();
            // $_SESSION['money'] = $money;
            ?>
            <script>
            alert('更新成功!');
            window.location.href = "./seeTopic.php";
            </script>
            <?php
          }
          catch (PDOException $e ){
            die("Error!: ". $e->getMessage());
          }

    }else{
       ?>
        <script>
            alert('輸入錯誤、請輸入A、B、C、D、E!');
            window.history.go(-1);
            </script>
       <?php
    }
}


