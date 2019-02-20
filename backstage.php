<?php
session_start();
$alert="";
if(!empty($_SESSION['alert'])){
	$alert=$_SESSION['alert'];
	unset($_SESSION['alert']);
}
$id = $_SESSION['user']['id'];
$name = $_SESSION['user']['name'];
$account = $_SESSION['user']['account'];
$password = $_SESSION['user']['password'];
$permission = $_SESSION['user']['permission'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
<div style="text-align: center;font-size: 36px">後台管理系統</div>
<div style="text-align: center">專區</div>
<p style="text-align: center">
<input style="text-align: center" type="button" name="logout" id="logout" value="登出">
</p>
<div style="text-align: center">使用者名稱: <?php echo "$name" ?></div>
<div style="text-align: center">帳號: <?php echo "$account" ?></div>
<p id="time" style="text-align: center">
<input type="button" name="timeset" id="timeset" value="設定計時">
<p style="text-align: center">
倒數計時:60</p>
<p style="text-align: center">
<input style="text-align: center" type="button" name="timereset" id="timereset" value="重置計時">
</p>
<p style="text-align: center">
<input type="button" name="adduser" id="adduser" value="新增使用者">
</p>
<p style="text-align: center">
<input type="button" name="record" id="record" value="紀錄">
</p>
<p style="text-align: center">
<input type="search" name="search" id="search" value="搜尋">
<input type="button" name="searchB" id="searchB" value="確定">
</p>
<p>
<table>
<th>編號</th>
<th>名稱</th>
<th>帳號</th>
<th>密碼</th>
<th>權限</th>
</table>
</p>
<script src="bks.js"></script>
<script>
	if ('<?php echo($alert) ?>' != "")
			alert("<?php echo($alert);?>");
</script>	
</body>
</html>