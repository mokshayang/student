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
    $regUrl="http://localhost/student/index.php?do=reg";
    $regLogin="http://localhost/student/index.php?do=login";
    $error="http://localhost/student/index.php?do=login&error=login";
    if($_SERVER['HTTP_REFERER'] !=$regUrl && $_SERVER['HTTP_REFERER']!=$regLogin && $_SERVER['HTTP_REFERER']!=$error){
            $_SESSION['login_url'] = $_SERVER['HTTP_REFERER'];
        }elseif(isset($_SESSION['login_reg_url'])){
            $_SESSION['login_url']=$_SESSION['login_reg_url'];
        }
        $url= $_SESSION['login_url'];

        // echo $_SESSION['login_url'];

        
    // array_push($url,$_SERVER['HTTP_REFERER']);
    echo $url;
    echo "<br>";
    
   
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