<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');
// $dsn="mysql:host=localhost;charset=utf8;dbname=s1110415";
// $pdo=new PDO($dsn,'s1110415','s1110415');
date_default_timezone_set("Asia/Taipei");
session_start();
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
//dd($rows);
//definition function  SQL : C R U D
/**
 * pram table - 資料表名稱
 * pram args[0] - where 條件(array)或sql字串
 * pram args[1] - order by limit 之類的sql 字串
 */

// $rows = all('students',['dept'=>'2','graduate_at'=>'2']," ORDER BY `id`");
// dd($rows);//[0] = 第一為同學的資料
// SELECT * FROM $table join(" && " ,$tmp)( WHERE  `$KEY` = 'VALUE' && ..... ).$args[1];
$rows=all('students'," where `dept`='2'");
function all($table,...$args){//查詢全部的資料 SQL : R
    //$args is array $agrs[0]$agrs[1]
    //$agrs[0]資料表欄位名稱的 " 鍵 " => value
    //$agrs[1]

    global $pdo;
    $sql="SELECT * FROM $table";

    if(isset($args[0])){
        if(is_array($args[0])){
            //是陣列 ['acc'=>'mack','pw'=>'1234'];
            //是陣列 ['product'=>'PC','price'=>'10000'];
            //最後的R(讀取查詢) 是fetchAll屬二維陣列，所以用 $args[0]
            foreach($args[0] as $key => $value){
                //用foreach 將鍵跟值分開，
                //再用符合sql語法的方式，裝入$tmp
                //最後在用join()合併(也是為了符合sql語法)

                //foreach.$key=dbname.colname
                //$value = $table[column.name]
                $tmp[]="`$key`='$value'";
                // echo '$args :';
                // dd($args);
                // echo '$args[0] :';
                // dd($args[0]);
                // echo '$args[0][name] :';
                // dd($args[0]['name']);
                // echo '$args[0][dept] :';
                // dd($args[0]['dept']);
                // echo '$tmp :';
                // dd($tmp); //[0] => `name`='王大同'  [1] => `dept`='4'
            }
            //須符合SQL語法
            //用join將 $tmp 用 && 合併
            $sql=$sql . " WHERE " . join(" && " ,$tmp);
            //注意這邊 " WHERE " 要空一格
        }else{
            //字串的時候 :
            $sql=$sql . $args[0];
        }
        
    }
    if(isset($args[1])){
        //args[1] - order by limit 之類的sql 字串
        $sql=$sql . $args[1];
        // echo "$args[1]";
    }
    // echo $sql;
    //因為是fecthAll(屬二維陣列)，所以將不定參數條件設為$args[0];
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

//definition function find()
//找尋 ID 傳回指定的id得 資料
//SQL : R
function find($table,$id){
    global $pdo;
    $sql="SELECT * FROM `$table` ";

    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]="`$key`='$value'";
            // dd($tmp);
        }
        $sql=$sql . "  WHERE " . join(" && " ,$tmp);
    }else{
        $sql.=" WHERE `id`='$id'";
        // `id`='$id' ,已經有+符號，直接給數字就行了  $row=find('students','7');
        // echo $sql;
        // echo "<br>";
    }
    // echo "<br>";
    // echo $sql;
    //fetch 屬單為陣列 若改為 fetchAll(二為陣列)，則等同於 all() definition function array.class
    //因fetch的關係，find()只會出現單筆資料。所以條件給一個就行了
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

//$row=find('students',['id'=>'2','id'=>'4']);//無效，原因見下行:
// $tmp[]="`$key`='$value'"; 同個欄位名稱，被視為key鍵，同一個key鍵無法指定兩個值;

//$row=find('students',18);
//dd($row);

//查詢檔名的方法 : 
// $a=$_SERVER['PHP_SELF'];//所在位置的路徑
// dd($a);
// $aa=explode('/',$_SERVER['PHP_SELF']);//炸開,合併為array
// dd($aa);
// $bb=str_replace('.php','',($aa));//將 .php 代替 為 ''
// dd($bb);
// $cc=str_replace('.php','',array_pop($aa));//取走array中的最後一個value
// dd($cc);

// UPDATE "表格"
// SET "欄位1" = [值1], "欄位2" = [值2]
// WHERE "條件";
// definition function update() SQL : U :
// 給定條件 更新資料 UPDATE table SET `a`='a1' WHERE ... (必須)
function update($table,$col,...$args){
    global $pdo;
    $sql="UPDATE $table SET ";
    //$col SQL:U 前半段語法 UPDATE "表格" SET `欄位1` ='值1' , `欄位2`='值2'
    if(is_array($col)){//
        foreach($col as $key => $value){
            $tmp[]="`$key`='$value'";
            // dd($tmp);
        }
        $sql=$sql . join(" , ", $tmp);
        // dd($sql);
    }else{
        echo "語法錯誤，請以陣列的形式輸入 !";
    }
    if(isset($args[0])){
        if(is_array($args[0])){
            $tmp=[];//因用與上方相同名稱，所以要清空。
            foreach($args[0] as $key => $value){
                $tmp[]="`$key`='$value'";
                dd($tmp);
            }
            $sql=$sql . " WHERE " . join(" && ",$tmp);
            // dd($sql);
        }else{
            $sql .= " WHERE `id` ='{$args[0]}'" ; 
        }
    }
    echo $sql;
    return $pdo->exec($sql);
}
// update('students',['name'=>'劉勤永','dept'=>'2','graduate_at'=>'3']);
// update('students',['name'=>'王大同','dept'=>'4'],['id'=>19]);
// update students set name='王大同',dept='4' where id='19'

