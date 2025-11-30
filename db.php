<?php
function db() {
    static $pdo;

    if (!$pdo) {  // FIXED
        $host = 'localhost';
        $dbname = 'horizon_language_academy';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    return $pdo;
}
?>
