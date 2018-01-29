<html>

<head>
<meta charset="UTF-8">
<title>misssion_1-7</title>
</head>

<body>


<?php
/*
$file_w = fopen('kadai7.txt', 'a');
fwrite($file_w, $_POST["name"].":".$_POST["comment"]."\n");
fclose($file_w);
*/
$file_r= fopen('kadai6.txt', 'r');
if("input" !=NULL){
	while ($line = fgets($file_r)) 
	{
	  echo "$line";
	  print "<br>";
	}
}
fclose($file_r);

?>

</body>
</html>