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
 *  @param ユーザID
 *  @return ユーザIDの関連テーブル
 *************************************/
function readUserData($usrId)
{
  // DB接続
  $pdo = connect_to_db();

  //ファイル名に使うユーザIDは８桁で０パディングする
  $tableName = "user_table_" . sprintf('%08d', $usrId);

  // データ取得SQL作成
  $sql = "SELECT * FROM $tableName";

  // SQL準備&実行
  $stmt = $pdo->prepare($sql);
  $status = $stmt->execute();

  // データ読み出し処理後
  if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo ('<pre>');
    // var_dump($result);
    // echo ('<pre>');
  }

  return $result;
}

/*************************************
 * １人のデータを読み出し
 *  @param ユーザID
 *  @return ユーザの情報
 *************************************/
function readMyData($usrId)
{
  // DB接続
  $pdo = connect_to_db();

  //ファイル名に使うユーザIDは８桁で０パディングする
  $tableName = "gram_table";

  // データ取得SQL作成
  $sql = "SELECT * FROM $tableName WHERE users_id = $usrId";

  // SQL準備&実行
  $stmt = $pdo->prepare($sql);
  $status = $stmt->execute();

  // データ読み出し処理後
  if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo ('<pre>');
    // var_dump($result);
    // echo ('<pre>');
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
$sql = 'SELECT * FROM 
          gram_table 
        LEFT OUTER JOIN 
          cource_table
        ON 
          gram_table.cource_id = cource_table.cource_id';

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
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // HTML出力
  $output = "";
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

  for ($i = 1; $i < 9; $i++) {
    $myData[$i] = readMyData($i);
    $usrData[$i] = readUserData($i);
    // $usrData[2] = readUserData(2);
  }

  echo ('<pre>');
  var_dump($usrData);
  echo ('<pre>');

  $usrData2 = "あああああ";

  $myDataJson = json_encode($myData);
  $usrDataJson = json_encode($usrData);

  echo ('<pre>');
  var_dump($myDataJson);
  var_dump($usrDataJson);
  echo ('<pre>');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <style type="text/css">
    /* cytoscape graph */
    #cy {
      height: 600px;
      width: 1200px;
      /* height: 100%;
      width: 100%; */
      background-color: #f9f9f9;
    }

    #cy2 {
      height: 600px;
      width: 1200px;
      /* height: 100%;
      width: 100%; */
      background-color: #f9f9f9;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/3.15.1/cytoscape.umd.js"></script>
  <!-- <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/cytoscape/2.3.16/cytoscape.min.js"></script> -->
  <!-- <script src="../js/initialGraph.js"></script> -->


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

  <button id="readGram">OPEN GRAM</button>
  <table id='gsGramTable'></table>
  <p>aaa</p>
  <div id="cy"></div>
  <div id="cy2"></div>

</body>

<footer>
  <p>統一期とは東京DEVの期を基準とし、東京LABは7期、福岡DEVは10期、福岡LABは13期足し合わせたものである</p>
</footer>


