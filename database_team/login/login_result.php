

<?php
 session_start();

 $id = $_REQUEST["id"];
 $pw = $_REQUEST["pass"];

 require_once("../lib/MYDB.php");
 $pdo = db_connect();

 try {
     $sql = "select * from member.member where id = ? ";
     $stmh = $pdo->prepare($sql);
     $stmh->bindValue(1,$id,PDO::PARAM_STR);
     $stmh->execute();

     $count = $stmh->rowCount();
 } catch (PDOException $Exception) {
    print"오류:".$Exception->getMessage();
    }
 $row=$stmh->fetch(PDO::FETCH_ASSOC);

 if($count<1){
?>
<script>
    alert("아이디가 틀립니다!");
    history.back();
</script>
<?php
} elseif ($pw != $row["pass"]) {

?>
<script>
    alert("비밀번호가 틀립니다!");
    history.back();
</script>
<?php
} else{
        $_SESSION["userid"]=$row["id"];
        $_SESSION["name"]=$row["name"];
        $_SESSION["nick"]=$row["nick"];
        $_SESSION["level"]=$row["level"];

        header("Location:http://localhost:8888/database_team/index.php");
        exit;
    }
?>
