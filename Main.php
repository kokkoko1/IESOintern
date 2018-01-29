<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
?>

<html>
<head>
<meta charset="UTF-8">
<title>main</title>
</head>
<body>
<p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->

<form method="post" action="">
<INPUT TYPE = 'hidden' name = "e_num" SIZE = '40' value = "<?php echo $e_num;?>">
</form>
<?php
//表示
$e_num = $_POST['e_num'];

$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= 'SELECT * FROM m15';
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);

foreach($result as $row){
	echo $row['num'].':';
	echo $row['name'];
	echo '('.$row['pass'].')';
	echo '('.$row['date'].').<br>';
	echo $row['comment'].'<br>';
}

//データ取得
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
$sql= 'SELECT * FROM m15';//クエリ
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);//実行・結果取得

$i=0;
foreach($result as $row){
	$i=$i+1;//あとで行詰めしたい
	$row_num[$i] =$row['num'];
	$row_name[$i] =$row['name'];
	$row_pass[$i] =$row['pass'];
	$row_date[$i] =$row['date'];
	$row_comment[$i] =$row['comment'];
	echo '(('.$row['pass'].'))';
	echo '[['.$row_pass[$i].']]';
}
?>

<form method="post" action="">
コメント:<INPUT TYPE = 'text' name = 'comment' SIZE = '40' value = "<?php echo $row_comment[$e_num];?>"><BR>
※削除対象番号:<input type="text" name="d_num" size="40"><BR>
※編集対象番号:<input type="text" name="e_num" size="40" value = "<?php echo $e_num;?>"><BR>
※削除・編集用パスワード:<input type="password" name="pass_in" size="40" ><BR>
<input type="submit" value="送信">
</form>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <p><input type="file" name="upfile" id="upfile" accept="image/*" capture="camera" /></p>
    <p><input type="submit" name="save" value="保存" /></p>
</form>

<ul>
<li><a href="Logout.php">ログアウト</a></li>
</ul>

<?php
$name = $_SESSION["NAME"];
$comment = $_POST["comment"];
$d_num= $_POST["d_num"];
$e_num= $_POST["e_num"];
$date=date("Y/m/d H:i:s");
$pass_in=$_POST['pass_in'];

//ファイル保存
$file_name = $_FILES['upfile']['name'];
$uniq_file_name = date("YmdHis") . "_" . $file_name;
 
// 仮にファイルがアップロードされている場所のパスを取得
$tmp_path = $_FILES['upfile']['tmp_name'];
 
// 保存先のパスを設定
$upload_path = './upload/';
 
if (is_uploaded_file($tmp_path)) {
  // 仮のアップロード場所から保存先にファイルを移動
  if (move_uploaded_file($tmp_path, $upload_path . $uniq_file_name)) {
    // ファイルが読出可能になるようにアクセス権限を変更
    chmod($upload_path . $uniq_file_name, 0644);
 
    echo $file_name . "をアップロードしました。";
    echo "<br><a href='sample.html'><- TOPへ戻る</a>";
  } else {
    echo "Error:アップロードに失敗しました。";
  }
} else {
  echo "Error:画像が見つかりません。";
}
//データ取得
$pdo= new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');

$sql= 'SELECT * FROM m15';//クエリ
$result= $pdo->query('SET NAMES utf8');
$result = $pdo->query($sql);//実行・結果取得

