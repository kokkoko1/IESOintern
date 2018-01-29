<html>
<head>
<meta charset="UTF-8">
<title>mission_2-15</title>
</head>
<body>
<h1>mission_2-15</h1>
<form method="post" action="">
<INPUT TYPE = 'hidden' name = "e_num" SIZE = '40' value = "<?php echo $e_num;?>">
</form>
<?php
//データ取得
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= 'SELECT * FROM m15';//クエリ
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);//実行・結果取得

foreach($result as $row){
	$row_num[$row['num']] =$row['num'];
	$row_name[$row['num']] =$row['name'];
	$row_pass[$row['num']] =$row['pass'];
	$row_date[$row['num']] =$row['date'];
	$row_comment[$row['num']] =$row['comment'];
	$edit_num = $_POST["e_num"];
}
?>

<form method="post" action="">
お名前:<INPUT TYPE = 'text' name = 'name' SIZE = '40' value = "<?php echo $row_name[$edit_num];?>"><BR>
コメント:<INPUT TYPE = 'text' name = 'comment' SIZE = '40' value = "<?php echo $row_comment[$edit_num];?>"><BR>
パスワード:<input type="password" name="pass" size="40" ><BR>
※削除対象番号:<input type="text" name="d_num" size="40"><BR>
※編集対象番号:<input type="text" name="e_num" size="40" value = "<?php echo $edit_num;?>"><BR>
※削除・編集用パスワード:<input type="password" name="pass_in" size="40" ><BR>
<input type="submit" value="送信">
</form>

<?php
$name = $_POST["name"];
$comment = $_POST["comment"];
$pass = $_POST["pass"];
$d_num= $_POST["d_num"];
$e_num= $_POST["e_num"];
$date=date("Y/m/d H:i:s");
$pass_in=$_POST['pass_in'];

//データ取得
$pdo= new PDO("mysql:dbname=dbname",'usr','pass');

$sql= 'SELECT * FROM m15';//クエリ
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);//実行・結果取得

foreach($result as $row){
	$row_num[$row['num']] =$row['num'];
	$row_name[$row['num']] =$row['name'];
	$row_pass[$row['num']] =$row['pass'];
	$row_date[$row['num']] =$row['date'];
	$row_comment[$row['num']] =$row['comment'];
}
//書き込み
if(!empty($pass) && empty($d_num) && empty($e_num))
  {
	$sql= $pdo -> prepare("INSERT INTO m15(name,comment,pass,date)
	VALUES (:name,:comment,:pass,:date)");
	$sql->bindParam(':name',$name,PDO::PARAM_STR);
	$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
	$sql->bindParam(':pass',$pass,PDO::PARAM_STR);
	$sql->bindParam(':date',$date,PDO::PARAM_STR);
	$sql->execute();
  }
 else if( (empty($pass) && !empty($name) && empty($e_num)) || (empty($pass) && !empty($comment) && empty($e_num)) )
	{echo "Passを入力してください";}

//データ削除
if ($d_num)
{//
	if($row_pass[$d_num] == $pass_in){
		$sql= "delete from m15 where num=$d_num";
		$result = $pdo->query($sql);
		$result->execute();
}

	else{echo "wrong password(d)";}
}//

//データ編集
if($e_num){
if($pass_in ==$row_pass[$e_num]){
	$name = $_POST['name'];$comment = $_POST['comment'];
	$date = date("Y/m/d H:i:s");
	$sql= "update m15 set name='$name',comment='$comment',date='$date' where num=$e_num";
	$result = $pdo->query($sql);
}
else{echo "wrong password(e)<br>";}
 }
 
 /*クリア*/
 if($_POST['name']=="master" && $_POST['comment']=="drop"){
$sql = "DROP TABLE IF EXISTS m15";
$pdo -> exec($sql);
$sql= 'CREATE TABLE m15
	(num INT(3) AUTO_INCREMENT,
	name VARCHAR(10),
	comment VARCHAR(40),
	pass VARCHAR(10),
	date DATETIME,
	PRIMARY KEY(num)
	);';
$result = $pdo->query($sql);
}
//表示
$e_num = $_POST['e_num'];

$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= $sql="SELECT * FROM m15 ORDER BY num";;
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);

foreach($result as $row){
	echo $row['num'].':';
	echo $row['name'];
	echo '('.$row['pass'].')';
	echo '('.$row['date'].').<br>';
	echo $row['comment'].'<br>';
}
?>
</body>
</html>