<?php
function connect()
{
    require_once('vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $host = $_ENV['ENDPOINT'];
    $port = $_ENV['PORT'];
    $dbname = $_ENV['DATABASE'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['RDSPASS'];
    $charset = 'utf8';

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $password);

    return $pdo;
}
?>