<?php
  session_start();
  include_once 'func.php';
  define('secdic', explode(' ', '123 456 789 147 258 369 357 159'));
  define('userper', ['一般使用者', '一般管理員', '超級管理員']);
  $account = $_POST['account'];
  $password = $_POST['password'];
  $ccaptcha = $_POST['ccaptcha'];
  for ($w = 0; $w < 4; ++$w) {
    $ccaptcha[$w] = $_SESSION['captcha'][$ccaptcha[$w]];
  }
  sort($_SESSION['captcha']);
  $scaptcha = join($_SESSION['captcha']);
  unset($_SESSION['captcha']);
  $cnbox = $_POST['cnbox'];
  sort($cnbox);
  $cnbox = join($cnbox);
  //if(++$_SESSION[$account] > 2)
  //gourl("登入3次以上，登入失敗！", "index.php");
  $db = new mysqli('localhost', 'admin', '1234', 'jnjs');
  $db->query('SET NAMES `UTF8`');
  $sql = "SELECT * FROM `jnjs` WHERE `account` = '".$account."' AND `password` = '".$password."'";
  if ($result = $db->query($sql)) {
    if ($ccaptcha == $scaptcha) {
      if (in_array($cnbox, secdic)) {
        $row = $result->fetch_array();
        $_SESSION['user'] = [
          'id' => $row['id'],
          'name' => $row['name'],
          'account' => $row['account'],
          'password' => $row['password'],
          'permission' => [$row['permission'], userper[$row['permission'] - 1]],
        ];
        writelog('登入 成功！', 'maneger.php');
      } else {
        writelog('登入 失敗', 'index.php', '第二層驗證錯誤！');
      }
    } else {
      writelog('登入 失敗', 'index.php', '驗證碼錯誤！');
    }
  } else {
    writelog('登入 失敗', 'index.php', '帳號密碼錯誤！');
  }