$i=1;
foreach($result as $row){
	$i=$i+1;//あとで行詰めしたい
	$row_num[$i] =$row['num'];
	$row_name[$i] =$row['name'];
	$row_pass[$i] =$row['pass'];
	$row_date[$i] =$row['date'];
	$row_comment[$i] =$row['comment'];
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

//データ削除・行詰め
if ($d_num)
{//
	 echo $row_pass[$d_num+1].':'.$pass_in;
	if($row_pass[$d_num+1] == $pass_in){
		$sql= "delete from m15 where num=$d_num";
		$result = $pdo->query($sql);
		$result->execute();
}

	else{echo "wrong password(d)";}
}//

//データ編集
if($e_num){
if($pass_in ==$row_pass[$e_num+1]){
	$name = $_POST['name'];$comment = $_POST['comment'];
	$date = date("Y/m/d H:i:s");
	$sql= "update m15 set comment='$comment',date='$date' where num=$e_num";
	$result = $pdo->query($sql);
}
else{echo "wrong password(e)";}
 }
 
 /*クリア*/
 if($_POST['name']=="master" && $_POST['comment']=="drop"){
$sql = "DROP TABLE IF EXISTS m15";
$pdo -> exec($sql);
$sql= 'CREATE TABLE m15
	(num INT(3) AUTO_INCREMENT,
	name VARCHAR(20),
	comment VARCHAR(100),
	pass VARCHAR(100),
	date DATETIME,
	PRIMARY KEY(num)
	);';
$result = $pdo->query($sql);
}
//メディアデータの取り出しindex.php
try{
	$pdo = new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');

	//ファイルアップロードがあったとき
	if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error']) && $_FILES["upfile"]["name"] !== ""){
		//エラーチェック
		switch ($_FILES['upfile']['error']) {
		case UPLOAD_ERR_OK: // OK
			break;
		case UPLOAD_ERR_NO_FILE:   // 未選択
			throw new RuntimeException('ファイルが選択されていません', 400);
		case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
			throw new RuntimeException('ファイルサイズが大きすぎます', 400);
		default:
			throw new RuntimeException('その他のエラーが発生しました', 500);
	}

	 //画像・動画をバイナリデータにする．
	$raw_data = file_get_contents($_FILES['upfile']['tmp_name']);

            //拡張子を見る
            $tmp = pathinfo($_FILES["upfile"]["name"]);
            $extension = $tmp["extension"];
            if($extension === "jpg" || $extension === "jpeg" || $extension === "JPG" || $extension === "JPEG"){
                $extension = "jpeg";
            }
            elseif($extension === "png" || $extension === "PNG"){
                $extension = "png";
            }
            elseif($extension === "gif" || $extension === "GIF"){
                $extension = "gif";
            }
            elseif($extension === "mp4" || $extension === "MP4"){
                $extension = "mp4";
            }
            else{
                echo "非対応ファイルです．<br/>";
                echo ("<a href=\"Main.php\">戻る</a><br/>");
                exit(1);
            }

            //DBに格納するファイルネーム設定
            //サーバー側の一時的なファイルネームと取得時刻を結合した文字列にsha256をかける．
            $date = getdate();
            $fname = $_FILES["upfile"]["tmp_name"].$date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
            $fname = hash("sha256", $fname);

            //画像・動画をDBに格納．
            $sql = "INSERT INTO media(fname, extension, raw_data) VALUES (:fname, :extension, :raw_data);";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindValue(":fname",$fname, PDO::PARAM_STR);
            $stmt -> bindValue(":extension",$extension, PDO::PARAM_STR);
            $stmt -> bindValue(":raw_data",$raw_data, PDO::PARAM_STR);
            $stmt -> execute();

        }

    }
    catch(PDOException $e){
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }
?>

<!DOCTYPE HTML>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>media</title>
</head>

<body>
    <form action="Main.php" enctype="multipart/form-data" method="post">
        <label>画像/動画アップロード</label>
        <input type="file" name="upfile">
        <br>
        ※画像はjpeg方式，png方式，gif方式に対応しています．動画はmp4方式のみ対応しています．<br>
        <input type="submit" value="アップロード">
    </form>

    <?php
    //DBから取得して表示する．
    $sql = "SELECT * FROM media ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        echo ($row["id"]."<br/>");
        //動画と画像で場合分け
        $target = $row["fname"];
        /*if($row["extension"] == "mp4"){
            echo ("<video src=\"import_media.php?target=$target\" width=\"426\" height=\"240\" controls></video>");
        }
        elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
            echo ("<img src='import_media.php?target=$target'>");
        }*/
		
        echo ("<br/><br/>");
    }
	
	//メディア掲載
	/*if(isset($_GET["target"]) && $_GET["target"] !== ""){
        $target = $_GET["target"];
    }
    else{
        header("Location: index.php");
    }*/
    $MIMETypes = array(
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'mp4' => 'video/mp4'
    );
    try {
        $pdo = new PDO("mysql:dbname=dbname;host=localhost",'usr','pass');
        $sql = "SELECT * FROM media WHERE fname = :target;";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindValue(":target", $target, PDO::PARAM_STR);
        $stmt -> execute();
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        header("Content-Type: ".$MIMETypes[$row["extension"]]);
        echo ($row["raw_data"]);
    }
    catch (PDOException $e) {
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }
    ?>
</body>
</html>