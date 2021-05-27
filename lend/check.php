<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if(!empty($_POST)){
    $statement=$db->prepare('INSERT INTO car_info SET user_id=?,size=?,kind=?,area=?');
    $statement->execute(array(
        $_SESSION['user']['id'],
        $_SESSION['mycar']['size'],
        $_SESSION['mycar']['kind'],
        $_SESSION['mycar']['area']
    ));
    header('Location:thanks_car.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">   
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>C to C カーシェア</title>
</head>
<body>
    <div class="jumbotron text-center box01">
        <h1>車の登録</h1>
    </div>
    <p> 記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
    <form class="form-horizontal" action="" method="POST">
        <input type="hidden" name="action" value="submit">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="InputKind">車種</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['mycar']['kind'],ENT_QUOTES));?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Inputsize">サイズ</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['mycar']['size'],ENT_QUOTES));?>
            </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">エリア</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['mycar']['area'],ENT_QUOTES));?>
            </div>
        </div>
        <input type="button" onclick="history.back()" value="戻る">|
        <button type="submit" class="btn btn-primary btn-lg activ">登録する</button>
    </form>
    <div class="text-center">
        <a href="../mypage.php">マイページへ</a>   
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
            <div class="col d-flex align-items-right">
                <img src="../car.png" class="w-50" alt="car_image">
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    </body>
</html>