<?php
  session_start();
  $alert = '';
  if(!empty($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
  } 
  $_SESSION['snbox'] = range(1, 9);
  shuffle($_SESSION['snbox']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>汽車共乘網站管理</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/index.js"></script>
</head>
<body>
  <main>    
    <h1>汽車共乘網站管理&nbsp;&nbsp;&nbsp;--登入</h1>    
    <form action="login.php" method="post" id="login">
      <div style="padding-top: 30px;">
        <label for="account">帳號</label>
        <input type="text" name="account">
      </div>      
      <div style="padding-top: 30px;">
        <label for="password">密碼</label>
        <input name="password" type="password">
      </div>
      <div id="captcha" style="padding: 15px 15px 10px 15px;">
        <label for="ccaptcha">圖片驗證碼</label>
        <input name="ccaptcha" type="hidden">
        <div id="captcha-box" style="margin: 15px;"></div>
        <div id="captcha-img-box" style="margin: 10px;"></div>
        <input type="button" name="recaptcha" value="驗證碼重置" style="display: inline-block; font-size:15px;">
      </div>
      <input type="button" id="submitf" name="submitf" value="送出">
      <input type="reset" name="reset" value="重置">      
      <div id="nbox-container" style="display: none;">        
        <?php
          for($w = 0; $w < 9; ++$w)
            echo '
            <input type="checkbox" id="nbox'.$w.'" class="nbox-input" name="cnbox[]" value="'.$_SESSION['snbox'][$w].'">
            <label class="nbox" for="nbox'.$w.'"></label>';
        ?>
        <p style="font-size: 17px;color: white;">連成3格水平線、垂直線或是斜線時，按確定按鈕則可登入。</p>
      </div>
    </form>
  </main>
  <button id="enp" style="padding: 10px 15px;">電<br/>子<br/>報<br/>製<br/>作<br/>系<br/>統</button>
  <script>
    if('<?=$alert;?>' != '')      
      alert('<?=$alert;?>');
  </script>  
</body>
</html>