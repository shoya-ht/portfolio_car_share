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
    $reply=0;
    if($_POST['reply']==='agree'){
        $reply=1;
    }elseif($_POST['reply']==='disagree'){
        $reply=2;
    }
    $statement=$db->prepare('UPDATE requests SET reply=? WHERE id=?');
    $statement->execute(array(
        $reply,$_POST['id']
    ));
    header('Location:thanks_request.php');
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
        <h1>リクエストへの回答</h1>
    </div>
        <form action="" method="post">
            <input type="radio" name="reply" value="agree">承諾する
            <input type="radio" name="reply" value="disagree">拒否する
            <input type="submit" value="送信">
            <input type="hidden" name="id" value=<?php print(htmlspecialchars($_GET['request'],ENT_QUOTES));?>>
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
            <div class="col">
                <img src="../car.png" class="w-50" alt="car_image">
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.js"></script>    
    </body>
</html>