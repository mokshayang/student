<?php include_once("api/connect.php"); 
$student=$pdo->query("SELECT * FROM `students` where `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認刪除</title>
</head>
<body>
    <div class="dailog">
        <h1>確認刪除</h1>
        <div class="msg">
            確定要刪除<span><?=$student['name']?></span>
        </div>
        <div>
            <button onclick="location.href='./api_student.php?id=<?=$_GET['id']?>'">確定刪除</button>
            <button onclick="location.href='index.php'">取消</button>
        </div>
    </div>
</body>
</html>