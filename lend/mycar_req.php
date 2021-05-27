<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }
  
if(isset($_GET['car'])){
    $car=$_GET['car'];
    $_SESSION['car']=$car;
}

//ページ変更時
if(isset($_SESSION['car'])){
    $car=$_SESSION['car'];
}

$car_db=$db->prepare('SELECT count(*) AS cnt FROM requests WHERE car_id=?');
$car_db->execute(array($car));
$cnt=$car_db->fetch();

$page=$_REQUEST['page'];
if($page ==''){
    $page=1;
}
$page=max($page,1);

$max_page=ceil($cnt['cnt']/5); 
$page=min($page,$max_page);
$start=($page-1)*5;
$requests=$db->prepare('SELECT * FROM requests WHERE car_id=? ORDER BY start_date DESC LIMIT ?,5');
$requests->bindParam(1,$car,PDO::PARAM_INT);
$requests->bindParam(2,$start,PDO::PARAM_INT);
$requests->execute();
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
    <h1>リクエスト一覧</h1>
</div>
<p>登録した車へのリクエストがあれば表示します</p>

<div class="container">
<table class="table">
    <thead>
        <tr>
            <th>リクエスト番号</th>
            <th>開始時間</th>
            <th>終了時間</th>
            <th>メッセージ</th>
            <th>ステイタス</th>
            <th>回答</th>
            <th>チャット</th>
        </tr>
</thead>
<tbody>
    <?php foreach($requests as $request): ?>
        <tr>
        <th scope="row"><?php print(htmlspecialchars($request['id'],ENT_QUOTES));?></th>
        <td>
            <?php print(htmlspecialchars($request['start_date'],ENT_QUOTES));?>
            <?php print(htmlspecialchars($request['start_time'],ENT_QUOTES));?>
        </td>
        <td>
            <?php print(htmlspecialchars($request['fin_date'],ENT_QUOTES));?>
            <?php print(htmlspecialchars($request['fin_time'],ENT_QUOTES));?>
        </td>
        <td><?php print(htmlspecialchars($request['message'],ENT_QUOTES));?></td>
        <td>
            <?php 
            if($request['reply']==='0'){
                print('未回答');
            }elseif($request['reply']==='1'){
                print('承認済');
            }else{
                print('拒否済');
            };?>
        </td>
        <td><a href="reply.php?request=<?php print($request['id']);?>">こちらへ</a></td>
        <td><a href="../chat?id=<?php print($request['id']);?>">こちらへ</a>
        
        </tr>
    <?php endforeach;?>
</tbody>
</table>
</div>

<div class="text-center">
    <?php if($page>1):?>
        <a href="mycar_req.php?page=<?php print($page-1);?>">前のページへ|</a>
    <?php else:?>
        前のページへ|
    <?php endif;?>

    <?php if($page<$max_page):?>
        <a href="mycar_req.php?page=<?php print($page+1); ?>">次のページへ</a>
    <?php else:?>
        次のページへ
    <?php endif; ?>
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