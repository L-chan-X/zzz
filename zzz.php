<?php
session_start();
$alert="";
if(!empty($_SESSION['alert'])){
	$alert=$_SESSION['alert'];
	unset($_SESSION['alert']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
	<script>
	if ('<?php echo($alert) ?>' != "")
			alert("<?php echo($alert);?>");
	</script>	
</body>
</html>