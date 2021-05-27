<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>C to C カーシェア</title>
</head>
<body>
    <div class="jumbotron text-center box01">
        <h1>C to C カーシェア</h1>
        <p>
            個人間で車をシェアする、カーシェアサービスです<br/>
        </p>
    </div>
    
    <?php if(isset($_SESSION['user'])):?>
    <p class="text-right"><?php print(htmlspecialchars($_SESSION['user']['name'],ENT_QUOTES));?>様　ログイン中です<br/>
        <a href="log_io/logout.php">ログアウトする</a>
    </p>
    <p class="text-center">
        <a href="mypage.php">マイページはこちらから</a>
    </p>
    <?php else:?>
        <p>
        車を借りたい方も、貸したい方も、以下の会員登録またはログインからどうぞ<br/>
        <a href="account/register.php">会員登録はこちらから</a>
        <a href="log_io/login.php">ログインはこちらから</a>
    </p>
    
    <?php endif;?>
    <div class="container">
        <div class="row">
            <div class="col">
                <p>お問い合わせ先<br/>
                    株式会社〇〇<br/>
                    tel:123-1234-1234<br/>
                    address:○県○市○○
                </p>
            </div>
            <div class="col d-flex align-items-right">
                <img src="car.png" class="w-50" alt="car_image">
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>    
</body>
</html>