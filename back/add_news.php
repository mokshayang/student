
<h1>新增消息</h1>
<main class="container">
<form action="./api/add_news.php" method="post">
    <div class="form-group row">
        <label  class="col-form-label col-md-2 text-right">主題</label>
        <input name="subject" type="text" class="form-control col-md-10" >
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">內容</label>
        <textarea name="content" style="height:240px;" class="form-control col-md-10"></textarea>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">類別</label>
        <input name="type" type="text" class="form-control col-md-10" >
    </div>
    <div class="text-right text-secondart" style="margin:20px;text-align:right;">現在時間 : <?=date("Y-m-d H:i:s")?></div>
    <div  class="text-center">
        <input type="submit" class="btn btn-primary mx-2" value="確定新增">
        <input type="trset" class="btn btn-warning mx-2" value="清空">
    </div>
</form>
</main>