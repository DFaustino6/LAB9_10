<?php

include 'db.php';

// put full path to Smarty.class.php
require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->cache_dir = 'cache';
$smarty->config_dir = 'configs';

 if(isset($_REQUEST['ErrorType'])){
     $ErrorMsg=errorMsg($_REQUEST['ErrorType']);
     $Username=$_REQUEST['Username'];
     $Email=$_REQUEST['Email'];
  }

  function errorMsg($ErrorType){
   switch ($ErrorType) {
      case 0:
          //Erro resolvido pelo HTML
          $ErrorMsg = "Todos os campos devem ser preenchidos";
          break;
      case 1:
          $ErrorMsg = "Email já existe na base de dados"; 
          break;
        //Erro resolvido pelo HTML
      case 2:
          $ErrorMsg = "Email tem formato incorrecto";
          break;
      case 3:
          //Erro resolvido pelo HTML
          $ErrorMsg = "Password em branco";
          break;
      case 4:
          $ErrorMsg = "Passwords não coincidem";
          break;
    }
    return $ErrorMsg;
  }


     

  // faz a atribuição das variáveis do template smarty
  //$smarty->assign('posts',$tuple);
  $smarty->assign('MENU1',"SubForum1");
  $smarty->assign('MENU2',"SubForum2");
  $smarty->assign('MENU3',"SubForum3");
  $smarty->assign('FORUMName',"DAW Lab");
  $smarty->assign('MENU4',"Login");
  $smarty->assign('href4',"login.php");
  $smarty->assign('MENU5',"Register");
  $smarty->assign('Username',$Username);
  $smarty->assign('Email',$Email);
  $smarty->assign('Pwd',"");
  $smarty->assign('ConfPwd',"");
  $smarty->assign('ErrorMsg',$ErrorMsg);
  $smarty->assign('ErrorType',$_REQUEST['ErrorType']);
  $smarty->assign('href5',"register.php");
  $smarty->assign('href0',"index.php");
  
  // Mostra a tabela
  $smarty->display('register_template.tpl');
?>