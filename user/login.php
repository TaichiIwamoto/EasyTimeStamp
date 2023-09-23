<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once("./util/connectDB.php");
    $pdo = connect();
    ?>

    <form action="" method="post">
        <input type="text" placeholder="ユーザ名" name="userName"><br>
        <input type="password" placeholder="パスワード" name="password"><br>
        <input type="submit" value="ログイン" name="login"><br>
        <input type="submit" value="アカウント新規作成" name="create">
    </form>
    <?php
    if (!empty($_POST['login'])) {
        header("Location: ../ezTimeStamp/search.php");
    }
    if (!empty($_POST['create'])) {
        header("Location: ./create.php");
    }

    ?>
</body>

</html>