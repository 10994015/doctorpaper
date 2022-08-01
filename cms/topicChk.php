<?php
require_once('../conn.php');
if(isset($_POST['topic']) && $_POST['topic'] !=""){
    try{
        $topic    = $_POST['topic'];
        $maxnum    = $_POST['max'];
        if($topic > $maxnum){
        ?>
            <script>
            alert('警告!題目目前最多只能設定<?php echo $maxnum;?>題!');
            window.location.href = "./setTopic.php";
            </script>
        <?php
        }else{
            $sql_str = "UPDATE topicnum SET num = :topic WHERE id  = 1";
            $stmt = $conn->prepare($sql_str);
            $stmt->bindParam(':topic' ,$topic);
            $stmt->execute();
            ?>
            <script>
                alert('設定成功!');
                window.location.href = "./setTopic.php";
                </script>
            <?php
        }

       

       
        // header('Location:./setTopic.php');
    }catch(PDOException $e){
        die('Error!:'.$e->getMessage());
    }
}