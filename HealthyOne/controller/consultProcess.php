<?php
require '../model/consultService.class.php';
if(is_array($_GET)&&count($_GET)>0){
    if(isset($_GET["operation"])){
        if($_GET['operation']==0){
            $consulted = $_POST['consulted'];
            $problem = $_POST['problem'];
            session_start();
            $username = $_SESSION["username"];
            $res = ConsultService::add($username,$consulted,$problem);
            header("Location: http://localhost/healthyone/view/consult_question.php?id=$consulted&success=1");
        }
        if($_GET['operation']==1){
            $id = $_POST['id'];
            $advice = $_POST['advice'];
            if(isset($_POST['uploadfile'])){
                $file = $_POST['uploadfile'];
                if(substr($file,-4)==".txt"){
                $myfile = fopen($file, "r") or die("Unable to open file!");
                $advice = fread($myfile,filesize("$file"));
                fclose($myfile);
                }
            }
            $res = ConsultService::advice($id,$advice);
            header("Location: http://localhost/healthyone/view/consultManage.php?");
        }
        if($_GET['operation']==2){
            if(isset($_POST['uploadfile'])){
                $file = $_POST['uploadfile'];
                if(substr($file,-4)==".xml"){
         $doc = new DOMDocument();
         $doc->load( $file );
         $advices = $doc->getElementsByTagName( "advice" );
         foreach( $advices as $advice )
            {
                 $users = $advice->getElementsByTagName( "user" );
                 $user = $users->item(0)->nodeValue;
                
                 $contents = $advice->getElementsByTagName( "content" );
                 $content = $contents->item(0)->nodeValue;
                 echo $user;
                 $res = ConsultService::advice($user,$content);
                 }
                 header("Location: http://localhost/healthyone/view/consultManage.php");
        }
            }
        }
    }
    
}
?>