<?php
require '../model/healthService.class.php';
if(is_array($_GET)&&count($_GET)>0){
    if(isset($_GET["operation"])){
        if($_GET['operation']==1){
session_start();
$username = $_SESSION["username"];
$height=$_POST['height'];
$weight=$_POST['weight'];
$res=HealthService::addHW($username, $height, $weight);
echo  $res;
if($res){
    header("Location: http://localhost/healthyone/view/health.php?success=1");
    exit();
}
else{
    header("Location: http://localhost/healthyone/view/health.php?errno=1");
    exit();
}
        }
        else if($_GET['operation']==2){
            $date = $_POST['date'];
            header("Location: http://localhost/healthyone/view/sleep.php?date=$date");
            
        }
        else if($_GET['operation']==3){
            $date = $_POST['date'];
            header("Location: http://localhost/healthyone/view/exercise.php?date=$date");
        
        }
        else if($_GET['operation']==4){
            session_start();
            $username = $_SESSION["username"];
            $file =$username."_exercises.xml";
            if(substr($file,-4)==".xml"){
                $doc = new DOMDocument();
                if($doc->load( $file )){
                $exercises = $doc->getElementsByTagName( "exercise" );
                foreach( $exercises as $exercise )
                {
                    $usernames = $exercise->getElementsByTagName( "username" );
                    $username = $usernames->item(0)->nodeValue;
                    
                    
                    $createdays = $exercise->getElementsByTagName( "createday" );
                    $createday = $createdays->item(0)->nodeValue;
            
                    $runtimes = $exercise->getElementsByTagName( "runtime" );
                    $runtime = $runtimes->item(0)->nodeValue;
                    
                    $distances = $exercise->getElementsByTagName( "distance" );
                    $distance = $distances->item(0)->nodeValue;

                    $heats = $exercise->getElementsByTagName( "heat" );
                    $heat = $heats->item(0)->nodeValue;
                    $res = HealthService::addExercise($username, $createday, $runtime, $distance,$heat);
                }
                }
              
            }
            $file =$username."_sleeps.xml";
            if(substr($file,-4)==".xml"){
                $doc = new DOMDocument();
               if( $doc->load( $file )){
                $sleeps = $doc->getElementsByTagName( "sleep" );
                foreach( $sleeps as $sleep )
                {
                    $usernames = $sleep->getElementsByTagName( "username" );
                    $username = $usernames->item(0)->nodeValue;
            
            
                    $createdays = $sleep->getElementsByTagName( "createday" );
                    $createday = $createdays->item(0)->nodeValue;
            
                    $deeps = $sleep->getElementsByTagName( "deep" );
                    $deep = $deeps->item(0)->nodeValue;
            
                    $shallows = $sleep->getElementsByTagName( "shallow" );
                    $shallow = $shallows->item(0)->nodeValue;
                    
                    $clears = $sleep->getElementsByTagName( "clear" );
                    $clear = $clears->item(0)->nodeValue;
                    
                    $totals = $sleep->getElementsByTagName( "total" );
                    $total = $totals->item(0)->nodeValue;

                    $res = HealthService::addSleep($username, $createday, $deep, $shallow, $clear, $total);
                }
               }
            
            }
            header("Location: http://localhost/healthyone/view/health.php?isLoad=1");
        }
    }
}

?>