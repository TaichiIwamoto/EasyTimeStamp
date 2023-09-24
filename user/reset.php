<?php

if (!empty($_POST['sendMail'])) {
    if (!empty($_POST['userName'])) {
        require_once("connectDB.php");
        $pdo = connect();
        $userName = $_POST['userName'];
        $sql = "SELECT mail FROM user_table WHERE name=:name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("name", $userName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $email = $result[0]['mail'];
        if ($email == "") {
            $canSend = 0;
        } else {
            $canSend = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>ポチスタ-パスワード再設定</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">POCHISTAR</a>
        </div>
        <button class="btn btn-light">
            <a href="./login.php">ログイン</a>
        </button>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="" method="post">
                    <div class="page-header">
                        <h1><small>パスワード再設定</small></h1>
                    </div>
                    ユーザ名
                    <input class="form-control" type="text" placeholder="ポチスタ太郎" name="userName"><br>
                    <input class="btn btn-primary" type="submit" value="送信" name="sendMail" class=""><br>
                </form>

                <?php
                if (!empty($_POST['sendMail'])) {
                    if (!empty($_POST['userName'])) {
                        if ($canSend == 0) {
                            echo "\"" . $_POST['userName'] . "\"" . "でアカウントは登録されていません<br>";
                        } else {


                        }
                    } else {
                        echo "ユーザ名を入力してください<br>";
                    }
                }
                ?>
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