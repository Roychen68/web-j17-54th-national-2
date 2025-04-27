<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台北101接駁專車</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="map.css">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
    </style>
</head>

<body>
    <header class="shadow" id="navbar">
        <div class="logo" id="logo">
            <img src="../01_01/01_LOGO.png" alt="" class="logo">
            <h1>台北101接駁專車系統</h1>
        </div>
        <div class="links">
            <button class="btn btn-primary" onclick="check()">系統管理</button>
            <button class="btn btn-danger" onclick="logout()" id="logout-btn">登出</button>
        </div>
    </header>
    <div class="card">
        <form class="card-body text-center">
            <h1>意願調查表單</h1>
            <div class="form-group w-75 ml-auto mr-auto">
                <label for="name">姓名</label>
                <input type="text" id="name" name="name" class="form-control text-center" required>
            </div>
            <div class="form-group w-75 ml-auto mr-auto">
                <label for="email">信箱</label>
                <input type="email" id="email" name="email" class="form-control text-center" required>
            </div>
            <div class="form-group w-75 ml-auto mr-auto">
                <label for="note">備註</label>
                <textarea name="note" id="note" class="form-control text-center"></textarea>
            </div>
            <button class="btn btn-primary" id="submit-button">送出</button>
        </form>
    </div>
    <div class="modal fade" id="login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>台北101接駁專車系統-系統管理</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">帳號:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">密碼:</label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="captcha">驗證碼:<span id="captcha"></span></label>
                        <input type="text" class="form-control" name="captcha" id="captcha">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" id="regenerate-captcha-button" onclick="captcha()">刷新驗證碼</button>
                    <button class="btn btn-primary" id="login-button" onclick="login()">登入</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="jquery.js"></script>
<script src="bootstrap.js"></script>
<script src="js.js"></script>
<script>
    $("form").on("submit",function (e) {
        e.preventDefault()
        const form = {
            action: "response",
            name: $("#name").val(),
            mail: $("#email").val(),
            note: $("#note").val(),
            time: new Date().toISOString()
        }
        $.post("api/add.php",form,function (res) {
            alert(res)
        })
    })
</script>