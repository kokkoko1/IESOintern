<?php
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');

$stmt= $pdo->query('SET NAMES utf8');

$stmt= $pdo->query('SHOW TABLES');
foreach($stmt as $re){
	echo $re[0];
	echo '<br>';
}
?>