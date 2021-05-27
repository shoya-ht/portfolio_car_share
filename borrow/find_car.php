<?php
session_start();

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if(!empty($_POST)){
    if($_POST['size']==''){
        $error='blank';
    }
    if($_POST['area']==''){
        $error='blank';
    }
    if($_POST['start_date']==''){
        $error='blank';
    }
    if($_POST['start_time']==''){
        $error='blank';
    }
    if($_POST['fin_date']==''){
        $error='blank';
    }
    if($_POST['fin_time']==''){
        $error='blank';
    }
    if($_POST['start_date']>$_POST['fin_date']){
        $error='time_miss';
    }elseif($_POST['start_date']===$_POST['fin_date'] && $_POST['start_time']>$_POST['fin_time']){
        $error='time_miss';
    }
    
    if(empty($error)){
        $_SESSION['car']=$_POST;
        header('Location:car_view.php');
        exit();
    }
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
            <h1>車の検索</h1>
        </div>
        <p>お好きな車をお選びください</p>
        <h3>
            検索フォーム<br/>
            車種を除き記載必須<br/>
        </h3>
        <?php if(!empty($_POST)):?>
            <?php if($error='blank'):?>
                    <p>※未入力欄が見つかりました。</br>
                        再度入力してください。</p>
            <?php endif;?>
        <?php endif;?>
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputKind">車種</label>
                <div class="col-sm-10">
                    <input type="text" class="form-cotrol" id="InputKind" placeholder="車種" 
                    name="kind"  size="25" maxlength="25">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputSize">ボディータイプ</label>
                <div class="col-sm-10">
                <select class="form-control" id="InputSize" name="size" size="1">
                    <option value="">ボディータイプを選択</option>
                    <option value="SUV">SUV</option>
                    <option value="ミニバン">ミニバン</option>
                    <option value="ステーションワゴン">ステーションワゴン</option>
                    <option value="クーペ">クーペ</option>
                    <option value="ハッチバック">ハッチバック</option>
                    <option value="セダン">セダン</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputArea">エリア</label>
                <div class="col-sm-10">
                    <select class="form-control" id="InputArea" 
                    name="area" size="1">
                        <option value="">エリアを選択</option>
                        <option value="那覇市">那覇市</option>
                        <option value="浦添市">浦添市</option>
                        <option value="宜野湾市">宜野湾市</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputStart">利用開始日時</label>
                <div class="col-sm-3">
                    <input class="form-control" id="InputStart" type="date" name="start_date">
                    <input class="form-control" id="InputStart" type="time" name="start_time">
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputFin">利用終了日時</label>
                <div class="col-sm-3">
                    <input class="form-control" id="InputFin" type="date" name="fin_date">
                    <input class="form-control" id="InputFIn" type="time" name="fin_time">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg active">検索する</button>
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