<?php
require_once '../../includes/db.php';

class Pay {
    public static function function1() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("");
        return $stmt->fetchAll();
    }
}
?>