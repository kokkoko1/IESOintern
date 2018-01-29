<html>

<head>
<meta charset="UTF-8">
<title>2-12</title>
</head>

<body>

<?php
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= 'SELECT * FROM m15';//クエリ
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);//実行・結果取得
//出力

foreach($result as $row){
	echo $row['num'].', ';
	echo $row['name'].', ';
	echo $row['comment'].'<br>';
}
?>
</body>
</html>