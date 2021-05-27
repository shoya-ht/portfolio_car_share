<?php
session_start();

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if($_SESSION['car']['kind']!==''){
    $kind=$_SESSION['car']['kind'];
}
if($_SESSION['car']['message']!==''){
    $message=$_SESSION['car']['message'];
}
$name=$_SESSION['user']['name'];
$size=$_SESSION['car']['size'];
$area=$_SESSION['car']['area'];
$start_date=$_SESSION['car']['start_date'];
$start_time=$_SESSION['car']['start_time'];
$fin_date=$_SESSION['car']['fin_date'];
$fin_time=$_SESSION['car']['fin_time'];
unset($_SESSION['car']);
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
        <h1>リクエストを送信しました</h1>
    </div>

 <?php
// $honbun="リクエストありがとうございます。\n";
// $honbun.=$name."様\n\nこの度はリクエストありがとうございました。\n";
// $honbun.="\n";
// $honbun.="リクエスト内容\n";
// $honbun.="利用開始日時：".$start_date."\n";
// $honbun.=$start_time."\n";
// $honbun.="利用終了日時：".$fin_date."\n";
// $honbun.=$fin_time."\n";
// $honbun.="車種：".$kind."\n";
// $honbun.="ボディータイプ：".$size."\n";
// $honbun.="エリア：".$area."\n";
// $honbun.="メッセージ：".$message."\n";
// $honbun.="登録内容をご確認ください。\n";
// $honbun.="\n";
// $honbun.="お問い合わせ先\n";
// $honbun.="株式会社〇〇\n";
// $honbun.="tel:123-1234-1234\n";
// $honbun.="address:○県○市○○";

// $title='ご登録ありがとうございます。';
// $header='From:info@car_sharetst.co.jp';
// $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
// mb_lanbuage('Japanese');
// mb_internal_encoding('UTF-8');
// mb_send_mail($email,$title,$honbun,$header);

?>

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