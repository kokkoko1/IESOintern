<html>
<head>
<meta charset="UTF-8">
<title>mission1-6</title>
</head>
<body>
<form method="post" action="">
<p>
お名前:<input type="text" name="name" size="40">
</p>
<p>
コメント:<input type="text" name="comment" size="40">
</p>
<input type="submit" value="送信">
</form>

<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
if ($name || $comment) {
  $fp = fopen('kadai6.txt', 'a');
  fputs($fp, $name.":".$comment."\n");
  fclose($fp);
}
?>

</body>
</html>