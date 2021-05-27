<?php 

session_start();
require('../dbconnect.php');

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if(!isset($_SESSION['car'])){
    header('Location:find_car.php');
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


$sql='SELECT * FROM car_info WHERE size=? AND area=?';
$data=[$size,$area];

if($kind !=''){
    $sql .= 'AND kind LIKE ?';
    $data[] = '%'.$kind.'%';
}
$cars_db=$db->prepare($sql);
$cars_db->execute($data);
$cars=$cars_db->fetchall();

if($_GET['action']==='rewrite' && isset($_SESSION['find_car'])){
    $_POST=$_SESSION['find_car'];
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
        <h1>検索結果一覧</h1>
    </div>
    <div class="text-center">
        <p>利用開始日時
            <?php print($start_date);?>
            <?php print($start_time);?><br/>
            利用終了日時
            <?php print($fin_date);?>
            <?php print($fin_time);?>
            </p>
    </div>
    <?php if(isset($cars)):?>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>車種</th>
                        <th>ボディータイプ</th>
                        <th>エリア</th>
                        <th>リクエストする</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cars as $car):?>
                        <tr>
                            <th><?php print($car['kind']);?></th>
                            <th><?php print($car['size']);?></th>
                            <th><?php print($car['area']);?></th>
                            <th><a href="request.php?car_id=<?php print($car['id']);?>">こちら</a>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            </div>
    <?php else:?>
        <p>お探しの車は見つかりませんでした</p>
    <?php endif;?>
    <div class="text-center">
        <input type="button" onclick="history.back()" value="戻る"><br/>
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