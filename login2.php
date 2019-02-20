<?php
session_start();
define('secdic',explode(" ","123 456 789 147 258 369 159 357"));
define('userper',['一般使用者','一般管理者','超級管理者']);
$ccsd=join($_POST['ccsd']);
$act=$_SESSION['account'];
$pwd=$_SESSION['password'];
$zz=new mtsqli('localhost','admin','1234','mysql');
$zz->query("SET NAMES `UTF8`");
$sql = "SELECT * FROM `mysql` WHERE `account` = '".$act."' AND `password` = '".$pwd."'";
if($result = $zz ->query($sql)){
    if(++$_SESSION['times']>=2){
        if($act != ""){
            if($pwd != ""){
                if(in_array($ccsd,secdic)){
                    $row= $result->fetch_array();
                    $_SESSION['user']=array(
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "account" => $row['account'],
                        "password"=> $row['password'],
                        "permission" => [$row['permission'] , userper[$row['permission'] - 1 ]]
                    );    
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
}
if($result = $zz ->query($sql)){
    if($act != ""){
        if($pwd != ""){
            if(in_array($ccsd,secdic)){
                $row= $result->fetch_array();
                    $_SESSION['user']=array(
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "account" => $row['account'],
                        "password"=> $row['password'],
                        "permission" => [$row['permission'] , userper[$row['permission'] - 1 ]]
                    );    
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
    
}

function gourl($test,$url){
    $_SESSION['alert']=$test;
    header('location:'.$url);
    exit;
}
?>