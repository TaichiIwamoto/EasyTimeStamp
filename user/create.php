<?php
if (!empty($_POST['submit'])) {
    if (!empty($_POST['userName']) && !empty($_POST['userPass']) && !empty($_POST['userMail'])) {
        include_once("connectDB.php");
        $pdo = connect();
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];
        $userMail = $_POST['userMail'];
        $userPass = password_hash($userPass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user_table (name,mail,userpass) VALUES (:name,:mail,:pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('name', $userName, PDO::PARAM_STR);
        $stmt->bindParam('mail', $userMail, PDO::PARAM_STR);
        $stmt->bindParam('pass', $userPass, PDO::PARAM_STR);
        $stmt->execute();
        sleep(1);
        header("Location: ./login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポチスタ-サインアップ</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="userName" placeholder="ユーザ名" id="userName"><br>
        <input type="password" name="userPass" placeholder="パスワード"><br>
        <input type="email" name="userMail" placeholder="メールアドレス"><br>
        <input type="submit" name="submit" value="アカウント新規作成"><br>
    </form>
    <!-- <script>
        // ページが読み込まれた後に実行
        window.onload = function () {
            // userNameフィールドの要素を取得
            var userNameField = document.getElementById("userName");

            // フィールドの値をlocalStorageに保存
            userNameField.addEventListener("input", function () {
                var userName = userNameField.value;
                localStorage.setItem("userName", userName);
            });

            // ロード時にlocalStorageから値を取得してフィールドに設定
            var storedUserName = localStorage.getItem("userName");
            if (storedUserName) {
                userNameField.value = storedUserName;
            }
        };
    </script> -->
    <?php
    if (!empty($_POST['submit'])) {
        if (!empty($_POST['userName']) && !empty($_POST['userPass']) && !empty($_POST['userMail'])) {
        } else {
            echo "ユーザ名、パスワードとメールアドレスを入力してください<br>";
        }
    }
    ?>
</body>

</html>