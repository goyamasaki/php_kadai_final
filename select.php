<?php
//session開始する
session_start();

//ここからログインの確認を実行する感じ
if ($_SESSION['chk_ssid'] === session_id()) {
    // ok
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
} else {
    // id持ってない データの登録だけ
    exit("【ちゃんとデータが登録されました➡ブラウザの戻るをクリックしたらTOP画面に戻れます】");
}

require_once('funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result['name'] . '：' . $result['lid'] . '：' . $result['lpw'];
        $view .= '</a>';

        
    // 0 : true;
        // 1 : false;フラグに１が入ってると管理者として削除ボタンが表示される
        if ($_SESSION["kanri_flg"]) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $result["id"] . '">';
            $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
            $view .= '</a>';
        }

        $view .= '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">トップ画面へ戻る</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <p style="text-align:center">ログイン中</p>
    <div>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div>

      <!-- Main[End] -->
    

</body>

</html>