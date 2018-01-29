<?php
//データ削除
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
// 更新する値と該当のIDは空のまま、SQL実行の準備をする
$num =3;
$sql= "delete from test where num=$num";
$result = $pdo->query($sql);
?>