<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/sleep.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/jquery.movebg.js"></script>
<script src="../js/highcharts.js"></script>
<script src="../laydate/laydate.js"></script>
<style>
a,a:hover{ text-decoration:none;}
.box{width:970px; padding:0px 20px; background-color:#fff; margin:10px auto;}
.box a{padding-right:20px;}
.demo6{margin:25px 0;}
.layinput{height: 22px;line-height: 22px;width: 150px;margin: 0;border:1px #000 solid;font-size:15px;}
</style>
</head>

<body>
<?php 
    session_start();
    $username = $_SESSION["username"];
    $total=0;
    $deep=0;
    $shallow=0;
    $clear=0;
    $rate=0;
    
    require '../model/healthService.class.php';
    

    
    
    $res = HealthService::findSleep($username);
    if($item = $res->fetchArray(SQLITE3_ASSOC) ){
        $total = $item['TOTAL'];
        $deep = $item['DEEP']; 
        $shallow = $item['SHALLOW'];
        $clear = $item['CLEAR'];
    }
    
    if(is_array($_GET)&&count($_GET)>0){
        if(isset($_GET["date"])){
            if($_GET['date']!=""){
                $res = HealthService::findSleepByDate($username,$_GET['date']);
                if($item = $res->fetchArray(SQLITE3_ASSOC) ){
                    $total = $item['TOTAL'];
                    $deep = $item['DEEP'];
                    $shallow = $item['SHALLOW'];
                    $clear = $item['CLEAR'];
                }
            }
        }
    }
    
    if($total>0){
        $rate = round(($deep+$shallow)*1.0/$total,2)*100;
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
      		<li class="menu-item"><a href="http://localhost/healthyone/view/health.php">身体健康</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/exercise.php">运动情况</a></li>
            <li class="menu-item_cur"><a href="http://localhost/healthyone/view/sleep.php">睡眠分析</a></li>

        </ul>
    </div>
</div>
<div class="content">
<div class="box">

<form name="date" method="post" action="http://localhost/healthyOne/controller/healthProcess.php?operation=2" onsubmit="return check()">
<div class="demo6">
   <input readonly class="layinput" id="hello1" name="date" ></input>
   <div class="laydate-icon " onClick="laydate({elem: '#hello1'});" style="width:10px;display:inline-block;border:none;"></div>
   <input id="check_btn" type="submit" name="check" value="查询"/>
</div>
</form>
</div>
	<div class="bmi"><div class="item1">你当天的睡眠状况： 睡眠时长<b> <?php echo $total?> </b>小时</div>
	<div class="item3" style="margin-left: 300px">有效睡眠 <b><?php echo ($deep+$shallow)?></b> 小时 </div>

		
		
	<div class="deep_rate" style="margin-left: 680px;margin-top:20px">睡眠有效率<span style="font-size:40px"><b><?php echo $rate?></b>%</span> </div>
	


</div>
<br></br>
<div id="container" style="width: 550px; height: 400px; margin: 0 auto"></div>
</div>
<script type="text/javascript">  
        function check(){  
            var date=window.document.getElementById("hello1").value;  

            if (date == "") 
            {  
                window.alert("请选择日期!");  
                return false;  
            }
            return true;  
        }  
</script> 
<script language="JavaScript">
$(document).ready(function() {  
   var chart = {
       plotBackgroundColor: null,
       plotBorderWidth: null,
       plotShadow: false
   };
   var title = {
      text: '睡眠时间分布图'   
   };      
   var tooltip = {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
   };
   var plotOptions = {
      pie: {
         allowPointSelect: true,
         cursor: 'pointer',
         dataLabels: {
            enabled: true,
            format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
            style: {
               color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
            }
         }
      }
   };
   var series= [{
      type: 'pie',
      name: 'Browser share',
      data: [
         ['深度睡眠',   <?php echo $deep?>],
         ['浅度睡眠',      <?php echo $shallow?>],
         [ '清醒时间', <?php echo $clear?>],

      ]
   }];     
      
   var json = {};   
   json.chart = chart; 
   json.title = title;     
   json.tooltip = tooltip;  
   json.series = series;
   json.plotOptions = plotOptions;
   $('#container').highcharts(json);  
});
</script>
<script>
!function(){
laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
laydate({elem: '#demo'});//绑定元素
}();
//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);
//自定义日期格式
laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});
//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
</script>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
