<?php
require_once("connectDB.php");
$pdo = connect();
echo "hello";

$sql = "CREATE TABLE IF NOT EXISTS user_table"
    . "("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "mail TEXT,"
    . "userpass TEXT"
    . ");";
$stmt = $pdo->query($sql);

echo "TABLE一覧<br>";
$sql = "SHOW TABLES";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();
// var_dump($result);
foreach ($result as $line) {
    echo $line[0];
}
?>