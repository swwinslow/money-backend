<?php
require_once '../../includes/db.php';

class Grocery {
    public static function grocery() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("");
        return $stmt->fetchAll();
    }
}

?>