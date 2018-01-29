<?php
$fp = fopen('kadai2.txt', 'r');

echo fgets($fp);

fclose($fp);
//1-2 で保存したテキストファイルをPHPで開き、中身を読み込んで、ブラウザで表示させる
?>