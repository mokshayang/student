<?php
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