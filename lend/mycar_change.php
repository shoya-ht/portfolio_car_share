<?php
session_start();

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if(!empty($_POST)){
    if($_POST['kind'=='']){
        $error['kind']='blank';
    }
    if($_POST['size'=='']){
        $error['size']='blank';
    }
    if($_POST['area'=='']){
        $error['area']='blank';
    }
    if(empty($error)){
        $_SESSION['mycar']=$_POST;
        header('Location:update.php');
        exit();
    }
    
}
require('../dbconnect.php');
$car_id=$_GET['id'];
$car_db=$db->prepare('SELECT * from car_info WHERE id=?');
$car_db->execute(array($car_id));
$car=$car_db->fetch();
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
        <h1>編集画面</h1>
    </div>
    <form class="form-horizontal" action="" method="POST">
    <input type="hidden" name="id" value="<?php print(htmlspecialchars($car_id,ENT_QUOTES));?>">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputKind">車種</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="InputKind" type="text" name="kind" 
                        size="10" maxlength="20" value="<?php print(htmlspecialchars($car['kind'],ENT_QUOTES));?>" required>
                        <?php if($error['kind']==='blank'):?>
                            <p>※車種名を入力してください</p>
                        <?php endif;?>
                    </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputSize">ボディータイプ</label>
                <div class="col-sm-10">
                    <select class="form-control" id="InputSize" name="size" size="1" value=<?php print(htmlspecialchars($car['size'],ENT_QUOTES));?>>
                        <option value="">ボディータイプを選択</option>
                        <option value="SUV">SUV</option>
                        <option value="ミニバン">ミニバン</option>
                        <option value="ステーションワゴン">ステーションワゴン</option>
                        <option value="クーペ">クーペ</option>
                        <option value="ハッチバック">ハッチバック</option>
                        <option value="セダン">セダン</option>
                     </select>
                </div>
                <?php if($error['size']==='blank'):?>
                    <p>※ボディータイプを指定してください</p>
                <?php endif;?>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputArea">エリア</label>
                <div class="col-sm-10">
                    <select class="form-control" id="InputArea" name="area" size="1" value=<?php print(htmlspecialchars($car['area'],ENT_QUOTES));?>>
                        <option value="">エリアを選択</option>
                        <option value="那覇市">那覇市</option>
                        <option value="浦添市">浦添市</option>
                        <option value="宜野湾市">宜野湾市</option>
                    </select>
                </div>
                <?php if($error['area']==='blank'):?>
                    <p>※エリアを指定してください</p>
                <?php endif;?>
            </div>
            <button type="submit" class="btn btn-primary btn-lg active">確認画面へ進む</button>
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