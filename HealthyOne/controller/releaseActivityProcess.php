<?php
    require '../model/activityService.class.php';
    $describe = $_POST['describe'];
    $time = $_POST['time'];
    $place = $_POST['place'];
    $res = ActivityService::add($describe, $time,$place);
    if($res){
        header("Location: http://localhost/healthyone/view/releaseActivity.php?success=1");
        exit();
    }
    else{
        header("Location: http://localhost/healthyone/view/releaseActivity.php?errno=0");
        exit();
    }
?>
