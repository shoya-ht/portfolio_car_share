<?php 
session_start();

//セッション確認、更新
if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:index.php');
    exit();
  }

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
            <h1>サービスを選んでください</h1>
        </div>
        <?php if(isset($_SESSION['user'])):?>
            <p class="text-right"><?php print(htmlspecialchars($_SESSION['user']['name'],ENT_QUOTES));?>様　ログイン中です<br/>
            <a href="log_io/logout.php">ログアウトする</a>
        </p>
        <?php endif;?>
        <h2 class="text-center">貸します</h2>
        <p class="text-center">
            <button type="button" onclick="location.href='/lend/mycar_regi.php'">保有している車の登録</button>
            <button type="button" onclick="location.href='/lend/mycar_view.php'">登録済みの車</button>
            <button type="button" onclick="location.href='/lend/mycar_req_select.php'">リクエスト一覧</button>
        </p>
        <h2 class="text-center">借ります</h2>
        <p class="text-center">
            <button type="button" onclick="location.href='/borrow/find_car.php'">車を検索</button>
            <button type="button" onclick="location.href='/borrow/my_request.php'">予約一覧</button>
        </p>
        

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
                    <img src="car.png" class="w-50" alt="car_image">
                </div>
            </div>
        </div>

        <script src="js/jquery-3.6.0.js"></script>
        <script src="js/bootstrap.js"></script>    
    </body>
</html>