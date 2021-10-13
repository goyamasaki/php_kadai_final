<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ログイン</title>
</head>

<body>


    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="login.php">ログインの画面</a>
                </div>
            </div>
        </nav>
    </header>
    <p>管理画面の入口は下記にidとpwを入力する</p>
    <p>運営側からスーパー管理者認証を受けた場合はデータの更新・削除が可能になります</p>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="login_act.php" method="post">
        ID:<input type="text" name="lid" />
        PW:<input type="text" name="lpw" />
        <input type="submit" value="ログイン" />
    </form>


    <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">🔳ユーザー登録へ戻る</a>
                </div>


</body>

</html>
