<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }


//2回アクセス時
if(!empty($_POST)){
    if($_POST['message']!==''){
        $message=$db->prepare('INSERT INTO posts SET from_member=?,message=?,
        to_member=?,request_id=?,created=NOW()');
        $message->execute(array(
            $_SESSION['user']['id'],
            $_POST['message'],
            $_POST['to_member_id'],
            $_SESSION['request']['id']
        ));
        header('Location:index.php');


    }
}

if(isset($_GET['id'])){
    $_SESSION['request']['id']=$_GET['id'];
}
$to_member_db=$db->prepare('SELECT * FROM requests WHERE id=?');
$to_member_db->execute(array(
    $_SESSION['request']['id']
));
$to_member=$to_member_db->fetch();

if(is_null($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}
//メッセージの取得
$posts_db=$db->prepare('SELECT count(*) AS cnt FROM posts WHERE request_id=?');
$posts_db->execute(array(
    $_SESSION['request']['id']
));
$cnt=$posts_db->fetch();
if($cnt['cnt']==='0'){
    $max_page=1;
}else{
    $max_page=ceil($cnt['cnt']/5);
}

$page=min($page,$max_page);
$start=($page-1)*5;
$posts=$db->prepare('SELECT * FROM posts WHERE request_id=? ORDER BY created DESC LIMIT ?,5');
$posts->bindParam(1,$_SESSION['request']['id'],PDO::PARAM_INT);
$posts->bindParam(2,$start,PDO::PARAM_INT);
$posts->execute();
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
        <h1>チャット機能</h1>
    </div>
    <p>リクエストしたユーザーとチャットすることができます。</p>
    <form action="" method="post">
        <!--定義-->
        <dl>
        <!--用語-->
        <dt><?php print(htmlspecialchars($_SESSION['user']['name'],ENT_QUOTES));?>
        さん、メッセージをどうぞ</dt>
        <!--用語の説明-->
        <dd>
            <textarea name="message" cols="50" rows="5"></textarea>
            <input type="hidden" name="to_member_id" value="<?php print(htmlspecialchars($to_member['to_user'],ENT_QUOTES));?>">
        </dd>
        </dl>
        <div>
        <p>
            <input type="submit" value="投稿する" />
        </p>
        </div>
    </form>
    <!--posts:全ての投稿-->
    <?php foreach($posts as $post): ?>
        <div>
        <p>メッセージ：<?php print(htmlspecialchars($post['message'],ENT_QUOTES));?></p>
        <p>送信元：<?php print(htmlspecialchars($post['member_id'],ENT_QUOTES));?></p>
        <p>日時：<?php print(htmlspecialchars($post['created'],ENT_QUOTES));?></p>
            
        </div>
    <?php endforeach; ?>
    <div class="text-center">
    <?php if($page>1):?>
    <a href="index.php?page=<?php print($page-1);?>">前のページへ|</a>
    <?php else:?>
    前のページへ|
    <?php endif;?>
    <?php if($page<$max_page):?>
    <a href="index.php?page=<?php print($page+1);?>">次のページへ</a>
    <?php else:?>
    次のページへ
    <?php endif;?>
    </div>
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