<?php
if (!empty($_POST['login'])) {
    if (!empty($_POST['userName']) && !empty($_POST['password'])) {
        require_once("connectDB.php");
        $pdo = connect();
        $userName = $_POST['userName'];
        $userPass = $_POST['password'];
        $sql = "SELECT userpass FROM user_table WHERE name=:name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("name", $userName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (password_verify($userPass, $result[0]['userpass'])) {
            header("Location: ../ezTimeStamp/search.php");
        }
    }
}
if (!empty($_POST['create'])) {
    header("Location: ./create.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./login.css" type="text/css">
    <title>ポチスタ-ログイン</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">POCHISTAR</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="" method="post">
                    <div class="page-header">
                        <h1><small>ログイン</small></h1>
                    </div>
                    ユーザ名
                    <input class="form-control" type="text" placeholder="ポチスタ太郎" name="userName"><br>
                    パスワード
                    <input class="form-control" type="password" placeholder="xxxxxxx" name="password"><br>
                    <input class="btn btn-primary" type="submit" value="ログイン" name="login" class=""><br><br>
                    <input class="btn btn-secondary" type="submit" value="アカウント新規作成" name="create"><br>
                </form>
                <button type="button" class="btn btn-link">
                    <a href="./reset.php">パスワードを忘れた方はこちら</a>
                </button><br>

                <?php
                if (!empty($_POST['login'])) {
                    if (!empty($_POST['userName']) && !empty($_POST['password'])) {

                        echo "パスワードが間違っています";

                    } else {
                        echo "ユーザ名とパスワードを入力してください";
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>