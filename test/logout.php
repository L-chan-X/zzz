<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  include_once 'func.php';
  writelog('登出 成功', 'index.php');
