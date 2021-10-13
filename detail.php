<?php
//sessionの開始
session_start();

//ここからログインの確認を実行する感じ
if ($_SESSION['chk_ssid'] === session_id()) {
    // ok
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
} else {
    // id持ってない or idがおかしい
    exit("XXXXXXX LOGIN ERROR XXXXXXXXXX");
}




require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id =' . $id . ';');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>更新画面</title>
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
                    <a class="navbar-brand" href="index.php">ユーザー登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <p style="text-align:center">ログイン中</p>
    <div>
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ユーザー登録</legend>
                <label>名前：<input type="text" name="name" value=<?= $row['name'] ?>></label><br>
                <label>ID：<input type="text" name="lid"value=<?= $row['lid'] ?>></label><br>
                <label>PW：<input type="text" name="lpw"value=<?= $row['lpw'] ?>></label><br>
                
                <!--ここが大切なcode -->
                <input type="hidden" name="id"value="<?= $row['id'] ?>">

                <input type="submit" value="更新をする">

                
            </fieldset>
        </div>
    </div>
    <!-- Main[End] -->

</body>

</html> 