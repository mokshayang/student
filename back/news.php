<style>
    .newTool{
        width: 72%;
        margin: auto;
    }
    .newAdd {
        display: block;
        width: 100px;
        height: 42px;
        background-color: #44e;
        color: #eee;
        text-decoration: none;
        line-height: 43px;
        border-radius: 10px;
        text-align: center;
        margin: 0 0 10px 10px;
        font-size: 18px;
    }
    .newAdd:hover{
        background-color: #33f;
    }
    .list,
    .items {
        margin: auto;
        display: inline-block;
    }
    .list div,
    .items div {
        display: inline-block;
    }
    .list,.items{
        height: 80px;
        display: grid;
        grid-template-columns: 4fr 1fr 1fr 3fr 3fr;
        justify-items: center;
        align-items: center;
    }
    .list{
        font-size: 18px;
        background-color: #17a2b8;
        color:#eee;
    }
    .items{
        border-bottom: 1px solid #ccc;
    }
 
    .items a{
        display: inline-block;
        width: 60px;
        height: 40px;
        background-color: #44e;
        color: #eee;
        text-decoration: none;
        line-height: 43px;
        border-radius: 10px;
        text-align: center;
        margin: 0 10px 0;
    }
    .items a:nth-child(2){
        background-color: #f44;
    }
    .items a:hover{
        background-color: #22e;
    }
    .items a:nth-child(2):hover{
        background-color: #f00;
    }
</style>
<h1>新聞管理</h1>
<div class="newTool">
    <a href="admin_center.php?do=add_news" class="newAdd">新增消息</a>
    <div class="list">
        <div>標題</div>
        <div>置頂</div>
        <div>點閱數</div>
        <div>發布時間</div>
        <div>操作</div>
    </div>
    <?php
    $all_news = "SELECT * FROM `news` ";
    $rows = $pdo->query($all_news)->fetchAll();
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";

    foreach ($rows as $row) {
        echo "<div class='items'>";
        echo "<div>";
        echo $row['subject'];
        echo "</div>";
        echo "<div>";
        echo ($row['top'] == 1) ? "TOP" : '';
        echo "</div>";
        echo "<div>";
        echo $row['readed'];
        echo "</div>";
        echo "<div>";
        echo $row['created_at'];
        echo "</div>";

        echo "<div>";
        echo "<a href='admin_center.php?do=news_edit&id={$row['id']}'>編輯</a>";
        echo "<a href='./api/news_del.php?id={$row['id']}' onclick=\"
            if(confirm(`確定刪除 {$row['subject']} 嗎 ?`)){
                if (prompt(`請輸入 DELETE 以刪除 {$row['subject']} `, 'DELETE') == 'DELETE') {
                    alert(`已刪除 {$row['subject']} 的所有資料 ， 刪除成功`);
                    return true;
                } else {
                    alert('動作錯誤，取消刪除 !')
                    return false;
                }
            } else {
                alert('取消刪除動作');
                return false;
            }
            \">刪除</a>";
        echo "</div>";

        echo "</div>";
    }
    ?>
</div>