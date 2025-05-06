<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("DELETE FROM `bus` WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'station':
        $pdo->query("DELETE FROM `station` WHERE `id` = '{$_POST['id']}'");
        $pdo->query("DELETE FROM `station` WHERE `station` = '{$_POST['name']}'");
        break;

    case 'participants':
        $pdo->query("DELETE FROM `participants` WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'response':
        $pdo->query("DELETE FROM `response` WHERE `id` = '{$_POST['id']}'");
        break;
    case 'route':
        $pdo->query("DELETE FROM `route` WHERE `id` = '{$_POST['id']}'");
        $pdo->query("DELETE FROM `bus` WHERE `route` = '{$_POST['route']}'");
        $pdo->query("DELETE FROM `route-station` WHERE `route` = '{$_POST['route']}'");
        break;
}
?>