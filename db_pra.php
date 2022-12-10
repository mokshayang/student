<h1>資料庫常用自訂函式</h1>
<h3>all()-存取指定條件的多筆資料</h3>
<?php
include_once "./db/connect.php";
//四大資料庫語法

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$rows=all('students',['name'=>'宋時雨']);//設定一個變數 = 呼叫一個自訂函式
// $rows=all('students',['dept'=>1,'graduate_at'=>1]);
dd($rows);//宋時雨 那一行的全部資料

//function 的運作要了解一下
//PHP 在第一次載入時會將所有的 function 讀一次，並放到暫存區中
//之後會再重頭讀一次
//所以在設定 function 時候 ， 是先要決定 function 的參數要如何運作。
//當 function 被呼喚時，再將參數放入
//此題的練習，在 function 內 決定了參數 $table 以及 不定參數 ...$args
//$table 在function 內 定義為 資料表名稱 
//$args 則為array or str
//而 function all() 的功能是建立查詢
//可以看到 function all()最後 return
//$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

function all($table,...$args){
    global $pdo;//開頭引入的連線檔，若要在function內使用，需加 global
    $sql="SELECT * FROM `$table` ";
    //這邊的$sql 在 function 的 { 內都會生效 }
    //需決定 $sql 要怎麼定義
    if(isset($args[0])){//反映到呼叫 all()是否有陣列 !!
        if(is_array($args[0])){
            //是陣列 ['acc'=>'mack','pw'=>'1234'];
            //是陣列 ['product'=>'PC','price'=>'10000'];
            foreach($args[0] as $key =>$value){
                //$args[0] 是單行陣列 ， $key 是 欄位名稱  $value 是內容物 的值
                //$args[0]
                $tmp[]="`$key`='$value'";
                // 這邊為了 符合 資料庫查語法
                // 將語法的形式裝入新的陣列
                // 後面再用join去跟查詢語法 ， 做合併 !!
            }
            echo '$tmp : 裝入的陣列，由foreach($args[0] as $key =>$value)來的<br>$tmp[]=$key=$value';  
            dd($tmp);
            echo '$args : 不定參數';  
            dd($args);
            echo '$args[0] : 不定參數索引';  
            dd($args[0]);
            $sql=$sql . "WHERE". join(" && ",$tmp); //與查詢語法作結合
            // WHERE `col1`='value1' && `col2`='value2' && `col2`='value2' ，要看$tmp[]有多少。
            // 反映到 all('students' , ['name'=>'宋時雨'] )
        }else{
            //是字串
            $sql=$sql . $args[0];
        }
    }
    // print_r($args[0]);
    echo "<br>";
    
    // echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

?>