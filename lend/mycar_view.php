<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }
  
$cars_db=$db->prepare('SELECT * FROM car_info WHERE user_id=?');
$cars_db->execute(array(
$_SESSION['user']['id']
));
$cars=$cars_db->fetchall();
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
    <h1>登録済みの車</h1>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>登録番号</th>
                <th>車のボディータイプ</th>
                <th>車の車種</th>
                <th>エリア</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($cars as $car):?>
        <tr>
            <th scope="row"><?php print(htmlspecialchars($car['id'],ENT_QUOTES));?></th>
            <td><?php print(htmlspecialchars($car['size'],ENT_QUOTES));?></td>
            <td><?php print(htmlspecialchars($car['kind'],ENT_QUOTES));?></td>
            <td><?php print(htmlspecialchars($car['area'],ENT_QUOTES));?></td>
            <td><a href="mycar_change.php?id=<?php print($car['id']);?>">こちら</a></th>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
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