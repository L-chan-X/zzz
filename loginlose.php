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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<body>
<input type="button" name="button" id="button" value="返回首頁">
<script>$("#button").on('click',function(){
  location.href="index.php";
});
</script>
<script>
  if ('<?php echo($alert) ?>' != "")
	alert("<?php echo($alert);?>");
</script>
</body>
</html>