<?php 
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if($_SESSION['car']['kind']!==''){
    $kind=$_SESSION['car']['kind'];
}
$size=$_SESSION['car']['size'];
$area=$_SESSION['car']['area'];
$start_date=$_SESSION['car']['start_date'];
$start_time=$_SESSION['car']['start_time'];
$fin_date=$_SESSION['car']['fin_date'];
$fin_time=$_SESSION['car']['fin_time'];


if($_POST['count']==1){
        
        $statement=$db->prepare('INSERT INTO requests SET from_user=?,to_user=?,
        car_id=?,start_date=?,start_time=?,fin_date=?,fin_time=?,message=?');
    $statement->execute(array(
        $_SESSION['user']['id'],$_POST['car_user'],$_POST['car_id'],
        $start_date,$start_time,$fin_date,$fin_time,$_POST['message']
    ));
    $statement=$statement->fetchall();
    $_SESSION=$_POST['message'];
    header('Location:thanks.php');
}

$statement=$db->prepare('SELECT * FROM car_info WHERE id=?');
$statement->execute(array(
    $_GET['car_id']
));
$car=$statement->fetch();
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
        <h1>リクエストの確認</h1>
    </div>
        開始日時<br/>
        <?php print($start_date);?>
        <?php print($start_time);?><br/>
        終了日時<br/>
        <?php print($fin_date);?>
        <?php print($fin_time);?><br/>
        車種<br/>
        <?php print($car['kind']);?><br/>
        ボディータイプ<br/>
        <?php print($car['size']);?><br/>
        エリア<br/>
        <?php print($car['area']);?><br/>
        メッセージ<br/>
        <form method="POST" action="">
            <input type="text" name="message" size="25" maxlength="100">
            <input type="hidden" name="car_id" value="<?php print($car['id']);?>">
            <input type="hidden" name="car_user" value="<?php print($car['user_id']);?>">
            <input type="hidden" name="count" value="1"><br/>
            <input type="submit" value="リクエストの送信">
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