<?php
include "db.php";
$action = $_POST['action'];

switch ($action) {
    case 'bus':
        $bus = $pdo->query("SELECT * FROM `bus`")->fetchAll();
        echo json_encode($bus);
        break;

    case 'station':
        $station = $pdo->query("SELECT * FROM `station`")->fetchAll();
        echo json_encode($station);
        break;

    case 'map':
        $stations = $pdo->query("SELECT * FROM `station` ORDER BY `rank`")->fetchAll();

        foreach ($stations as $key => $station) {
            $prevTime = $pdo->query("SELECT SUM(`need` + `stop`) FROM `station` WHERE `rank` < {$station['rank']}")->fetchColumn();
            $arriveTime = $prevTime + $station['need'];
            $leaveTime = $arriveTime + $station['stop'];
        
            $bus = $pdo->query("SELECT * FROM `bus` WHERE `time` <= $leaveTime ORDER BY `time` DESC")->fetch();
        
            $stations[$key]['closest'] = $bus['plate']?? null;
            $stations[$key]['class'] = ($bus && $bus['time'] >= $arriveTime)? "text-danger" : "text-secondary";
        
            $stations[$key]['bus'] = $bus
              ? ($bus['time'] < $arriveTime? $bus['plate']."<br>約".($arriveTime - $bus['time'])."分鐘到站" : "已到站")
                : "<br>未發車";
        }

        echo json_encode($stations);
    break;
}
?>