// definition function update() SQL : C :
// INSERT INTO table (column1, column2...) VALUES (value1, value2...);
//新增資料
/**
 * `['school_num'=>'911799',
 *  'class_code'=>'101',
 *  'seat_num'=>51,
 *  'year'=>2000]`
 */
function insert($table,$cols){
    global $pdo;
    $keys=array_keys($cols);
    // dd(join("`,`",$keys));
    // dd(join("','",$cols));
    
    $sql="INSERT INTO $table (`" . join("`,`",$keys) ."`) VALUES ('" . join("','",$cols) ."')";
    
    // $sql="
    // INSERT INTO $table (`" . join("`
    //  ,`",$keys) . "`) 
    //  VALUES ('" . join("'
    // ,'",$cols) . "')
    // ";

    //INSERT INTO class_student (`school_num`,`class_code`,`seat_num`,`year`) 
    //VALUES ('911799','101','51','2000')
    // echo $sql;
    return $pdo->exec($sql);
}
// insert('students','')
// insert('class_student',['school_num'=>'911799',
//                         'class_code'=>'101',
//                         'seat_num'=>51,
//                         'year'=>2000]);


// definition function update() SQL : D :
//刪除資料 最簡單的 WHERE必加 除非你想全部刪除
//DELETE FROM table WHERE 欄名=資料;
function del($table,$id){
    global $pdo;
    $sql="DELETE FROM `$table`";
    if(is_array($id)){
        $tmp=[];
        foreach($id as $key =>$value){
            $tmp[]="`$key`='$value'";
            // dd($tmp);
        }
        $sql=$sql . " WHERE" . join(" && ",$tmp);
        // echo $sql;
        // echo "<br>";
    }else{
        $sql=$sql . " WHERE `id`='$id'";
    }
    // echo $sql;
    return $pdo->exec($sql);
}

// del('class_student',['id'=>485]);
// del('class_student',485);

//C R U D :
//SQL : C  return $pdo->exec($sql); 無須 WHERE 第二簡單 第二單純
//INSERT INTO table (column1, column2...) VALUES (value1, value2...);
//insert($table,$cols) $keys=array_keys($cols);
//型式   insert('class_student',['school_num'=>'911799',
//                               'class_code'=>'101',
//                               'seat_num'=>51,
//                               'year'=>2000]);

//SQL : R $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); 用最多的
//all($table,...$args)//二微陣列 fetchAll(PDO::FETCH_ASSOC);
//型式 : all('students'," where `dept`='2'");//str
//型式 : all('students',['name'=>'宋時雨']); //array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]);//array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]," ORDER BY `id` desc");//array+$args[1]
//find($table,$id)//一微陣列 單列 指定id  fetch(PDO::FETCH_ASSOC);
//型式 find('students',['dept'=>4]);
//型式 find('students',6);

//SQL : U return $pdo->exec($sql);  WHERE ... (必須)
//最麻煩 三個參數 :
//UPDATE "表格" 參數 $table 
//SET "欄位1" = [值1], "欄位2" = [值2] 參數 $col 必定是array 的形式
//WHERE "條件"; 參數 $args 可以 array 也可以 字串
//給定條件 更新資料 UPDATE table SET `a`='a1' WHERE ... (必須)
//update($table,$col,...$args) $col必定為一為陣列
//型式 : update('students',['name'=>'劉勤永','dept'=>'2','graduate_at'=>'3']);
//型式 : update('students',['name'=>'王大同','dept'=>'4'],['id'=>19]);
//型式 : update students set name='王大同',dept='4' where id='19'

//SQL : D return $pdo->exec($sql);  WHERE ... (必須)
//第一簡單 第一單純
//del($table,$id)
//$id 陣列時 可指定其他單一條件 ， 只丟數字 預設是 id
//型式 : del('students',484);
//型式 : del('students',['dept'=>4]);

// 常用的 definition function :
// 萬用查詢 :
function q($sql){
    global $pdo;
    echo $sql;
    return $pdo->query($sql)->fetchAll();    
}
// $sql="select * from `students` where `dept`='2'";
// dd(q($sql));

//轉換網頁 :
function to($location){
    header("location:$location");
}
//to("../xxxx/xxxx");

?>