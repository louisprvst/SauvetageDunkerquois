<?php
    require_once(dirname(__FILE__) . '/../vendor/autoload.php');

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(dirname(__FILE__) . '/../');
    $dotenv->load();

    $db_host = $_ENV['DB_HOST'];
    $db_name = $_ENV['DB_NAME'];
    $db_port = $_ENV['DB_PORT'];
    $db_username = $_ENV['DB_USER'];
    $db_password = $_ENV['DB_PASS'];

    if (empty($db_host) || empty($db_name) || empty($db_username) || empty($db_password)) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR Configuration: les informations n\'ont pas pu être chargées.';
    }

    try {
        $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";
        $db = new PDO($dsn, $db_username, $db_password);
    } catch (PDOException $e) {
        $db = null;
        $_SESSION['mesgs']['errors'][] = 'ERREUR Base de données: ' . $e->getMessage();
    }

    return $db;