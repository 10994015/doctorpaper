<?php 
require_once('conn.php');
ini_set ( 'date.timezone' , 'Asia/Taipei' );  
date_default_timezone_set('Asia/Taipei');

$timeEnd = date("Y-m-d H:i:s");
if(isset($_POST['coor'])){
    try{
        $sql_str = "INSERT INTO users (student,coor,timeStart,timeEnd)
        VALUES (:name,:coor,:timeStart,:timeEnd)";

        $stmt = $conn -> prepare($sql_str);

        $coor = $_POST['coor'];
        $name = $_POST['name'];
        $timeStart = $_POST['timeStart'];

        $stmt -> bindParam(':coor' ,$coor);
        $stmt -> bindParam(':name' ,$name);
        $stmt -> bindParam(':timeStart' ,$timeStart);
        $stmt -> bindParam(':timeEnd' ,$timeEnd);

        $stmt ->execute();

        echo "座標:".$coor."<br />";
        echo "姓名:".$name."<br />";
        echo "開始時間:".$timeStart."<br />";
        echo "結束時間:".$timeEnd;

        header('Location:./start.php');
    }catch(PDOException $e){
        die("Error!:註冊失敗.....".$e->getMessage());
    }
    
}else{
    echo "錯誤";
}