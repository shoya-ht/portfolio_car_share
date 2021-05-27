<?php
session_start();
require('../dbconnect.php');

if(!isset($_SESSION['account_regi'])){
    header('Location:index.php');
    exit();
}

if(!empty($_POST)){
    $statement=$db->prepare('INSERT INTO users SET name=?,password=?, email=?,phone=?,
    address=?,registered_at=NOW()');
    $statement->execute(array(
        $_SESSION['account_regi']['name'],
        sha1($_SESSION['account_regi']['password']),
        $_SESSION['account_regi']['email'],
        $_SESSION['account_regi']['phone'],
        $_SESSION['account_regi']['address']
    ));
    unset($_SESSION['account_regi']);

    header('Location:thanks.php');
    exit();
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
        <h1>会員登録</h1>
    </div>
        <p>ご記入された内容をご確認ください。</p>
        
        <form class="form-horizontal" action="" method="POST">
            <input type="hidden" name="action" value="for2Times">
        <div class="form-group">
            <label class="col-sm-2 control-label">氏名</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['account_regi']['name'],ENT_QUOTES)); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">メールアドレス</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['account_regi']['email'],ENT_QUOTES)); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">パスワード</label>
            <div class="col-sm-10">
                ※※※パスワードはセキュリティ保護のため表示しません※※※
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">電話番号（ハイフン（-）無し）</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['account_regi']['phone'],ENT_QUOTES)); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">住所</label>
            <div class="col-sm-10">
                <?php print(htmlspecialchars($_SESSION['account_regi']['address'],ENT_QUOTES)); ?>
            </div>
        </div>
        <a href="register.php?action=rewrite">書き直す</a>|<input type="submit" value="登録する">
    </form>
    
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