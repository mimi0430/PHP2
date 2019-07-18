<?php
try {

    //1．GET値取得(一行スクリプトを書きましょう！)
    $id = $_POST["id"]; //WHEREの条件に使う
    $name = $_POST["name"]; //更新データ
    $seibetu = $_POST["seibetu"]; //更新データ
    $email = $_POST["email"]; //更新データ
    $age = $_POST["age"];
    $auth = $_POST["auth"];
    
    //2．DB接続  //*の箇所を変更！！
    $db = new PDO('sqlite:php.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //上記接続エラーの場合エラーを表示

    //3．SQL文作成 //*の箇所を変更！！
    $stmt = $db->prepare('UPDATE users SET name=:name, seibetu=:seibetu, email=:email, age=:age, auth=:auth WHERE id=:id');
    $stmt->bindValue(":id", $id);    //更新したいidを渡す
    $stmt->bindValue(":name", $name); //更新したいidを渡す
    $stmt->bindValue(":seibetu", $seibetu); //更新したいidを渡す
    $stmt->bindValue(":email", $email); //更新したいidを渡す
    $stmt->bindValue(":age", $age); //更新したいidを渡す
    $stmt->bindValue(":auth", $auth); //更新したいidを渡す
    $stmt->execute();

    header("Location: users_select.php");  //更新処理完了後 → データ一覧に戻る
    exit();


} catch (PDOException $e) {
    //エラー表示
    $err = $db->errorInfo();
    die($err[2]);
}
?>
