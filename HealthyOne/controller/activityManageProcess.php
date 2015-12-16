<?php
require '../model/activityService.class.php';
if(is_array($_GET)&&count($_GET)>0){
    if(isset($_GET["operation"])){
        if($_GET['operation']==0){
            $id = $_GET['id'];
            $res = ActivityService::delete($id);
            header("Location: http://localhost/healthyone/view/activityManage.php");
        }
        else if($_GET['operation']==1){
            $id = $_POST['id'];
            $describe = $_POST['describe']; 
            $time = $_POST['time'];
            $place = $_POST['place'];
            $res = ActivityService::modify($id,$describe,$time,$place);
            header("Location: http://localhost/healthyone/view/activityManage.php");
        }
        else if($_GET['operation']==2){
            $id = $_POST['id'];
            session_start();
            $username = $_SESSION["username"];
            $res = ActivityService::join($username,$id);
            header("Location: http://localhost/healthyone/view/activity.php");
        }
        else if($_GET['operation']==3){
            $id = $_POST['id'];
            session_start();
            $username = $_SESSION["username"];
            $res = ActivityService::quit($username,$id);
            header("Location: http://localhost/healthyone/view/myActivity.php");
        }
    }
    
}
?>
