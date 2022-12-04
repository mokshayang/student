
<h1>新增消息</h1>
<form action="./api/add_news.php" method="post">
    <div>
        <label>主題</label>
        <input type="text">
    </div>
    <div>
        <label>內容</label>
        <textarea name="content" style="height:200px;"></textarea>
    </div>
    <div>
        <label>類別</label>
        <input type="text">
    </div>
    <div>
        <div class="text-right text-secondart">現在時間 : <?=date("Y-m-d H:i:s")?></div>
    </div>
    <div>
        <input type="submit" value="確定新增">
        <input type="trset" value="清空">
    </div>
</form>