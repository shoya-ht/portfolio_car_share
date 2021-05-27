<?php
session_start();
require('../dbconnect.php');

if(!empty($_POST)){
    $email=$_POST['email'];
    if($_POST['email'] !=='' && $_POST['password'] !==''){
        $login=$db->prepare('SELECT * FROM users WHERE email=? AND password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $user=$login->fetch();
        if($user){
            $_SESSION['user']['id']=$user['id'];
            $_SESSION['user']['name']=$user['name'];
            $_SESSION['user']['email']=$user['email'];
            $_SESSION['time']=time();
            header('Location:../mypage.php');
            exit();
        }else{
            $error['login']='failed';
        }        
    }else{
        $error['login']='blank';
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">   
        <link rel="stylesheet" href="../css/bootstrap.css">
        <title>ログイン|C to C カーシェア</title>
    </head>
    <body>
    <div class="jumbotron text-center box01">
        <h1>ログイン画面</h1>
    </div>
        <p>メールアドレスとパスワードを入力してログインしてください。</p>
        <?php if($error['login']==='blank'):?>
            <p>※メールアドレスとパスワードを入力してください</p>
        <?php endif;?>
        <?php if($error['login']==='failed'):?>
            <p>※ログインに失敗しました。再度入力してください</p>
        <?PHP endif;?>
        <form action="" method="post">
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="email" size="50" maxlength="60">
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20">
                </dd>
            </dl>
            <input type="submit" value="ログインする">
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