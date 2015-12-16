<?php
    require '../model/adminService.class.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type=1;
    if(is_array($_GET)&&count($_GET)>0){
        if(isset($_GET["type"])){
            $type=$_GET["type"];
        }
    }
    $res = AdminService::add($username, $password,$type);
    if($res){
        if($type==1){
            AdminService::addCommonUser($username);
            header("Location: http://localhost/healthyone/index.php?success=1");
        }
        elseif ($type==2){
            $introduction = $_POST['introduction'];
            $job = $_POST['job'];
            echo $job;
            AdminService::addSpecialUser($username,$job,$introduction);
            header("Location: http://localhost/healthyone/index.php?success=2");
        }
            
            exit();
    }
    else{
            header("Location: http://localhost/healthyone/view/signUp.php?errno=0");
            exit();
    }


?>