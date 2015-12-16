<?php
    require"SQLiteHelper.php";
    class AdminService{
        public static function add($username,$password,$type){
            $db = new MyDB();
            $newPassword =  md5($password);
            $sql = "INSERT INTO ADMIN (USERNAME,PASSWORD,TYPE) VALUES ('$username','$newPassword' ,'$type')";
            return $db->exec($sql);
        }    
        public static function addCommonUser($username){
            $db = new MyDB();
            $sql = "INSERT INTO COMMONUSER (USERNAME) VALUES ('$username')";
            return $db->exec($sql);
        }
        public static function addSpecialUser($username,$type,$introduction){
            $db = new MyDB();
            $sql = "INSERT INTO SPECIALUSER (USERNAME, TYPE,INTRODUCTION) VALUES ('$username','$type','$introduction')";
            return $db->exec($sql);
        }
        public static function passSpecialUser($username){
            $db = new MyDB();
            $sql = "UPDATE SPECIALUSER SET ISPASS=1 WHERE USERNAME='$username'";
            return $db->exec($sql);
        }
        public static function check($username,$password){
            $db = new MyDB();
            $sql = "SELECT PASSWORD FROM ADMIN WHERE USERNAME = '$username'";
            $res = $db->query($sql);
            if($item = $res->fetchArray(SQLITE3_ASSOC) ){
                if($item['PASSWORD']==md5($password))
                    return true;
            }
            return false;
        }
        public static function checkType($username){
            $db = new MyDB();
            $sql = "SELECT TYPE FROM ADMIN WHERE USERNAME = '$username'";
            $res = $db->query($sql);
            if($item = $res->fetchArray(SQLITE3_ASSOC) ){   
                return $item['TYPE'];
            }
            return false;
        }
        public static function findAllSpecial(){
            $db = new MyDB();
            $sql = "SELECT * FROM SPECIALUSER";
            $res = $db->query($sql);
            return $res;
        }
        public static function findSpecial($username){
            $db = new MyDB();
            $sql = "SELECT * FROM SPECIALUSER WHERE USERNAME='$username'";
            $res = $db->query($sql);
            return $res;
        }
        public static function modifyPassword($username,$oldPassword,$newPassword){
            $db = new MyDB();
            $password =  md5($newPassword);
            $sql = "SELECT PASSWORD FROM ADMIN WHERE USERNAME='$username'";
            $sql1 = "UPDATE ADMIN SET PASSWORD='$password' WHERE USERNAME='$username'";
            $res = $db->query($sql);
            if($item = $res->fetchArray(SQLITE3_ASSOC) ){
                if($item['PASSWORD']!=md5($oldPassword))
                    return false;
                else 
                   return $res = $db->exec($sql1);
                
            }
            return false;
        }
        
        public static function modifyAccount($username,$name,$sex,$birthday,$hobby,$declaration){
            $db = new MyDB();
            $sql = "UPDATE COMMONUSER SET NAME='$name',SEX='$sex',BIRTHDAY='$birthday',HOBBY='$hobby',DECLARATION='$declaration' WHERE USERNAME='$username'";
            $res = $db->exec($sql);
            return $res;
        }
        public static function modifySpecialUser($username,$name,$sex,$birthday,$hobby,$introduction){
            $db = new MyDB();
            $sql = "UPDATE SPECIALUSER SET NAME='$name',SEX='$sex',BIRTHDAY='$birthday',HOBBY='$hobby',INTRODUCTION='$introduction' WHERE USERNAME='$username'";
            $res = $db->exec($sql);
            return $res;
        }
        public static function findAccount($username){
            $db = new MyDB();
            $sql = "SELECT * FROM COMMONUSER WHERE USERNAME='$username'";
            $res = $db->query($sql);
            return $res;
        }
        public static function findSpecailAccount($username){
            $db = new MyDB();
            $sql = "SELECT * FROM SPECIALUSER WHERE USERNAME='$username'";
            $res = $db->query($sql);
            return $res;
        }
    }
?>