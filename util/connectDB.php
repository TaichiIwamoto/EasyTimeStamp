<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = $_ENV['ENDPOINT'];
    $port = $_ENV['PORT'];
    $dbname = $_ENV['DATABASE'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['RDSPASS'];
    $charset = 'utf8';
    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
        $pdo = new PDO($dsn, $username, $password);
        echo "connected!";
        // MySQLに接続成功
    } catch (PDOException $e) {
        exit('MySQL接続エラー: ' . $e->getMessage());
    }

    $sql = "CREATE TABLE IF NOT EXISTS Test"
        . "("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "data DATETIME,"
        . "comment TEXT,"
        . "resourceName TEXT"
        . ");";
    $stmt = $pdo->query($sql);

    $sql = "SHOW TABLES";
    $result = $pdo->query($sql);
    if ($result) {
        echo "テーブル一覧:<br>";
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            echo $row[0] . "<br>";
        }
    } else {
        echo "テーブル情報の取得に失敗しました。";
    }

    ?>
</body>

</html>