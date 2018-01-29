<?php
//データ編集
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
// 更新する値と該当のIDは空のまま、SQL実行の準備をする
$num = 1;
$name = "もみじ";
$comment ="huga";
$sql= "update m15 set name='$name',comment='$comment' where num = $num";
$result = $pdo->query($sql);
?>