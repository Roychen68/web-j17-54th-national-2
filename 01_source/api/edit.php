<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("UPDATE `bus` SET `time`='{$_POST['time']}' WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'station':
        $pdo->query("UPDATE `station` SET `need`='{$_POST['need']}',`stop`='{$_POST['stop']}'");
        break;
}
?>