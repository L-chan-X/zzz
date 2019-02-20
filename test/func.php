<?php
   if (!isset($_SESSION)) {
     session_start();
   }
  date_default_timezone_set('Asia/Taipei');
   function writelog($text, $url, $optxt = null) {
     file_put_contents(
     'log.ini',
     '編號:['.$_SESSION['user']['id'].
   '] 帳號:['.$_SESSION['user']['account'].
   '] 姓名:['.$_SESSION['user']['name'].'] ['.
  date('Y.m.d/H.i.s').'] ['.
  $text."]\n",
     FILE_APPEND
  );
     gourl($optxt ?? $text, $url);
     exit;
   }
  function gourl($text, $url) {
    $_SESSION['alert'] = $text;
    header('Location: '.$url);
    exit;
  }
