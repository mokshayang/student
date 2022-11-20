<?php include_once("connect.php");
    $sql_student="DELETE FROM `students` WHERE `id`='{$_GET['id']}'";
    // echo "$sql_student";

    $res_student=$pdo->exec($sql_student);
    
    if(isset($_GET['code'])){
        $url="location:../index.php?page={$_GET['page']}&code={$_GET['code']}";
    }else{
        $url="location:../index.php?page={$_GET['page']}";
    }
header($url);
?>