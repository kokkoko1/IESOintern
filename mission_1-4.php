<html>
<form action = 'http://co-676.99sv-coco.com/mission_1-4.php' method = 'post'>
Write!!:<input thpe = 'text' name = 'input'/>
 <input type="submit" />
</form>
</html>
input:<?php

echo htmlspecialchars($_POST['input']);

?>

