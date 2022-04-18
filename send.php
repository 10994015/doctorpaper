<?php 
require_once('conn.php');
ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');

$timeEnd = date("Y-m-d H:i:s");
if(isset($_GET['coor'])){
    try{
        $sql_str = "INSERT INTO users (student,coor,timeStart,timeEnd,bingo)
        VALUES (:name,:coor,:timeStart,:timeEnd,:bingo)";
        $btn = $_GET['btn'];
        $stmt = $conn -> prepare($sql_str);
        $n = 0;
        $let = $_GET['let'];
        $coor = $_GET['coor'];
        $name = $_GET['name'];
        $pre = $_GET['pre'];

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
        if(!isset($_GET['final'])){
            while(true){
                if(isset($_GET["q$n"])){
                    for($i=$n;$i<$let+1;$i++){
                        $url .= "q".$i."=".$_GET["q$i"]."&";
                    }
                    $url .= "let=".$let."&name=".$name;
                    break;
                }
                $n++;
            }
        }

        if(isset($_GET['final'])){
            $url = './final.php';
        }


        

       

        $stmt -> bindParam(':coor' ,$coor);
        $stmt -> bindParam(':name' ,$name);
        $stmt -> bindParam(':timeStart' ,$timeStart);
        $stmt -> bindParam(':timeEnd' ,$timeEnd);
        $stmt -> bindParam(':bingo' ,$bingo);

        

        $stmt ->execute();

        echo "座標:".$coor."<br />";
        echo "姓名:".$name."<br />";
        echo "開始時間:".$timeStart."<br />";
        echo "結束時間:".$timeEnd;
        if($btn=="送出" || $btn=="下一題"){
            header('Location:'.$url);
        }else{
            header('Location:./start.php?'.$pre);
        }
    }catch(PDOException $e){
        die("Error!:註冊失敗.....".$e->getMessage());
    }
    
}else{
    echo "錯誤";
}