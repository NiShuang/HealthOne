<?php
require"SQLiteHelper.php";
class HealthService{
    public static function addHW($username,$height,$weight){
        $db = new MyDB();
        $sql = "SELECT * FROM HW WHERE USERNAME='$username' AND CREATEDAY=date('now') ";
        $res = $db->query($sql);
        if($item = $res->fetchArray(SQLITE3_ASSOC) ){
            $sql1 = "UPDATE HW SET HEIGHT='$height',WEIGHT='$weight' WHERE USERNAME='$username' AND CREATEDAY=date('now') ";
            return $db->exec($sql1);
            }
        else $sql1 = "INSERT INTO HW (USERNAME,CREATEDAY,HEIGHT,WEIGHT) VALUES ('$username',date('now'),'$height','$weight')";
        return $db->exec($sql1);
    }
    
    public static function findHW($username){
        $db = new MyDB();
        $sql = "SELECT HEIGHT,WEIGHT FROM HW WHERE USERNAME='$username' AND CREATEDAY IN (SELECT max(CREATEDAY) FROM HW WHERE USERNAME='$username')";
        return $db->query($sql);
    }
    
    public static function weightChange($username){
        $db = new MyDB();
        $sql = "SELECT WEIGHT FROM HW WHERE USERNAME='$username' AND CREATEDAY IN (SELECT max(CREATEDAY) FROM HW WHERE USERNAME='$username')";
        $res = $db->query($sql);
        if($item = $res->fetchArray(SQLITE3_ASSOC) ){
            $now = $item['WEIGHT'];
            $sql1 = "SELECT WEIGHT FROM HW WHERE USERNAME='$username' AND CREATEDAY IN (SELECT min(CREATEDAY) FROM HW WHERE USERNAME='$username')";
            $res1 = $db->query($sql1);
            $item1 = $res1->fetchArray(SQLITE3_ASSOC);
            $before = $item1['WEIGHT'];
            return $now-$before;
        }
        return 0;
    }
    public static function findExercise($username){
        $db = new MyDB();
        $sql = "SELECT * FROM EXERCISE WHERE USERNAME='$username' AND CREATEDAY = date('now')";
        return $db->query($sql);
    }
    public static function addExercise($username,$createday,$runtime,$distance,$heat){
        $db = new MyDB();
        
        
        $sql = "SELECT * FROM EXERCISE WHERE USERNAME='$username' AND CREATEDAY='$createday' ";
        $res = $db->query($sql);
        if($item = $res->fetchArray(SQLITE3_ASSOC) ){
            $sql1 = "UPDATE EXERCISE SET RUNTIME='$runtime',DISTANCE='$distance',HEAT='$heat' WHERE USERNAME='$username' AND CREATEDAY='$createday' ";
            return $db->exec($sql1);
        }
        else $sql1 = "INSERT INTO EXERCISE(USERNAME ,CREATEDAY,RUNTIME,DISTANCE,HEAT) VALUES('$username','$createday','$runtime','$distance','$heat')";
        return $db->exec($sql1);
    }
    
    public static function addSleep($username,$createday,$deep,$shallow,$clear,$total){
        $db = new MyDB();
        $sql = "SELECT * FROM SLEEP WHERE USERNAME='$username' AND CREATEDAY='$createday' ";
        $res = $db->query($sql);
        if($item = $res->fetchArray(SQLITE3_ASSOC) ){
            $sql1 = "UPDATE SLEEP SET DEEP='$deep',SHALLOW='$shallow',CLEAR='$clear',TOTAL='$total' WHERE USERNAME='$username' AND CREATEDAY='$createday' ";
            return $db->exec($sql1);
        }
        else  $sql1 = "INSERT INTO SLEEP(USERNAME ,CREATEDAY,DEEP,SHALLOW,CLEAR,TOTAL) VALUES('$username','$createday','$deep','$shallow','$clear','$total')";
            
        return $db->exec($sql1);
        

    }
    public static function findExerciseByDate($username,$date){
        $db = new MyDB();
        $sql = "SELECT * FROM EXERCISE WHERE USERNAME='$username' AND CREATEDAY =  '$date'";
        return $db->query($sql);
    }
    public static function findSleep($username){
        $db = new MyDB();
        $sql = "SELECT * FROM SLEEP WHERE USERNAME='$username' AND CREATEDAY = date('now')";
        return $db->query($sql);
    }
    public static function findSleepByDate($username,$date){
        $db = new MyDB();
        $sql = "SELECT * FROM SLEEP WHERE USERNAME='$username' AND CREATEDAY = '$date'";
        return $db->query($sql);
    }
    public static function findAllExercise($username){
        $db = new MyDB();
        $sql = "SELECT sum(RUNTIME) as RUNTIME,sum(DISTANCE) as DISTANCE,sum(HEAT) as HEAT FROM EXERCISE WHERE USERNAME='$username'";
        return $db->query($sql);
    }
}
?>