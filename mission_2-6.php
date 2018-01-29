<html>
<head>
<meta charset="UTF-8">
<title>mission_2-6</title>
</head>
<body>
<h1>mission_2-6</h1>

<?php
$name = $_POST["name"];
$comment = $_POST["comment"];
$pass = $_POST["pass"];
$d_num= $_POST["d_num"];
$e_num= $_POST["e_num"];
$pass_in  = $_POST["pass_in"];

/*全削除*/
$clear=$_POST["clear"];
if($clear==31415926535){
$fp_c = fopen("kadai2.txt", "w");
fclose($fp_c);}
/******/

if($pass && empty($e_num))
  {
  $fp_r = fopen("kadai2.txt", "r");
  for( $count = 0; fgets( $fp_r ); $count++ );
  fclose($fp_r);
  $fp_w = fopen("kadai2.txt", "a");
  fputs($fp_w, $count."<>".$name."<>".$comment."<>".date('Y/m/d(D) H:i:s')."<>".$pass."\n");
  fclose($fp_w);
  }
  
 else if( (empty($pass) && !empty($name) && empty($e_num)) || (empty($pass) && !empty($comment) && empty($e_num)) )
	{echo "Passを入力してください";}
if ($d_num)
{//
	$fp_d1=fopen("kadai2.txt","r");
	$i=0;
	while($line = fgets($fp_d1)) 
	{
	list($num, $nam, $com, $tim, $pass) = explode("<>", trim($line)); 
	$number_d[$i]=$num; $name_d[$i]=$nam; $pass_d[$i]=$pass; $comment_d[$i]=$com; $time_d[$i]=$tim;
	$i=$i+1;
	}
	fclose($fp_d1);
	if($pass_in==$pass_d[$d_num]){
	$fp_d2=fopen("kadai2.txt","w+");
	for($j=0;$j<$i;$j++) 
	{
	if($j<$d_num)
		{fputs($fp_d2,$j."<>".$name_d[$j]."<>".$comment_d[$j]."<>".$time_d[$j]."<>".$pass_d[$j]."\n");}
	else if($j>$d_num)
		{$k=$j-1;
		fputs($fp_d2,$k."<>".$name_d[$j]."<>".$comment_d[$j]."<>".$time_d[$j]."<>".$pass_d[$j]."\n");}
	}
	fclose($fp_d2);}else{echo "No password!";} 
}//
else if ($e_num)
{
	$fp_e=fopen("kadai2.txt","r");
	$i=0;
	while($line = fgets($fp_e)) 
	{
	list($num, $nam, $com, $tim, $pas) = explode("<>", trim($line)); 
	$number_e[$i]=$num; $name_e[$i]=$nam; $pass_e[$i]=$pas; $comment_e[$i]=$com; $time_e[$i]=$tim;$i=$i+1;
	}
	fclose($fp_e);
	
	if($pass_in == $pass_e[$e_num])
	{/*+++*/
	$name_E = $_POST["name"];
	$comment_E = $_POST["comment"];
	$e_num= $_POST["e_num"];
	$fp_e=fopen("kadai2.txt","r");
	$i=0;
	while($line = fgets($fp_e)) 
	{
	list($num, $nam, $com, $tim, $pas) = explode("<>", trim($line)); 
	$number_e[$i]=$num; $name_e[$i]=$nam; $pass_e[$i]=$pas; $comment_e[$i]=$com; $time_e[$i]=$tim;
	$i=$i+1;
	}
	fclose($fp_e);
	
	$fp_e2=fopen("kadai2.txt","w");
	for($j=0;$j<$i;$j++) 
	{//
	if($number_e[$j]!=$e_num){
	fputs($fp_e2,$number_e[$j]."<>".$name_e[$j]."<>".$comment_e[$j]."<>".$time_e[$j]."<>".$pass_e[$j]."\n");}
	else
	{fputs($fp_e2,$number_e[$j]."<>".$name_E."<>".$comment_E."<>".$time_e[$j]."<>".$pass_e[$j]."\n");}
	}//
	fclose($fp_e2);}
	else{echo "No password!";}
} /*+++*///
?>
<form method="post" action="">
<INPUT TYPE = 'hidden' name = "e_num" SIZE = '40' value = "<?php echo $e_num;?>">
お名前:<INPUT TYPE = 'text' name = 'name' SIZE = '40' value = "<?php echo $name_e[$e_num];?>"><BR>
コメント:<INPUT TYPE = 'text' name = 'comment' SIZE = '40' value = "<?php echo $comment_e[$e_num];?>"><BR>
パスワード:<input type="password" name="pass" size="40" value = "<?php echo $pass_e[$e_num];?>"><BR>
※削除対象番号:<input type="text" name="d_num" size="40"><BR>
※編集対象番号:<input type="text" name="e_num" size="40" value = "<?php echo $e_num;?>"><BR>
※削除・編集用パスワード:<input type="password" name="pass_in" size="40" ><BR>
※クリア:<input type="text" name="clear" size="40"><BR>
<input type="submit" value="送信">
</form>
<?php
	$fp=fopen("kadai2.txt","r");
	$i=0;
	while($line = fgets($fp)) 
	{
	list($num, $nam, $com, $tim, $pass) = explode("<>", trim($line)); 
	echo $num .":" .$nam ."(" . $tim .")";
	?><BR>
	<?php
	echo $com;
	?><BR>
	<?php
	$i=$i+1;
	}
	fclose($fp);
?>
</body>
</html>