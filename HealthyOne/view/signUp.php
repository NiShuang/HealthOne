<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Healthy One</title>
<meta name="description" content="slick Login">
<meta name="author" content="Webdesigntuts+">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/placeholder.js"></script>
</head>
<body>

	<form id="slick-login" action="http://localhost/HealthyOne/controller/signUpProcess.php?type=1" method="post" onsubmit="return check()">
		<p class="tittle">注册</p>
		<label for="username">username</label><input type="text" id="username" name="username" class="placeholder" placeholder="username">
		<label for="password">password</label><input type="password" id="password" name="password" class="placeholder" placeholder="password">
		<input type="submit" value="Sign Up">
		<br></br>
		<p>已有登录账号？<a href="http://localhost/healthyone/index.php">[立即登录]</a></p>
		<br></br>
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==0){
		          echo "<p style= 'color: red'>用户名已存在！</p>";
		       }
		    }
		}
		?>
	</form>
	<script type="text/javascript">  
        function check(){  
            var nameValue=window.document.getElementById("username").value;  
            var password=window.document.getElementById("password").value; 
            if (nameValue == "") 
            {  
                window.alert("用户名不能为空!");  
                return false;  
            }  
            if (password == "") 
            {  
                window.alert("密码不能为空!");  
                return false;  
            }  
            return true;  
        }  
     </script>  
</body>
</html>