<?php//テーブル作成
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= 'CREATE TABLE m15
	(num INT(3) AUTO_INCREMENT,
	name VARCHAR(10),
	comment VARCHAR(40),
	pass VARCHAR(10),
	date VARCHAR(20),
	PRIMARY KEY(num)
	);';
$result = $pdo->query($sql);
?>