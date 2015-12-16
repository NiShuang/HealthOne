<?php
    require '../model/adminService.class.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = AdminService::check($username, $password);
    echo $res;
    if($res){
        $type = AdminService::checkType($username);
        Session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['type'] = $type;
        if($type==1)
            header("Location: http://localhost/healthyone/view/health.php");
        else if($type==2)
            header("Location: http://localhost/healthyone/view/consultManage.php");
        else if($type==3)
            header("Location: http://localhost/healthyone/view/activityManage.php");
        exit();
    }
    else{
        header("Location: http://localhost/healthyone/index.php?errno=0");
        exit();
    }
?>
