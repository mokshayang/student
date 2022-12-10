<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/form.css">
    <title>教師註冊</title>
    <style>
        form {
            width: 400px;
            display: grid;
            grid-auto-rows: 50px;
            grid-gap: 20px;
            height: 420px;
            justify-items: start;
        }
        form label {
            margin-left: 40px;
        }
        form div {
            margin-left: 100px;
        }
        .bot {
            width: 50%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .bot input {
            font-size: 18px;
        }
        input[type=email] {
            width: 280px;
        }
        #seepw,
        #seerpw {
            position: relative;
            right: 36px;
            text-shadow: 1px 1px 1px #666;
            top: 2px;
            cursor: pointer;
            font-size: 20px;
        }
        #pw,
        #repw {
            width: 160px;
        }
        #check,
        #checkpw {
            position: relative;
            right: 32px;
        }
        .blue{
            color: #00c;
        }
        .grey{
            color: #999;
        }
     
    </style>
</head>

<body>
    <script>
        function censorpw() { //檢查密碼長度
            let check = false;
            let pass = document.getElementById("pw").value;
            if (pass.length < 4) {
                document.getElementById("checkpw").innerHTML = "請多於4位";
                check = false;
            } else {
                document.getElementById("checkpw").innerHTML = "√";
                check = true;
            };
            return check;
        };
        function rePw() { //確認密碼 與 密碼確認是否一樣
            let check = false;
            let pass = document.getElementById("pw").value;
            let repass = document.getElementById("repw").value;
            if (pass != repass) {
                document.getElementById("check").innerHTML = "與密碼不同";
                check = false;
            } else {
                document.getElementById("check").innerHTML = " √";
                check = true;
            };
            return check;
        };
        function checkForm() { //阻擋提交   
            let check =  censorpw() && rePw() ;
            return check;
        };
    </script>
    <h1>教師註冊</h1>
    <form action="api/reg_user.php" method="post" autocomplete="off" onSubmit="return checkForm()">
        <label>帳　　號 :
            <input type="text" name="acc" required autofocus>
        </label>
        <label>密　　碼 :
            <input type="password" name="pw" required id="pw" placeholder=" 請輸入4字以上" onChange="censorpw()">
            <i id="seepw" class="fa-solid fa-eye-slash grey"></i>&nbsp;
            <span id="checkpw" style="color:#f00; font-size:16px;"></span>
        </label>
        <label>確認密碼 :
            <input type="password" required onchange="rePw()" id="repw">
            <i id="seerpw" class="fa-solid fa-eye-slash grey"></i>&nbsp;
            <span id="check" style="color:#f00; font-size:16px;"></span>
        </label>
        <label>信　　箱 :
            <input type="email" name="email">
        </label>
        <label>姓　　名 :
            <input type="text" name="name" required>
        </label>
        <div class="bot">
            <input type="reset" value="重製">
            <input type="submit" value="註冊">
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#seepw').click(function() {
            let passtype = document.getElementById("pw");
            if (passtype.type == 'password') {
                $('#pw').attr('type', 'text'); //inp的type切換
                $('#seepw').removeClass().addClass('fa-solid fa-eye blue'); // 切換圖標
            } else {
                $('#pw').attr('type', 'password'); //inp的type切換
                $('#seepw').removeClass().addClass('fa-solid fa-eye-slash grey'); // 切換圖標
            };
        });
        $('#seerpw').click(function() {
            let passtype = document.getElementById("repw");
            if (passtype.type == 'password') {
                $('#repw').attr('type', 'text'); //inp的type切換
                $('#seerpw').removeClass().addClass('fa-solid fa-eye blue show'); // 切換圖標
            } else {
                $('#repw').attr('type', 'password'); //inp的type切換
                $('#seerpw').removeClass().addClass('fa-solid fa-eye-slash grey'); // 切換圖標
            };
        });
    </script>
</body>

</html>