<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include("functions.php");

// 送信データ受け取り

$id = $_POST["id"];

$users_id_1 = $_POST['users_id_1'];
$relation_1 = $_POST['relation_1'];

$users_id_2 = $_POST['users_id_2'];
$relation_2 = $_POST['relation_2'];

$users_id_3 = $_POST['users_id_3'];
$relation_3 = $_POST['relation_3'];

$users_id_4 = $_POST['users_id_4'];
$relation_4 = $_POST['relation_4'];


// var_dump($last_name);


// DB接続
$pdo = connect_to_db();

//ファイル名に使うユーザIDは８桁で０パディングする
$tableName = "user_table_" . sprintf('%08d', $id);
$sql2 = "INSERT INTO 
            $tableName (users_id, relation) 
          VALUES 
            ('$users_id_4', '$relation_4')";



// SQL準備&実行
$stmt2 = $pdo->prepare($sql2);
// $stmt2->bindValue(':users_id_4', $users_id_4, PDO::PARAM_INT);
// $stmt2->bindValue(':relation_4', $relation_4, PDO::PARAM_INT);

// var_dump($stmt2);
// exit;

$status2 = $stmt2->execute();



// データ登録処理後
if ($status2 == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt2->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:gram_read.php");
  exit();
}
