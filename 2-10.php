<?php
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');

$stmt= $pdo->query('SET NAMES utf8');

$stmt= $pdo->query('SHOW CREATE TABLE test');
foreach($stmt as $re){
	print_r($re);
}//
?>