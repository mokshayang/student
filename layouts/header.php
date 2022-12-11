<style>
    .shadow{
       padding: 0;
       margin: 0;
       width: 100%;
    }
    .shadow nav{
        margin: 0 0 20px 0;
        width: 100%;
        height: 60px;
        background-color: #fff;
        box-shadow: 1px 1px 10px #333;
        display: grid;
        grid-template-columns: repeat(3,1fr);
        align-items: center;
    }
    
</style>
<header class="shadow">
    <nav >
        <?php
            $file_str=explode("/",$_SERVER['PHP_SELF']);

            // echo "<pre>";
            // print_r($_SERVER['PHP_SELF']);
            // echo "<br>";
            // print_r($file_str);
            // echo "</pre>";
            // echo "<br>";

            $local=str_replace('.php','',array_pop($file_str));
            // echo $local;
            // echo "<br>";
            // print_r($file_str);//最後一個字串被拿掉了
            switch($local){
                case "index":
                    echo "<div>";
                    echo "<a href='../'>回作品集首頁 !</a>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='index.php?do=main'>最新消息</a>";
                    echo "<a href='index.php?do=students_list&page=1'>學生列表</a>";
                    echo "<a href='index.php?do=survey'>意見調查</a>";
                    echo "</div>";
                    echo "<div>";
                    if(isset($_SESSION['login'])){
                        echo "<a href='admin_center.php'>回管理中心</a>";
                        echo "<a href='logout.php'>教師登出</a>";
                    }else{
                        echo "<a href='index.php?do=reg'>教師註冊</a>";
                        echo "<a href='index.php?do=login'>教師登入</a>";
                    }
                    echo "</div>";
                    echo "";
                    break;
                case "admin_center":
                    echo "<div>";
                    echo "<a href='admin_center.php'>回管理首頁</a>";
                    echo "<a href='index.php'>回網站首頁</a>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='admin_center.php?do=students_list&page=1'>學生管理</a>";
                    echo "<a href='admin_center.php?do=news'>新聞管理</a>";
                    echo "<a class='mx-2' href='admin_center.php?do=survey'>問卷管理</a>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='?do=add'>新增學生</a>";
                    echo "<a href='logout.php'>教師登出</a>";
                    echo "</div>";
                    break;
            }
        ?>
    </nav>
</header>