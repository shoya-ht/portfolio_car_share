<?php
session_start();

if(isset($_SESSION['user']['id'])&& $_SESSION['time']+3600>time()){
    $_SESSION['time']=time();
  }else{
    header('Location:../index.php');
    exit();
  }

if(!empty($_POST)){
    if($_POST['kind']===''){
        $error['kind']='blank';
    }
    if($_POST['size']===''){
        $error['size']='blank';
    }
    if($_POST['area']===''){
        $error['area']='blank';
    }
    if(empty($error)){
        $_SESSION['mycar']=$_POST;
        header('Location:check.php');
        exit();
    }
}

if(isset($_REQUEST['action'])){
    $_POST=$_SESSION['mycar'];
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
            <h1>車の登録</h1>
        </div>
        <p>車を登録します。全項目必須です。</p>
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputKind">車種</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="InputKind" placeholder="車種" type="text" name="kind" 
                        size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['kind'],ENT_QUOTES)); ?>" required>
                        <?php if($error['kind']==='blank'):?>
                            <p>※車種名を入力してください</p>
                        <?php endif;?>
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
                <?php if($error['size']==='blank'):?>
                    <p>※ボディータイプを指定してください</p>
                <?php endif;?>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="InputArea">エリア</label>
                <div class="col-sm-10">
                    <select class="form-control" id="InputArea" name="area" size="1">
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
        <div class="col">
            <img src="../car.png" class="w-50" alt="car_image">
        </div>
    </div>
</div>

<script src="../js/jquery-3.6.0.js"></script>
<script src="../js/bootstrap.js"></script>    
    </body>
</html>