<?php
    require"SQLiteHelper.php";
    class ActivityService{
        public static function add($describe,$time,$place){
            $db = new MyDB();
            $sql = "INSERT INTO ACTIVITY (DESCRIBE,TIME,PLACE) VALUES ('$describe','$time', '$place')";
            $res = $db->exec($sql);
            return $res;
        }    
        public static function modify($id,$describe,$time,$place){
            $db = new MyDB();
            $sql = "UPDATE ACTIVITY SET DESCRIBE='$describe',TIME='$time',PLACE='$place' WHERE ID='$id'";
            $res = $db->exec($sql);
            return $res;
        }
        public static function findAll(){
            $db = new MyDB();
            $sql = "SELECT * FROM ACTIVITY";
            $res = $db->query($sql);
            return $res;

        }
        public static function delete($id){
            $db = new MyDB();
            $sql = "DELETE FROM ACTIVITY WHERE ID = '$id'";
            $sql1 = "DELETE FROM `JOIN` WHERE ACTIVITY = '$id'";
            $res1 = $db->exec($sql1);
            $res = $db->exec($sql);
            return $res;
        }
        public static function find($id){
            $db = new MyDB();
            $sql = "SELECT * FROM ACTIVITY WHERE ID = '$id'";
            $res = $db->query($sql);
            return $res;
        }
        public static function join($username,$id){
            $db = new MyDB();
            $sql = "INSERT INTO `JOIN` (USERNAME,ACTIVITY) VALUES ('$username','$id')";
            $res = $db->exec($sql);
            return $res;
        }
        public static function check($username){
            $db = new MyDB();
            $sql = "SELECT ACTIVITY.ID AS ID,DESCRIBE,TIME,PLACE FROM `JOIN`,ACTIVITY WHERE `JOIN`.USERNAME='$username' AND `JOIN`.ACTIVITY=ACTIVITY.ID ";
            $res = $db->query($sql);
            return $res;
        }
        public static function quit($username,$id){
            $db = new MyDB();
            $sql = "DELETE FROM `JOIN` WHERE USERNAME = '$username' AND ACTIVITY = '$id'";
            $res = $db->exec($sql);
            return $res;
        }
        public static function isIn($username,$id){
            $db = new MyDB();
            $sql = "SELECT * FROM `JOIN` WHERE USERNAME = '$username' AND ACTIVITY=$id";
            $res = $db->query($sql);
            return $res;
        }
    }
?>