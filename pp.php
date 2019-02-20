<?php
session_start();
$alert="";
if(!empty($_SESSION['alert'])){
	$alert=$_SESSION['alert'];
	unset($_SESSION['alert']);
}
$id;
$name;
$account;
$password;
$permission;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<form id="form1" name="form1" method="post">
	<div style="text-align: center;font-size: 36px">管理者專區<div style="text-align: right;font-size: 12px">admin</div></div>
</form>
<script>
  if ('<?php echo($alert) ?>' != "")
	alert("<?php echo($alert);?>");
</script>
</body>
</html>