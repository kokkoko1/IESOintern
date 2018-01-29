<?php
$filename = 'kadai2.txt';

$fp = fopen($filename, 'w');

fwrite($fp, 'test');

fclose($fp);

?>