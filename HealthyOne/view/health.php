<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/content.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/jquery.movebg.js"></script>

</head>

<body>
  
<?php 
// if(!(is_array($_GET)&&count($_GET)>0&&isset($_GET["isLoad"]))){
//     header("Location: http://localhost/healthyone/controller/healthProcess.php?operation=4");
    
// }

    session_start();
    $username = $_SESSION["username"];
    $height=0;
    $weight=0;
    $bmi=0;
    $perfectWeight = 0;
    $condition = "";
    require '../model/healthService.class.php';
    $res = HealthService::findHW($username);
    if($item = $res->fetchArray(SQLITE3_ASSOC) ){
        $height = $item['HEIGHT'];
        $weight = $item['WEIGHT']; 
    }
    $perfectWeight = round(22.0*$height*$height/10000,1);
    if($height>0){
        $bmi=round($weight/($height*$height)*10000.0,1);
    }
    $weightChange = HealthService::weightChange($username);
    if($bmi!=0){
        if($bmi<18.5)
            $condition = "(偏轻)";
        elseif($bmi>=18.5&&$bmi<24)
            $condition = "(健康)";
        elseif($bmi>=24&&$bmi<28)
            $condition = "(超重)";
        elseif($bmi>=28)
            $condition = "(肥胖)";
    }
?>
<div class="wraper">
    <div class="nav">
        <ul>

            <li class="nav-item cur"><a href="http://localhost/healthyone/view/health.php">健康</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/activity.php">活动</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/consult.php">咨询</a></li> 
            <li class="nav-item"><a href="http://localhost/healthyone/view/setting.php">设置</a></li>          		
            <li class="nav-item" id="welcome"><img class="avata" src="http://localhost/HealthyOne/img/avata.jpg"  alt="头像" /> <?php echo $username?>
            	<ul class="nav_submenu">
       				 <li class="nav_submenu-item"> <a href="http://localhost/healthyone/index.php">退出</a></li>
      			</ul>
     		</li> 
        </ul>
        <div class="move-bg"></div>        
    </div>
</div>
<div class="daohang">
	<div class="menu">
    	<ul>
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/health.php">身体健康</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/exercise.php">运动情况</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/sleep.php">睡眠分析</a></li>

        </ul>
    </div>
</div>
<div class="content">
	<form class="weightAndheight" name="weightAndheight" method="post" action="http://localhost/healthyOne/controller/healthProcess.php?operation=1">
		<div class="item"><b>身高</b><input id="weight_input" type="text" name="height" value="<?php echo $height?>"/><b> 厘米</b></div>		
		<div class="item"><b>体重</b><input id="height_input" type="text" name="weight" value="<?php echo $weight?>"/><b> 公斤</b></div>
		<div><input id="save_btn" type="submit" name="submit" value="保存"/></div>
	</form>	
	<div class="bmi"><div class="item1">你的BMI值为：<b> <?php echo $bmi." ".$condition?></b></div>
	<div class="item1">你的理想体重为：<b> <?php echo $perfectWeight?></b> kg</div>
	<img class="bmiStandard" src="http://localhost/HealthyOne/img/bmi.png"  alt="bmi" />
	<span class="bmiword" style="margin-left: 55px;">偏轻</span>
	<span class="bmiword" style="margin-left: 75px;">健康 </span>
	<span class="bmiword" style="margin-left: 130px;">超重  </span>
	<span class="bmiword" style="margin-left: 110px;">肥胖</span>
		</div>	
		<br></br>
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==0){
		          echo "<p style= 'color: red; margin-left:80px'>保存失败！</p>";
		       }
		    }
		    else if(isset($_GET["success"])){
		        if($_GET['success']==1){
		            echo "<p style= 'color: red; margin-left:80px'>保存成功！</p>";
		        }
		    }
		}
		?>	
		<p class="item2">“自加入网站至今，你<?php
		if($weightChange<0)
		    echo "减重".(0-$weightChange)."公斤";
		elseif ($weightChange>0)
		    echo "增重".$weightChange."公斤";
		else 
		    echo "的体重没有变化"
		    ?>”</p>

</div>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
