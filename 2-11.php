<?php
//データ入力
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= $pdo->query('SET NAMES utf8');
$sql= $pdo -> prepare("INSERT INTO m15(name,comment,pass)
VALUES (:name,:comment,:pass)");
$sql->bindParam(':name',$name,PDO::PARAM_STR);// PDO::PARAM_STRは文字列
$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
$sql->bindParam(':pass',$pass,PDO::PARAM_STR);
$name = "";
$comment = "hoge";
$pass = "";

$sql->execute();
?>