<script>
  let myDataJS = JSON.parse('<?php echo ($myDataJson); ?>');
  let usrDataJS = JSON.parse('<?php echo ($usrDataJson); ?>');
  console.log(myDataJS);
  console.log(usrDataJS);
  console.log(Object.keys(usrDataJS));


  //内容要素はJSONオブジェクトである、サーバ側加工しフロントに渡すもの
  let elements = {
    nodes: [
      //グラフの点、ノードのidが必須で、他の属性は機能によって調整するばよい
      {
        data: {
          id: '1',
          name: 'アルファ',
          label: 'Person'
        }
      },
      {
        data: {
          id: '2',
          name: 'ブラボー',
          label: 'Person'
        }
      },
      {
        data: {
          id: '3',
          name: 'チャーリー',
          label: 'Person'
        }
      },
      {
        data: {
          id: '4',
          name: 'デルタ',
          label: 'Person'
        }
      },
      {
        data: {
          id: '5',
          name: 'エコー',
          label: 'Person'
        }
      },
      {
        data: {
          id: '6',
          name: 'フォックス',
          label: 'Person'
        }
      },
      {
        data: {
          id: '7',
          name: 'ゴルフ',
          label: 'Person'
        }
      },
      {
        data: {
          id: '8',
          name: 'ホテル',
          label: 'Person'
        }
      },
    ],
    edges: [
      //グラフの線、エッジはsource(開始点id)とtarget(終了点id)は必須で、他の属性も追加可能
      // { data: { source: '172', target: '183', relationship: 'Acted_In' } },
      {
        data: {
          source: '1',
          target: '2',
          relationship: '契約チューター'
        }
      },
      {
        data: {
          source: '1',
          target: '5',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '1',
          target: '6',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '2',
          target: '1',
          relationship: '雇用主'
        }
      },
      {
        data: {
          source: '2',
          target: '5',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '2',
          target: '6',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '3',
          target: '4',
          relationship: '契約チューター'
        }
      },
      {
        data: {
          source: '3',
          target: '7',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '3',
          target: '8',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '4',
          target: '3',
          relationship: '雇用主'
        }
      },
      {
        data: {
          source: '4',
          target: '7',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '4',
          target: '8',
          relationship: '生徒'
        }
      },
      {
        data: {
          source: '5',
          target: '1',
          relationship: '先生'
        }
      },
      {
        data: {
          source: '5',
          target: '2',
          relationship: 'チューター'
        }
      },
      {
        data: {
          source: '6',
          target: '1',
          relationship: '先生'
        }
      },
      {
        data: {
          source: '6',
          target: '2',
          relationship: 'チューター'
        }
      },
      {
        data: {
          source: '7',
          target: '3',
          relationship: '先生'
        }
      },
      {
        data: {
          source: '7',
          target: '4',
          relationship: 'チューター'
        }
      },
      {
        data: {
          source: '8',
          target: '3',
          relationship: '先生'
        }
      },
      {
        data: {
          source: '8',
          target: '4',
          relationship: 'チューター'
        }
      },
    ],
  }

  //内容要素を表現するCSS
  let style = [
    //セレクターで拾いた内容要素が 指定したCSSを適用する
    //ノードの中で、label属性は「Peson」のノードが青色で表示し、文字はname属性を表示する
    {
      selector: 'node[label = "Person"]',
      css: {
        'background-color': '#6FB1FC',
        'content': 'data(name)'
      }
    },
    //ノードの中で、label属性は「Movie」のノードがオレンジ色で表示し、文字はtitle属性を表示する
    {
      selector: 'node[label = "Movie"]',
      css: {
        'background-color': '#F5A45D',
        'content': 'data(title)'
      }
    },
    //エッジ全体で、文字はrelationship属性を表示する、終了点での矢印は三角形にする
    {
      selector: 'edge',
      css: {
        'content': 'data(relationship)',
        'target-arrow-shape': 'triangle',
        'curve-style': 'unbundled-bezier'
      }
    }
  ]

  //レイアウト設定
  let layout = {
    //グリッドレイアウトを適用する
    // name: 'fcose',
    // name: 'grid',
    // name: 'random',
    // name: 'circle',
    // name: 'concentric',
    name: 'breadthfirst',
    // name: 'cose',
    // name: 'Edge-weighted Spring Embedded',


  }

  // Cytoscapeオブジェクト初期化。
  let cy = cytoscape({
    // containerがHTML内の「cy」DOM要素に指定
    container: document.getElementById('cy'),
    elements: elements,
    style: style,
    layout: layout,
  });



  //
  // GRAM読み出しクリック時
  //
  $('#readGram').on('click', function() {
    console.log('おされたよ');
    console.log(Object.keys(usrDataJS).length);


    let elements = {
      nodes: [],
      edges: [],
    }

    //内容要素を表現するCSS
    let style = [
      //セレクターで拾いた内容要素が 指定したCSSを適用する
      //ノードの中で、label属性は「Peson」のノードが青色で表示し、文字はname属性を表示する
      {
        selector: 'node[label = "Person"]',
        css: {
          'background-color': '#6FB1FC',
          'content': 'data(name)'
        }
      },
      //エッジ全体で、文字はrelationship属性を表示する、終了点での矢印は三角形にする
      {
        selector: 'edge',
        css: {
          'content': 'data(relationship)',
          'target-arrow-shape': 'triangle',
          'curve-style': 'unbundled-bezier'
        }
      }
    ]

    //レイアウト設定
    let layout = {
      // name: 'fcose',
      // name: 'grid',
      // name: 'random',
      // name: 'circle',
      // name: 'concentric',
      name: 'breadthfirst',
      // name: 'cose',
    }

    // Cytoscapeオブジェクト初期化。
    let cy2 = cytoscape({
      // containerがHTML内の「cy」DOM要素に指定
      container: document.getElementById('cy2'),
      elements: elements,
      style: style,
      layout: layout,
    });


    // var cy2 = cytoscape({
    //   container: document.getElementById('cy2'),
    //   elements: [
    //     },
    //     {
    //       data: {
    //         id: 'b'
    //       }
    //     },
    //     {
    //       data: {
    //         id: 'ab',
    //         source: 'a',
    //         target: 'b'
    //       }
    //     }
    //   ],
    //   style: [{
    //     selector: 'node',
    //     style: {
    //       shape: 'hexagon',
    //       'background-color': 'red',
    //       label: 'data(id)'
    //     }
    //   }],

    // });

    // for (var i = 0; i < 10; i++) {
    //   cy2.add({
    //     data: {
    //       id: 'node' + i
    //     }
    //   });
    //   var source = 'node' + i;
    //   cy2.add({
    //     data: {
    //       id: 'edge' + i,
    //       source: source,
    //       target: (i % 2 == 0 ? 'a' : 'b')
    //     }
    //   });
    // }
    // cy2.layout({
    //   name: 'circle'
    // }).run();
    // layout.run()    
    console.log(Object.keys(usrDataJS).length);


    for (let i = 1; i < 9; i++) {
      for (let j = 0; j < myDataJS[i].length; j++) {
        console.log(`私は${i}`);
        cy2.add({
          group: 'nodes',
          data: {
            id: `${i}`,
            name: `${myDataJS[i][j].nick_name}`,
            label: 'Person'
          }
        });
      }
    }

    for (let i = 1; i < 9; i++) {
      console.log(`関係の数は${usrDataJS[i].length}`);
      for (let j = 0; j < usrDataJS[i].length; j++) {

        console.log(`あなたは${usrDataJS[i][j].users_id}`);
        console.log(`関係は${usrDataJS[i][j].relation}`);
        // console.log(Object.keys(usrDataJS)[i]);
        // console.log(usrDataJS[Object.keys(usrDataJS)[i]][j].users_id);
        // console.log(usrDataJS[Object.keys(usrDataJS)[i]][j].relation);
        cy2.add({
          group: 'edges',
          data: {
            source: `${i}`,
            target: `${usrDataJS[i][j].users_id}`,
            relationship: `${usrDataJS[i][j].relation}`,
          }
        });
      }
    }

    cy2.layout({
      name: 'breadthfirst',
    }).run();




  });
</script>

</html>