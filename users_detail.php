<?php
//PHPからSQLiteに接続、SELECT文でデータ取得し、PHPで表示文字を作成する方法
try {
    $id = $_GET["id"];

    //１．DB接続
    $db = new PDO('sqlite:php.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //上記接続エラーの場合エラーを表示

    //２．SQL実行
    $stmt = $db->prepare('SELECT * FROM users WHERE id=:id'); //SQL文を用意
    $stmt->bindValue(":id", $id);//セキュリティーを強化するためバインド変数を使用
    $stmt->execute();

    //３．データ取得１レコードしか帰ってこない場合は以下の一行で取得可能。
    $row = $stmt->fetch();  //$row["id"],$row["name"],$row["email"]....
    
    if($row["seibetu"]==1){
        $seibetu = '<option value="1" selected>女性</option>';
        $seibetu .='<option value="0">男性</option>';  
    }else{
        $seibetu = '<option value="1">女性</option>';
        $seibetu .='<option value="0" selected>男性</option>';
    }
    if($row["auth"]==1){
        $auth= '<option value="1" selected>管理者</option>';
        $auth .='<option value="0">一般</option>';  
    }else{
        $auth = '<option value="1">管理者</option>';
        $auth .='<option value="0" selected>一般</option>';
    }
} catch (PDOException $e) {
    //エラー表示
    $err = $db->errorInfo();
    die($err[2]);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ユーザー更新</title>
</head>
<body>
<h3>ユーザー情報更新</h3>
<form method="post" action="update.php">
<p>お名前:<input type="text" name="name" size="20" value="<?=$row["name"]?>"></p>
    <p>性別：<select name="seibetu"><?=$seibetu?></select></p>
<p>MAIL:<input type="text" name="email" size="20" value="<?=$row["email"]?>"></p>
<p>年齢:<input type="text" name="age" size="20" value="<?=$row["age"]?>"></p>
<p>管理権限：<select name="auth"><?=$auth?></select></p>
<p>
  <button onclick="history.back();return false;">戻る</button>
  <input type="hidden" name="id" value="<?=$row["id"]?>"> 
  <input type="submit" value="更新">
</p>
<p></p>
</form>
</body>
</html>

