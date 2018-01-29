<html>
<form action = '' method = 'post'>
Write!!:<input thpe = 'text' name = 'input'/>
 <input type="submit" />
</form>
</html>
input:<?php

$filename = 'kadai1-5.txt';

$fp = fopen($filename, 'w');

fwrite($fp, $_POST['input']);

fclose($fp);

?>

