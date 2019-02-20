<?php
  session_start();
  include_once("func.php");
  session_destroy();
  writelog("登出 成功", "index.php");
?>