<?php


/*************************************
 * 全員のユーザーの関連データを読み出し
 *************************************/
function readAllUserData()
{
  return;
}

/*************************************
 * １人のユーザーの関連データを読み出し
 *************************************/
function readUserData($usrId)
{
  // DB接続
  $pdo = connect_to_db();

  //ファイル名に使うユーザIDは８桁で０パディングする
  $tableName = "user_table_" . sprintf('%08d', $usrId);

  // データ取得SQL作成
  $sql = "SELECT * FROM $tableName";

  // $sql = "SELECT * FROM user_table_00000001";

  var_dump($sql);

  // SQL準備&実行
  $stmt = $pdo->prepare($sql);

  echo ("<pre>");
  var_dump($stmt);
  echo ("<pre>");

  $status = $stmt->execute();

  echo ("<pre>");
  var_dump($status);
  echo ("<pre>");

  // データ読み出し処理後
  if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo ('<pre>');
    var_dump($result);
    echo ('<pre>');
  }

  return $result;
}

/*************************************
 * gram_read メイン処理開始
 *************************************/
session_start();

include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
// $sql = 'SELECT * FROM gram_table';
$sql = 'SELECT * FROM gram_table 
        LEFT OUTER JOIN cource_table
        ON gram_table.cource_id = cource_table.cource_id';
// $sql = 'SELECT * FROM cource_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//タイトル作成
$title = "";
if ($_SESSION["is_admin"] == 1) {
  $title = "GRAMリスト（一覧画面）[ユーザID:{$_SESSION["users_id"]}][管理者]";
} else {
  $title = "GRAMリスト（一覧画面）[ユーザID:{$_SESSION["users_id"]}][一般]";
}

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定

  // echo ('<pre>');
  // var_dump($result);
  // echo ('<pre>');

  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  $valCnt = 0;
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td><input type='checkbox' class='checks' value='{$valCnt}'></td>";
    $output .= "<td>{$record["id"]}</td>";
    $output .= "<td>{$record["users_id"]}</td>";
    $output .= "<td>{$record["last_name"]}</td>";
    $output .= "<td>{$record["first_name"]}</td>";
    $output .= "<td>{$record["last_name_kana"]}</td>";
    $output .= "<td>{$record["first_name_kana"]}</td>";
    $output .= "<td>{$record["nick_name"]}</td>";
    $output .= "<td>{$record["users_location"]}</td>";
    $output .= "<td>{$record["cource"]}</td>";
    $output .= "<td>{$record["cource_id"]}</td>";
    $output .= "<td>{$record["cource_txt"]}</td>";
    $output .= "<td>{$record["ki"]}</td>";
    $output .= "<td>{$record["touitsu_ki"]}</td>";
    if ($_SESSION["is_admin"] == 1) {
      $output .= "<td>{$record["users_password"]}</td>";
      $output .= "<td>{$record["is_admin"]}</td>";
      $output .= "<td>{$record["is_deleted"]}</td>";
      $output .= "<td>{$record["created_at"]}</td>";
      $output .= "<td>{$record["updated_at"]}</td>";
    }

    // edit deleteリンクを追加
    // 編集/削除は管理者または本人しかできない
    if ($_SESSION["is_admin"] == 1) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td><a href='gram_delete.php?id={$record["id"]}'>削除</a></td>";
    } else if ($_SESSION["is_admin"] != 1 && $_SESSION["users_id"] == $record["users_id"]) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td><a href='gram_delete.php?id={$record["id"]}'>削除</a></td>";
    } else {
      $output .= "<td>-</td>";
      $output .= "<td>-</td>";
    }
    $output .= "</tr>";

    $valCnt++;
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);

  $usr1Data = readUserData(1);

  echo ('<pre>');
  var_dump($usr1Data);
  echo ('<pre>');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">

  <!-- <title>GRAMリスト（一覧画面</title> -->
  <title><?= $title ?></title>
</head>

<header>
  <h1>GRAM</h1>
</header>

<body>
  <fieldset>
    <!-- <legend>GRAMリスト（一覧画面）</legend> -->
    <legend><?= $title ?></legend>
    <a href="gram_input.php">入力画面</a>
    <a href="gram_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>CHECK</th>
          <th>ID</th>
          <th>ユーザID</th>
          <th>名字</th>
          <th>名前</th>
          <th>ミョウジ</th>
          <th>ナマエ</th>
          <th>ニックネーム</th>
          <th>場所</th>
          <th>コース</th>
          <th>コースID</th>
          <th>コース(from cource_table)</th>
          <th>期</th>
          <th>統一期</th>
          <?php if ($_SESSION["is_admin"] == 1) {
            echo ("<th>パスワード</th>");
            echo ("<th>管理者権限</th>");
            echo ("<th>削除</th>");
            echo ("<th>作成日時</th>");
            echo ("<th>更新日時</th>");
          } ?>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>

  <button id="readGsGram">OPEN GRAM</button>
  <table id='gsGramTable'></table>

  <footer>
    <p>統一期とは東京DEVの期を基準とし、東京LABは7期、福岡DEVは10期、福岡LABは13期足し合わせたものである</p>
  </footer>



</body>

</html>