<?php
try{
    $db=new PDO('mysql:dbname=heroku_be40848682bffc8;host=us-cdbr-east-03.cleardb.com;charset=utf8','b4ac81ae85b20f','b75bfb31');
    //$db=new PDO('mysql:dbname=portfolio_car_share;host=127.0.0.1;port=8889;charset=utf8','root','root');
}catch(PDOException $e){
    print('DB接続エラー:'.$e->getMessage());
}
?>