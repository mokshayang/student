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
                    echo "<a href='index.php'>回首頁</a>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='index.php?do=main'>最新消息</a>";
                    echo "<a href='index.php?do=students_list'>學生列表</a>";
                    echo "</div>";
                    echo "<div>";
                    if(isset($_SESSION['login'])){
                        echo "<a href='admin_cnter.php'>回管理中心</a>";
                        echo "<a href='logout.php'>教師登出</a>";
                    }else{
                        echo "<a href='index.php?do=reg'>教師註冊</a>";
                        echo "<a href='index.php?do=login'>教師登入</a>";
                    }
                    echo "</div>";
                    echo "";
                    break;
                case "admin_center":
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    echo "";
                    break;
            }
        ?>
    </nav>
</header>