<html>
<head>
<meta charset="UTF-8">
<title>mission_2-4</title>
</head>
<body>
<h1>mission_2-2</h1>
<form method="post" action="">
<p>
お名前:<input type="text" name="name" size="40">
</p>
<p>
コメント:<input type="text" name="comment" size="40">
</p>
<p>
Passsword:<input type="text" name="pass" size="40">
</p>
<p>
※削除対象番号:<input type="text" name="del_num" size="40">
</p>
<p>
※編集対象番号:<input type="text" name="edi_num" size="40">
</p>
<input type="submit" value="送信">
</form>

<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$name = $_POST["name"];
$comment = $_POST["comment"];
$pass = $_POST["pass"];
$del_num= $_POST["del_num"];
$edi_num= $_POST["edi_num"];
if ($name || $comment ) 
{
if($pass){
  $fp_r = fopen("kadai2-2.txt", "r");
  for( $count = 1; fgets( $fp_r ); $count++ );
  fclose($fp_r);
  $fp_w = fopen("kadai2-2.txt", "a");
  fputs($fp_w, $count."<>".$name."<>".$comment."<>".date("G:i:s")."<>".$pass."\n");
  fclose($fp_w);}
  else{echo "Passを入力してください";}
}
if($del_num || $edi_num)
{
?>

<form method="post" action="">
Password?:<INPUT TYPE = 'text' name = 'pass_in' SIZE = '40'><BR>
<input type='submit' ><BR>
</form>

<?php
$pass_in = $_POST["pass_in"];
echo $pass;
if($pass)
{
if($pass!=$pass_in){echo "passが違います";}

else
{

if ($del_num) 
{///
	$fp_del1=fopen("kadai2-2.txt","r");
	$i=0;
	
	while($line = fgets($fp_del1)) 
	{
	list($num, $nam, $com, $tim, $pass) = explode("<>", $line); 
	$i=$i+1;
	$number_d[]=$num;
	$name_d[]=$nam;
	$pass_d[]=$pas;
	$comment_d[]=$com;
	$time_d[]=$tim;
	}
	
	fclose($fp_del1);
	$fp_del2=fopen("kadai2-2.txt","w+");
	
	for($j=0;$j<$i;$j++) 
	{
	if($number_d[$j]!=$del_num)
	{
	fputs($fp_del2,$number_d[$j]."<>".$name_d[$j]."<>".$comment_d[$j]."<>".$time_d[$j]."<>".$pass_d[$j]."\n");
	}
	
	}
	fclose($fp_del2);
}///
if ($edi_num) 
{///
	$fp_edi1=fopen("kadai2-2.txt","r");
	$i=0;
	
	while($line = fgets($fp_edi1)) 
	{
	list($num, $nam, $com, $tim, $pas) = explode("<>", $line); 
	$i=$i+1;
	$number_e[]=$num;
	$name_e[]=$nam;
	$pass_e[]=$pas;
	$comment_e[]=$com;
	$time_e[]=$tim;
	}
	
	fclose($fp_edi1);
	
	echo "<INPUT TYPE = 'hidden' name = 'edi_num' SIZE = '40' value = '".$edi_num."'><BR>";
	echo "お名前:<INPUT TYPE = 'text' name = 'name' SIZE = '40' value = '".$name_e[$edi_num]."'><BR>";
	echo "コメント:<INPUT TYPE = 'text' name = 'comment' SIZE = '40' value = '".$comment_e[$edi_num]."'><BR>";
	
	
	$name_E = $_POST["name"];
	$comment_E = $_POST["next"];
	$edi_num= $_POST["edi_num"];
	
	$fp_edi2=fopen("kadai2-2.txt","w+");
	for($j=0;$j<$i;$j++) 
	{//
	
	if($number_e[$j]!=$edi_num)
	{
	fputs($fp_del2,$number_e[$j]."<>".$name_e[$j]."<>".$comment_e[$j]."<>".$time_e[$j]."<>".$pass_e[$j]."\n");
	}
	
	else
	{
	fputs($fp_del2,$number_e[$j]."<>".$name_E."<>".$comment_E."<>".$time_e[$j]."<>".$pass_e[$j]."\n");
	}
	
	}//
	fclose($fp_edi2);
}///

}
}
}
?>

</body>
</html>