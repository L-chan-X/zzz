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
<form action="login.php" id="form1" name="form1" method="post">
	<p></p>
	<div style="text-align: center;font-size: 36px">汽車共乘管理網站-登入</div>
  <p style="text-align: center;font-size:20px">
    <label for="textfield">帳號 : </label>
    <input style="font-size: 19px" type="text" name="account" id="account">
  </p>
  <p style="text-align: center;font-size:20px">
    <label for="textfield2">密碼 : </label>
    <input style="font-size: 19px" type="password" name="password" id="password">
  </p>
  <p style="text-align: center;font-size:20px">
    <label for="textfield3">驗證碼:</label>
    <input style="font-size: 19px" type="text" name="cach" id="cach">
  </p>
	<p style="text-align: center;font-size:20px"><img src="image.php" id="image">
	  <input style="font-size: 19px" type="button" name="button2" id="button2" value="重設驗證碼">
  </p>
	<p style="text-align: center">
	  
	  <input style="font-size: 19px" type="submit" name="submit" id="submit" value="送出">
		
      <input style="font-size: 19px" type="reset" name="reset" id="reset" value="重設">
		
      <input style="font-size: 19px" type="button" name="button4" id="button4" value="電子報">
  </p>
</form>
<script src="git.js"></script>
<script>
	if ('<?php echo($alert) ?>' != "")
		alert("<?php echo($alert);?>");
</script>	
</body>
</html>
