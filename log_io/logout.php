<?php
session_start();

session_destroy();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">   
        <link rel="stylesheet" href="../css/bootstrap.css">
        <title>ログアウト｜C to C カーシェア</title>
    </head>
    <body>
    <div class="jumbotron text-center box01">
        <h1>ログアウトしました</h1>
    </div>
    <div class="text-center">
        <a href="../">トップページへ</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <p>お問い合わせ先<br/>
                    株式会社〇〇<br/>
                    tel:123-1234-1234<br/>
                    address:○県○市○○
                </p>
            </div>
            <div class="col">
                <img src="../car.png" class="w-50" alt="car_image">
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.js"></script>    


    </body>
</html>