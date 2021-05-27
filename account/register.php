<?php
session_start();
require('../dbconnect.php');

if(!empty($_POST)){
    if($_POST['name']===''){
        $error['name']='blank';
    }
    if($_POST['email']===''){
        $error['email']='blank';
    }
    if($_POST['password']===''){
        $error['password']='blank';
    }
    if($_POST['phone']!==''){
        if(preg_match('/^\d{11}$/',$_POST['phone'])==0){
            $error['phone']='wrong';
        }
    }
    // if($_POST['email']!==''){
    //     if(preg_match('/^([^@\s]+)@(([-a-z0-9]+\.)+[a-z]{2,})$/i',$_POST['email'])==0){
    //         $error['email']='wrong';
    //     }
    // }

    if(empty($error)){
        $member=$db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email=?');
            $member->execute(array($_POST['email']));
            $record=$member->fetch();
            if($record['cnt']>0){
                $error['email']='duplicate';
            }
        
    }
    if(empty($error)){
        $_SESSION['account_regi']=$_POST;
        header('Location:check.php');
        exit();
    }
}

//チェック画面から戻った場合
if($_REQUEST['action']=='rewrite' && isset($_SESSION['account_regi'])){
    $_POST=$_SESSION['account_regi'];
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
        <p>次のフォームに必要事項をご記入ください。</p>
        <form class="form-horiontal" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputName">氏名</label>
                <div class="col-sm-10">
                    <input class="form-control" id="InputName" placeholder="氏名" type="text" name="name" size="20" maxlength="30"
                    value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES));?>">
                    <?php if($error['name']==='blank'):?>
                        <p>※氏名を入力してください</p>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputEmail">メールアドレス</label>
                <div class="col-sm-10">
                    <input class="form-control" id="InputEmail" type="email" name="email" size="50" maxlength="60"
                    value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES));?>">
                
                    <?php if($error['email']==='blank'):?>
                        <p>※メールアドレスを入力してください</p>
                    <?php endif;?>
                    <?php if($error['email']=='duplicate'):?>
                        <p>※指定されたメールアドレスはすでに登録されています<p>
                            <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <label class="con-sm-2 control-label" for="InputPassword">パスワード</label>
                <div class="col-sm-10">
                    <input class="form-control" id="InputPassword"type="password" name="password" size="10" maxlength="20"
                value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES));?>">
                <?php if($error['password']==='blank'):?>
                    <p>※パスワードを入力してください</p>
                <?php endif;?>
                
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputPhone">電話番号（ハイフン（-）無し）</label>
                <div class="col-sm-10">
                    <input class="form-control" id="InputPhone" type="text" name="phone" size="11" maxlength="11"
                value="<?php print(htmlspecialchars($_POST['phone'],ENT_QUOTES));?>">
                <?php if($error['phone']=='wrong'):?>
                    <p>※電話番号を正しく入力してください<p>
                        <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputAddress">住所</label>
                <div class="col-sm-10">
                    <input class="form-control" id="InputAddress" type="text" name="address" size="50" maxlength="100"
                value="<?php print(htmlspecialchars($_POST['address'],ENT_QUOTES));?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg active">入力内容を確認する</button>
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