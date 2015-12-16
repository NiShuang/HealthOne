<?php
require '../model/adminService.class.php';
if(is_array($_GET)&&count($_GET)>0){
    if(isset($_GET["operation"])){
        if($_GET['operation']==0){
            session_start();
            $username = $_SESSION["username"];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $birthday =  $_POST['year']."-".$_POST['month']."-".$_POST['day'];
            $hobby = $_POST['hobby'];
            $declaration = $_POST['declaration'];
            $res = AdminService::modifyAccount($username,$name,$sex,$birthday,$hobby,$declaration);
            if($res){
                header("Location: http://localhost/healthyone/view/Setting.php?success=1");
                exit();
            }
            else{
                header("Location: http://localhost/healthyone/view/Setting.php?errno=1");
                exit();
            }
        }
        else if($_GET['operation']==1){
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            session_start();
            $username = $_SESSION["username"];
            $type = $_SESSION["type"];
            $res = AdminService::modifyPassword($username,$oldPassword,$newPassword);
            if($res){
                if($type==2)
                    header("Location: http://localhost/healthyone/view/specialPasswordSetting.php?success=1");
                elseif($type==3)
                    header("Location: http://localhost/healthyone/view/adminPasswordSetting.php?success=1");
                else
                    header("Location: http://localhost/healthyone/view/passwordSetting.php?success=1");
            }
            else{
                if($type==2)
                    header("Location: http://localhost/healthyone/view/specialPasswordSetting.php?errno=0");
                 elseif($type==3)
                    header("Location: http://localhost/healthyone/view/adminPasswordSetting.php?errno=0");
                 else
                    header("Location: http://localhost/healthyone/view/passwordSetting.php?errno=0");
            }
            exit();
        }
        else if($_GET['operation']==2){
            $username = $_POST['id'];
            $res = AdminService::passSpecialUser($username);
            header("Location: http://localhost/healthyone/view/accountManage.php");
            exit();
        }
        else if($_GET['operation']==3){
            session_start();
            $username = $_SESSION["username"];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $birthday =  $_POST['year']."-".$_POST['month']."-".$_POST['day'];
            $hobby = $_POST['hobby'];
            $introduction = $_POST['introduction'];
            $res = AdminService::modifySpecialUser($username,$name,$sex,$birthday,$hobby,$introduction);
            if($res){
                header("Location: http://localhost/healthyone/view/specialSetting.php?success=1");
                exit();
            }
            else{
                header("Location: http://localhost/healthyone/view/specailSetting.php?errno=1");
                exit();
            }
        }
        else if($_GET['operation']==4){
            session_start();
            $username = $_SESSION["username"];
            $file = $_POST['uploadfile'];
            echo $file;
        }
    }
}
?>
