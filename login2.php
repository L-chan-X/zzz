<?php
session_start();
define('secdic',explode(" ","123 456 789 147 258 369 159 357"));
$ccsd=join($_POST['ccsd']);
$act=$_SESSION['account'];
$pwd=$_SESSION['password'];
if(++$_SESSION['times']>=2){
    if($act != ""){
        if($pwd != ""){
            if(in_array($ccsd,secdic)){
                $_SESSION['times']=0;
                gourl("登入成功","backstage.php");
            }else{
                gourl("二步驗證碼錯誤","index.php");
            }
        }else{
            gourl("帳號密碼錯誤","index.php");
        }
    }else{
        gourl("帳號密碼錯誤","index.php");
    }
}else{
    gourl("錯誤超過三次","loginlose.php");
}
if($act != ""){
    if($pwd != ""){
        if(in_array($ccsd,secdic)){
            $_SESSION['times']=0;
            gourl("登入成功","backstage.php");
        }else{
            gourl("二步驗證碼錯誤","index.php");
        }
    }else{
        gourl("帳號密碼錯誤","index.php");
    }
}else{
    gourl("帳號密碼錯誤","index.php");
}

function gourl($test,$url){
    $_SESSION['alert']=$test;
    header('location:'.$url);
    exit;
}
?>