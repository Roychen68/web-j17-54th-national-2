<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("UPDATE `bus` SET `time`='{$_POST['time']}' WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'station':
        $pdo->query("UPDATE `station` SET `need`='{$_POST['need']}',`stop`='{$_POST['stop']}' WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'basic':
        $pdo->query("UPDATE `basic` SET `start`='{$_POST['start']}',`end`='{$_POST['end']}' WHERE 1");
        break;
}
?>