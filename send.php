<?php 
require_once('conn.php');
ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');

$timeEnd = date("Y-m-d H:i:s");
$pre = intval(explode("=",explode("&",explode("?",$_SERVER["HTTP_REFERER"])[1])[0])[1]);
$ppre = $pre-1;
if(isset($_GET['coor'])){
    try{
        $sql_str = "INSERT INTO users (student,coor,timeStart,timeEnd,bingo,qnum)
        VALUES (:name,:coor,:timeStart,:timeEnd,:bingo,:qnumber)";
        $btn = $_GET['btn'];
        $stmt = $conn -> prepare($sql_str);
        $n = 0;
        $let = $_GET['let'];
        $coor = $_GET['coor'];
        $name = $_GET['name'];
        $qnumber = $_GET['qnumber'];
        $tosend = $_GET['tosend'];
        $rand = $_GET['rand'];
        // $pre = $_GET['pre'];

        if($btn == "送出"){
            $userrand = $_GET['rand'];
            $userrand2 =  $_GET['rand'];
            $sql = "SELECT * FROM record WHERE user = :userrand";
            $stmt1 = $conn->prepare($sql);
            $stmt1->bindParam(':userrand',$userrand);
            $stmt1->execute();
            $row_RS_record = $stmt1->fetch(PDO::FETCH_ASSOC);
            $recordArr = str_split( $row_RS_record['record'],1);
            $r = 1;
            while(true){
                if(isset($_GET["q$r"])){
                    $recordArr[$r-2] = $_GET['op'];
                    
                    break;
                }
                if(isset($_GET['final'])){
                    break;
                }
                $r++;
            }
            $recordStr = implode("",$recordArr);
            echo $recordStr;
            $sql_str = "UPDATE record SET record = :recordStr WHERE user  = :newuserrand";
            //執行$conn物件中的prepare()預處理器
            $stmt2 = $conn->prepare($sql_str);
            $stmt2->bindParam(':newuserrand',$userrand2);
            $stmt2->bindParam(':recordStr' ,$recordStr);
         
            $stmt2->execute();
        }

        if($btn =="送出"){
            $op = $_GET['op'];
            $ans = $_GET['ans'];
            if($op == $ans){
                $bingo = 1;
            }else{
                $bingo = -1;
            }
        }else{
            $bingo = 0;
        }
       
        $timeStart = $_GET['timeStart'];

        $url = "./start.php?";
        if($btn=="送出" || $btn=="下一題"){
            if(!isset($_GET['final'])){
                while(true){
                    if(isset($_GET["q$n"])){
                        for($i=$n;$i<$let+1;$i++){
                            $url .= "q".$i."=".$_GET["q$i"]."&";
                        }
                        $url .= "let=".$let."&name=".$name."&tosend=".$tosend."&rand=".$rand;
                        break;
                    }
                    $n++;
                }
            }
        }else{
            if(!isset($_GET['final'])){
                while(true){
                    if(isset($_GET["q$n"])){
                        for($i=$n-2;$i<$let+1;$i++){
                            $url .= "q".$i."=".$i."&";
                        }
                        $url .= "let=".$let."&name=".$name."&rand=".$rand;
                        break;
                    }
                    $n++;
                }
            }
        }

        if(isset($_GET['final']) && $btn=="送出"){
            $url = './final.php?name='.$_GET['name'];
        }

        if(isset($_GET['final']) && $btn =="上一題"){
            $url = "./start.php?q$ppre=$ppre&q$pre=$pre&let=$let&name=$name&rand=$rand";
        }
        //&tosend=$tosend&rand=$rand
        

       

        $stmt -> bindParam(':coor' ,$coor);
        $stmt -> bindParam(':name' ,$name);
        $stmt -> bindParam(':timeStart' ,$timeStart);
        $stmt -> bindParam(':timeEnd' ,$timeEnd);
        $stmt -> bindParam(':bingo' ,$bingo);
        $stmt -> bindParam(':qnumber' ,$qnumber);

        

        $stmt ->execute();

        // echo "座標:".$coor."<br />";
        // echo "姓名:".$name."<br />";
        // echo "開始時間:".$timeStart."<br />";
        // echo "結束時間:".$timeEnd;
       
        header('Location:'.$url);
       
    }catch(PDOException $e){
        die("Error!:註冊失敗.....".$e->getMessage());
    }
    
}else{
    echo "錯誤";
}