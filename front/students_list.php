<style>
     h1{
        margin-bottom: 10px;
    }
</style>
<h1>學生管理系統</h1>
<!-- <nav>
       
        <a href="front/reg.php">教師註冊</a>
        <a href="front/login.php">教師登入</a>
    </nav> -->

<?php
if (isset($_GET['del'])) {
    echo "<div class='del-msg'>";
    echo $_GET['del'];
    echo "</div>";

    unset($_GET['del']);
}
?>
<div class="studentsList">
    <div class="item">
        <div>學號</div>
        <div>姓名</div>
        <div>生日</div>
        <div>畢業國中</div>
        <div>年齡</div>
        <!-- <div>編輯</div> -->
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
            if (isset($_GET['code'])) {
                $url_del = "<a href=api/del_student.php?id={$row['id']}&page={$now}&code={$_GET['code']} onclick=\"if(confirm(`確定刪除 {$row['name']} 嗎 ?`)){
                        if (prompt(`請輸入 DELETE 以刪除 {$row['name']} `, 'DELETE') == 'DELETE') {
                            alert(`已刪除 {$row['name']} 的所有資料 ， 刪除成功`);
                            return true;
                        } else {
                            alert('動作錯誤，取消刪除 !')
                            return false;
                        }
                    } else {
                        alert('取消刪除動作');
                        return false;
                    }\">刪除</a>";
                $url_amend = "<a href=edit.php?id={$row['id']}&page={$now}&code={$_GET['code']}>修改</a>";
            } else {
                $url_del = "<a href=api/del_student.php?id={$row['id']}&page={$now} onclick=\"if(confirm(`確定刪除 {$row['name']} 嗎 ?`)){
                        if (prompt(`請輸入 DELETE 以刪除 {$row['name']} `, 'DELETE') == 'DELETE') {
                            alert(`已刪除 {$row['name']} 的所有資料 ， 刪除成功`);
                            return true;
                        } else {
                            alert('動作錯誤，取消刪除 !')
                            return false;
                        }
                    } else {
                        alert('取消刪除動作');
                        return false;
                    }\">刪除</a>";
                $url_amend = "<a href=edit.php?id={$row['id']}&page={$now}>修改</a>";
            }

            $age = round((strtotime('now') - strtotime($row['birthday'])) / (60 * 60 * 24 * 365), 0);
            echo "<div class='studentDate'>";
            echo    "<div>{$row['school_num']}</div>";
            echo    "<div>{$row['name']}</div>";
            echo    "<div>{$row['birthday']}</div>";
            echo    "<div>{$row['graduate_at']}</div>";
            echo    "<div>{$age}</div>";
            //echo    "<div class='operate'>";
            // echo        $url_amend;
            // echo        $url_del;
            //echo    "</div>";
            echo "</div>";
        }
        //$now  當前頁面;
        //$pages 總頁數;
        ?>
    </div>
    <div class='pages'>

        <?php
        //首頁

        if (!isset($_GET['code'])) {
            if ($now == 1) {
                echo "<div class='now'>";
                echo "首頁";
                echo "</div>";
            } else {
                echo "<a href='do=students_list&?page=1' class='fe'>首頁</a>";
            }
        } else {
            if ($now == 1) {
                echo "<div class='now'>";
                echo "首頁";
                echo "</div>";
            } else {
                echo "<a href=?do=students_list&page=1&code={$_GET['code']} class='fe'>首頁</a>";
            }
        }
        ?>
        <div>
            <?php
            //上一頁
            //當前頁碼-1,可是不能小於0,最小是1,如果是0,不顯示
            $prev = $now - 1;
            if ($now - 1 >= 1) {
                if (isset($_GET['code'])) {
                    echo "<a href='?do=students_list&page=$prev&code={$_GET['code']}'>";
                    echo "&lt;";
                    echo "</a>";
                } else {
                    echo "<a href='?do=students_list&page=$prev'>";
                    echo "&lt;";
                    echo "</a>";
                }
            } else {
                echo "<a class='noshow'>&nbsp;</a>";
            }
            ?>
            <?php
            //顯示第一頁
            // if ($now >= 4) {
            //     if (isset($_GET['code'])) {
            //         echo "<a href='?page=1&code={$_GET['code']}'> ";
            //         echo "1 ";
            //         echo " </a>...";
            //     } else {
            //         echo "<a href='?page=1'> ";
            //         echo "1 ";
            //         echo " </a>...";
            //     }
            // }
            ?>
            <?php
            //頁碼區
            //只顯示前後四個頁碼
            if (!isset($_GET['code'])) {
                if ($now >= 3 && $now <= ($pages - 2)) {  //判斷頁碼在>=3 及小於最後兩頁的狀況
                    $startPage = $now - 2;
                } else if ($now - 2 < 3) { //判斷頁碼在1,2頁的狀況
                    $startPage = 1;
                } else {  //判斷頁碼在最後兩頁的狀況
                    $startPage = $pages - 4;
                }
            } else {
                $startPage = 1;
            }
            if (!isset($_GET['code'])) {
                for ($i = $startPage; $i <= ($startPage + 4); $i++) {
                    $nowPage = ($i == $now) ? 'now' : '';
                    if (isset($_GET['code'])) {
                        echo "<a href='?do=students_list&page=$i&code={$_GET['code']}' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    } else {
                        echo "<a href='?do=students_list&page=$i' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    }
                }
            } else {
                for ($i = $startPage; $i <= $pages; $i++) {
                    $nowPage = ($i == $now) ? 'now' : '';
                    if (isset($_GET['code'])) {
                        echo "<a href='?do=students_list&page=$i&code={$_GET['code']}' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    } else {
                        echo "<a href='?do=students_list&page=$i' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    }
                }
            }
            //全部頁碼顯示
            /*
                for ($i = 1; $i <= $pages; $i++) {
                    $nowPage = ($i == $now) ? 'now' : '';
                    if (isset($_GET['code'])) {
                        echo "<a href='?page=$i&code={$_GET['code']}' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    } else {

                        echo "<a href='?page=$i' class='$nowPage'> ";
                        echo $i;
                        echo " </a>";
                    }
                }
                */
            ?>
            <?php
            //顯示第最後一頁 
            // if ($now <= ($pages - 3)) {
            //     if (isset($_GET['code'])) {
            //         echo "...<a href='?page=$pages&code={$_GET['code']}'> ";
            //         echo "$pages";
            //         echo " </a>";
            //     } else {
            //         echo "...<a href='?page=$pages'> ";
            //         echo "$pages";
            //         echo " </a>";
            //     }
            // }
            ?>
            <?php
            //下一頁
            //當前頁碼+1,可是不能超過總頁數,最大是總頁數,如果超過總頁數,不顯示
            if (($now + 1) <= $pages) {
                $next = $now + 1;
                if (isset($_GET['code'])) {
                    echo "<a href='?do=students_list&page=$next&code={$_GET['code']}'> ";
                    echo "&gt; ";
                    echo " </a>";
                } else {
                    echo "<a href='?do=students_list&page=$next'> ";
                    echo "&gt; ";
                    echo " </a>";
                }
            } else {
                echo "<a class='noshow'>&nbsp;</a>";
            }

            ?>
        </div>
        <?php
        //末頁
        if (!isset($_GET['code'])) {
            if ($now == $pages) {
                echo "<div class='now'>";
                echo "末頁";
                echo "</div>";
            } else {
                echo "<a href=?do=students_list&page=$pages class='fe'>末頁</a>";
            }
        } else {
            if ($now == $pages) {
                echo "<div class='now'>";
                echo "末頁";
                echo "</div>";
            } else {
                echo "<a href=?do=students_list&page=$pages&code={$_GET['code']} class='fe'>末頁</a>";
            }
        }
        ?>
        
    </div>
    <?php include_once "layouts/class_nav.php"; ?>   
