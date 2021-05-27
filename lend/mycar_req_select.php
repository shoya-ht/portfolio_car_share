<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }
  
$statemtent=$db->prepare("SELECT * FROM car_info WHERE user_id=?");
$statemtent->execute(array(
    $_SESSION['user']['id']
));
$cars=$statemtent->fetchall();

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
    <h1>表示する車種を選んでください</h1>
</div>
    <form class="form-horizontal" action="mycar_req.php" method="GET">
        

        <?php foreach($cars as $car):?>
            <label class="radio-inline">
                <input type="radio" name="car" value="<?php print($car['id']);?>">
                <?php print($car['kind']);?>
            </label>
        <?php endforeach;?>
        <input type="submit" value="選択">
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