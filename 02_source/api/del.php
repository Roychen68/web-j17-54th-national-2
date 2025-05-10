<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'station':
        $pdo->query("DELETE FROM `station` WHERE `id` = '{$_POST['id']}'");
        $pdo->query("DELETE FROM `station` WHERE `station` = '{$_POST['name']}'");
        break;
    case 'route':
        $pdo->query("DELETE FROM `route` WHERE `id` = '{$_POST['id']}'");
        $pdo->query("DELETE FROM `bus` WHERE `route` = '{$_POST['route']}'");
        $pdo->query("DELETE FROM `route-station` WHERE `route` = '{$_POST['route']}'");
        break;
    default:
        $pdo->query("DELETE FROM `{$_POST['action']}` WHERE `id` = '{$_POST['id']}'");
    break;
}
?>