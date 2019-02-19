<?php
session_start();
$alert="";
if(!empty($_SESSION['alert'])){
	$alert=$_SESSION['alert'];
	unset($_SESSION['alert']);
}
$_SESSION['snbox']=range(1,9);
shuffle($_SESSION['snbox']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<body>
<form style="text-align: center"; action="login2.php" id="form1" name="form1" method="post">
  <div style="text-align: center;" name="cach2" id="cach2">第二層驗證碼</div>
  <p></p>
  <?php
  for($w=1;$w<10;$w++){
    echo"
    <input type=\"checkbox\" id=\"ccsd".$w."\" name=\"ccsd[]\" value=\"".$w."\">
    <label for=\"ccsd".$w."\"></label>";
    if($w==3 || $w==6 || $w==9){
      echo '<br>';
    }
  }
  ?>
  <p></p>
  <input style="font-size: 19px" type="submit" name="submit" id="submit" value="送出">
  <input style="font-size: 19px" type="reset" name="reset" id="reset" value="重置">
  <input style="font-size: 19px" type="button" name="back" id="back" value="返回">
  <p>連成一條線即可登入</p>
</form>
<script src="cach2.js"></script>
<script>
if('<?php echo($alert) ?>' != ""){
  alert('<?php echo($alert); ?>');
}

</script>
</body>
</html>