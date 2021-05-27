<?php
session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

$statement=$db->prepare('SELECT * FROM requests WHERE from_user=?');
$statement->execute(array(
    $_SESSION['user']['id']
));
$requests=$statement->fetchall();
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
        <h1>送信したリクエスト一覧</h1>
    </div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>リクエスト番号</th>
                <th>貸主</th>
                <th>ボディータイプ</th>
                <th>エリア</th>
                <th>車種</th>
                <th>利用開始日時</th>
                <th>利用終了日時</th>
                <th>メッセージ</th>
                <th>回答</th>
                <th>チャット</th>
            </tr>
            </thead>            
            <tbody>
                <?php foreach($requests as $request):?>
                    <?php 
                    $statement=$db->prepare('SELECT * FROM car_info WHERE id=?');
                    $statement->execute(array($request['car_id']));
                    $car=$statement->fetch();
                    ?>
                    <tr>
                        <th scope="row"><?php print(htmlspecialchars($request['id'],ENT_QUOTES));?></th>
                        <td><?php print(htmlspecialchars($request['from_user'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($car['size'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($car['area'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($car['kind'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($request['start_date'],ENT_QUOTES));?></br>
                            <?php print(htmlspecialchars($request['start_time'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($request['fin_date'],ENT_QUOTES));?></br>
                            <?php print(htmlspecialchars($request['fin_time'],ENT_QUOTES));?></td>
                        <td><?php print(htmlspecialchars($request['message'],ENT_QUOTES));?></td>
                        <td>
                            <?php
                            if($request['reply']==='0'){
                                print('未回答');
                            }elseif($request['reply']==='1'){
                                print('承認済');
                            }else{
                                print('拒否済');
                            }?>
                        </td>
                        <td><a href="../chat?id=<?php print($request['id']);?>">こちら</a></td>
                    </tr>
                <?php endforeach;?>
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