<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/form.css">
    <title>教師登入</title>
    <style>
         h1 {          
            width: 180px;        
        }
        form {      
            grid-template-rows: 20px repeat(3,42px);
            width: 180px;
            height: 240px;
            margin: 30px auto;        
        }
        input[type=submit] {      
            margin: -24px auto;
        }
   
    </style>
</head>

<body>
    <h1>教師登入</h1>
    <form action="./api/chk_user.php" method="post">
        <label style='height: 20px;'></label>
        <label>帳號 : <input type="text" name="acc"></label>
        <label>密碼 : <input type="text" name="pw"></label>
        <input type="submit" value="登入">
    </form>
</body>

</html>