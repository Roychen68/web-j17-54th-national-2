<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("INSERT INTO `bus`(`plate`, `time`,`route`) VALUES ('{$_POST['plate']}','{$_POST['time']}','{$_POST['route']}')");
        break;
    
    case 'station':
        $rank = $pdo->query("SELECT MAX(`rank`) FROM `station`")->fetchColumn() + 1;
        $pdo->query("INSERT INTO `station`(`name`, `need`, `stop`,`rank`,`route`) VALUES ('{$_POST['name']}','{$_POST['need']}','{$_POST['stop']}','$rank','{$_POST['route']}')");
        break;
    
    case 'participants':
        $pdo->query("INSERT INTO `participants`(`mail`) VALUES ('{$_POST['mail']}')");
        break;
    
    case 'response':
        $participants = $pdo->query("SELECT * FROM `participants` WHERE `mail` = '{$_POST['mail']}'")->fetch();
        $response = $pdo->query("SELECT * FROM `response` WHERE `mail` = '{$_POST['mail']}'")->fetchColumn();
        $time = $pdo->query("SELECT * FROM `basic` WHERE 1")->fetch();
        $now = strtotime($_POST['time']);
        $start = strtotime($time['start']);
        $end = strtotime($time['end']);
        if ($response > 0) {
            echo "您已經猜與過意見調查";
            break;
        } else if ($participants < 1) {
            echo "您不在參與名單";
            break;
        } else if ($now < $start || $now > $end) {
            echo "該表單不接受回應";
            break;
        } else {
            $pdo->query("INSERT INTO `response`(`name`, `mail`, `note`) VALUES ('{$_POST['name']}','{$_POST['mail']}','{$_POST['note']}')");
            echo"已送出回應";
        }
        
        break;
    case 'route':
        $pdo->query("INSERT INTO `route`(`name`) VALUES ('{$_POST['route']}')");
        $route = $_POST['route'];
        $stations = json_decode($_POST['stations'], true);

        foreach ($stations as $station) {
            $name = $station['name'];
            $rank = $station['rank'];
            $need = $station['need'];
            $stop = $station['stop'];
            $pdo->query("INSERT INTO `route-station` (`station`, `rank`, `need`, `stop`, `route`) VALUES ('$name','$rank','$need','$stop','$route')");
        }

        break;
}
?>