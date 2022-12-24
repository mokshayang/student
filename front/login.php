<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>教師登入</title>
    <style>
        h1 {
            width: 180px;
        }
        form {
            grid-template-rows: 20px repeat(3, 42px);
            width: 180px;
            height: 240px;
            margin: 30px auto;
        }
        input[type=submit] {
            margin: -24px auto;
        }
        div{
            text-align: center;
            font-size: 20px;
            color: #e00;
        }
    </style>
</head>

<body>
    <?php
    //$_SERVER['HTTP_REFERER']
    //註冊時的當前頁面$regUrl
    //登入時的當前頁面$regLogin
    //錯誤時的轉跳頁面$error
    //當入錯誤時api/chk_user.phpdo?=login&error=login g
    //此時，轉到註冊頁面時 如果沒有下方判斷!=$error
    //會導致登入時，無法轉調頁面。
    // 本地路徑----------------------
    $regUrl="http://localhost/student/index.php?do=reg";
    $regLogin="http://localhost/student/index.php?do=login";
    $error="http://localhost/student/index.php?do=login&error=login";
    // 老師的路徑--------------------
    // $regUrl="http://220.128.133.15/s1110415/school/index.php?do=reg";
    // $regLogin="http://220.128.133.15/s1110415/school/index.php?do=login";
    // $error="http://220.128.133.15/s1110415/school/index.php?do=login&error=login";
    // $filereg=explode("/",$regUrl);
    // $reg_referer=array_pop($filereg);
    // echo $reg_referer;
    // $filelogin=explode("/",$regUrl);
    // $file=explode("/",$_SERVER['HTTP_REFERER']);
    // $f=array_pop($file);
    // dd($file);
    // echo "<br>";
    // dd($f);
    if($_SERVER['HTTP_REFERER'] != $regUrl && $_SERVER['HTTP_REFERER'] != $regLogin && $_SERVER['HTTP_REFERER'] != $error){
            $_SESSION['login_url'] = $_SERVER['HTTP_REFERER'];
        }elseif(isset($_SESSION['login_reg_url'])){
            $_SESSION['login_url']=$_SESSION['login_reg_url'];
        }
        //這裡決定了(login)，當前一頁面放入變數，
        //再由input:hidden到api/chk_user.php
        $url= $_SESSION['login_url'];
        echo $url;
    ?>
    <h1>教師登入</h1>
    <form action="api/chk_user.php" method="post" autocomplete="off">
        <label style='height: 20px;'></label>
        <label>帳號 : <input type="text" name="acc"></label>
        <label>密碼 : <input type="password" name="pw"></label>
        <input type="submit" value="登入">
        <input type="hidden" name="url" value="<?=$url?>">
    </form>
    <?php
    if (isset($_GET['error'])) {
        echo "<div>帳號或密碼錯誤</div>";
        echo "<div>已登入嘗試" . $_SESSION['login_try'] . "次<div>";
    }
    // if( $_SESSION['login_try']>5){
    //     header("location:index.php");
    // }
    ?>
</body>

</html>