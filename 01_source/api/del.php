<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("DELETE FROM `bus` WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'station':
        $pdo->query("DELETE FROM `station` WHERE `id` = '{$_POST['id']}'");
        break;

    default:
        # code...
        break;
}
?>