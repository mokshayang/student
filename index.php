<?php
include_once("api/connect.php");
// $sql = "SELECT * FROM `students`";
// $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//new PDO('mysql:host=localhost;charset=utf8;dbname=school','root(帳號)','(密碼)')->query("SELECT *    FROM `students` LIMIT 18")為已連線資料庫
//fetchALL(PDL::FETCH_NUM(or ASSOC or NAMED))拿取資料 fetchALL->全拿 
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>學生管理系統</title>
    <style>

    </style>
</head>

<body>
    <h1>學生管理系統</h1>
    <nav>
        <a href="add.php">新增學生</a>
        <a href="reg.php">教師註冊</a>
        <a href="login.php">教師登入</a>
    </nav>
    <div class="studentsList">
        <div class="item">
            <div>學號</div>
            <div>姓名</div>
            <div>生日</div>
            <div>畢業國中</div>
            <div>年齡</div>
            <div>編輯</div>
        </div>
        <div class="students">
            <?php
            if (isset($_GET['code'])) {
                $sql =  "SELECT `students`.`id`,
                                `students`.`school_num`,
                                `students`.`name`,
                                `students`.`birthday`,
                                `students`.`graduate_at`
                          FROM  `students`,`class_student`
                          WHERE `class_student`.`school_num`=`students`.`school_num` &&
                                `class_student`.`class_code`='{$_GET['code']}' ";
                //將下列code帶入 sql 查詢 會得到每班的人數 (ground by `classes`.`code`)
                $sql_total = "SELECT count(`students`.`id`)
                              FROM  `class_student`,`students` 
                              WHERE `class_student`.`school_num`=`students`.`school_num` && 
                                    `class_student`.`class_code`='{$_GET['code']}'";
            } else {
                $sql = "SELECT `id`,`school_num`,
                               `name`,`birthday`,
                               `graduate_at`
                          FROM `students`";
                $sql_total = "SELECT count(`id`) FROM `students`";
            }
            //分頁設定:
            $div = 12; //每頁筆數
            //有$_GET['code']的$total是班級人數
            //有$_GET['code']的$page是以班級的為單位的總頁數
            $total = $pdo->query($sql_total)->fetchColumn(); // echo "總比數為 : ".$total;
            $pages = ceil($total / $div); //總頁數;
            $now = (isset($_GET['page'])) ? $_GET['page'] : 1; //當前頁數
            $star = ($now - 1) * $div; //dbDate為0開始 開始撈的比數

            $sql = $sql . "LIMIT $star,$div";

            $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($rows as $row) {
                if(isset($_GET['code'])){
                    $url="<a href=api/del_student.php?id={$row['id']}&page={$now}&code={$_GET['code']} onclick=\"return del()\">刪除</a>";
                }else{
                    $url="<a href=api/del_student.php?id={$row['id']}&page={$now} onclick=\"return del()\">刪除</a>";
                }
                $age = round((strtotime('now') - strtotime($row['birthday'])) / (60 * 60 * 24 * 365), 1);
                echo "<div class='studentDate'>";
                echo    "<div>{$row['school_num']}</div>";
                echo    "<div>{$row['name']}</div>";
                echo    "<div>{$row['birthday']}</div>";
                echo    "<div>{$row['graduate_at']}</div>";
                echo    "<div>{$age}</div>";
                echo    "<div class='operate'>";
                echo        "<a href=edit.php?id={$row['id']}>修改</a>";
                echo        $url;
                echo    "</div>";
                echo "</div>";
            }
            echo "</div>";


            //$now  當前頁面;
            //$pages 總頁數;
            $showPage = 5; //要秀出分頁數量;
            //isset ( class_student`.`class_code`='{$_GET['code']}' )
            //以班級為單位的分頁預覽，因為$_GET['code']存在，這邊的$pages會以班級為單位
            if (isset($_GET['code'])) {
                echo "<div class='pages'>";
                echo "<div></div>";
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i == $now) {
                        echo "<div> ";
                        echo $i;
                        echo "</div>";
                    } else {
                        echo "<a href='?page=$i&code={$_GET['code']}'> ";
                        echo $i;
                        echo " </a>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
            //!!!isset ( class_student`.`class_code`='{$_GET['code']}' )
            //全體學生的分頁預覽
            echo "<div class='pages'>";
            if (!isset($_GET['code'])) {
                if ($now == 1) {
                    echo "<div >";
                    echo "首頁";
                    echo "</div>";
                } else {
                    echo "<a href=?page=1 class='fe'>首頁</a>";
                }
                if ($now <= ceil($showPage / 2)) {
                    for ($i = 1; $i <= $showPage; $i++) {
                        if ($i == $now) {
                            echo "<div class='selectA'>";
                            echo $i;
                            echo "</div>";
                        } else {
                            echo "<a href='?page=$i'>";
                            echo $i;
                            echo "</a>";
                        }
                    }
                }
                if (($now > ceil($showPage / 2)) && ($now < ($pages - ceil($showPage / 2)))) {
                    for ($i = $now - (ceil($showPage / 2) - 1); $i < $now + ceil($showPage / 2); $i++) {
                        if ($i == $now) {
                            echo "<div >";
                            echo $i;
                            echo "</div>";
                        } else {
                            echo "<a href='?page=$i'>";
                            echo $i;
                            echo "</a>";
                        }
                    }
                }
                if ($now >= ($pages - ceil($showPage / 2))) {
                    for ($i = ($pages - $showPage + 1); $i <= $pages; $i++) {
                        if ($i == $now) {
                            echo "<div >";
                            echo $i;
                            echo "</div>";
                        } else {
                            echo "<a href='?page=$i'>";
                            echo $i;
                            echo "</a>";
                        }
                    }
                }
                if ($now == $pages) {
                    echo "<div >";
                    echo "末頁";
                    echo "</div>";
                } else {
                    echo "<a href=?page=" . $pages . " class='fe'>末頁</a>";
                }
            }
            echo "</div>";
            ?>
            <!-- 班級 GET code -->
            <!-- $_GET['code'] 來自 `classes`.`code` -->
            <div class="classes">
                <?php
                $sql = "SELECT `code`,`name` FROM `classes`";
                $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                $code = (isset($_GET['code'])) ? $_GET['code'] : 1;
                foreach ($classes as $class) {
                    if ($code == $class['code']) {
                        echo "<div >";
                        echo "<a href='?code={$class['code']}' style='background-color:#00e;color:#eee;'>{$class['name']}</a>";
                        echo "</div>";
                    } else {
                        echo "<div>";
                        echo "<a href='?code={$class['code']}'>{$class['name']}</a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <style>
                .totalSat a {
                    display: block;
                    width: 200px;
                    height: 40px;
                    font-size: 24px;
                    margin: 10px auto;
                    text-align: center;
                    line-height: 40px;
                    border-radius: 10px;
                    text-decoration: none;
                    background-color: #aaf;
                    color: #333;
                    font-weight: bold;
                }

                .totalSat a:hover {
                    background-color: #00e;
                    color: #eee;
                }
            </style>
            <!-- 全體學生按鈕 -->
            <?php
            if (isset($_GET['page']) && !isset($_GET['code'])) {
            ?>
                <div class="totalSat"><a href="<?= '?page=1' ?>" style='background-color: #00e;color: #eee;'>全體學生</a></div>
            <?php } else {; ?>
                <div class="totalSat"><a href="<?= '?page=1' ?>">全體學生</a></div>
            <?php }; ?>
            <!-- ------------------------------ -->
            <script>
                function del() {
                    if (confirm("確定刪除嗎 ? ")) {
                        if(prompt("請輸入 DELETE","DELETE")=="DELETE") {
                            alert("刪除成功");
                            return true;
                        }else{
                            alert("動作錯誤，取消刪除 !")
                            return false;
                        }
                    } else {
                        alert("取消刪除動作");
                        return false;
                    }
                }
            </script>
</body>

</html>