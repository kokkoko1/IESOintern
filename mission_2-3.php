<html>

<head>
<meta charset="UTF-8">
<title>misssion_2-3</title>
</head>

<body>

<?php

$file_r= fopen("kadai2-2.txt", "r");//
while ($line = fgets($file_r)) 
{
	
	list($num, $nam, $com, $tim) = explode("<>", $line); 
	echo $num.":".$nam."「".$com."」[".$tim."]";
	print "<br>";
}
fclose($file_r);

?>

</body>
</html>