<header class="shadow">
    <nav style="height:200px;">
        <?php
            $file_str=explode("/",$_SERVER['PHP_SELF']);
            echo "<pre>";
            print_r($_SERVER['PHP_SELF']);
            echo "<br>";
            print_r($file_str);
            echo "</pre>";
            echo "<br>";

            $local=str_replace('.php','',array_pop($file_str));
            echo $local;
        ?>
    </nav>
</header>