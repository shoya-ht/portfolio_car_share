<?php
session_start();

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }
$name=$_SESSION['user']['name'];
$kind=$_SESSION['mycar']['kind'];
$size=$_SESSION['mycar']['size'];
$area=$_SESSION['mycar']['area'];
$email=$_SESSION['user']['email'];
unset($_SESSION['mycar']);
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
<p> 
    登録が完了しました<br/>
    <!-- <?php //print(htmlspecialchars($name,ENT_QUOTES));?>様へメールを送りましたのでご確認ください。<br/> -->
    車種名：<?php print(htmlspecialchars($kind,ENT_QUOTES));?><br/>
    ボディータイプ：<?php print(htmlspecialchars($size,ENT_QUOTES));?><br/>
    エリア：<?php print(htmlspecialchars($area,ENT_QUOTES));?><br/>
    <?php unset($_SESSION['mycar']);?>
</p>

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

<?php
// $honbun="ご登録ありがとうございます。\n";
// $honbun.=$name."様\n\nこの度はご登録ありがとうございました。\n";
// $honbun.="\n";
// $honbun.="登録内容\n";
// $honbun.="車種：".$kind."\n";
// $honbun.="ボディータイプ：".$size."\n";
// $honbun.="エリア：".$area."\n";
// $honbun.="登録内容をご確認ください。\n";
// $honbun.="\n";
// $honbun.="お問い合わせ先\n";
// $honbun.="株式会社〇〇\n";
// $honbun.="tel:123-1234-1234\n";
// $honbun.="address:○県○市○○";

// //print nl2br($honbun);

// $title='ご登録ありがとうございます。';
// $header='From:info@car_sharetst.co.jp';
// $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
// mb_lanbuage('Japanese');
// mb_internal_encoding('UTF-8');
// mb_send_mail($email,$title,$honbun,$header);

?>

<script src="../js/jquery-3.6.0.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>