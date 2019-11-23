<?php

include 'db.php';
session_start();
// put full path to Smarty.class.php
require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->cache_dir = 'cache';
$smarty->config_dir = 'configs';


// ligação à base de dados
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
  // criar query numa string
   $query  = "SELECT microposts.content, microposts.created_at, microposts.updated_at, users.name, microposts.upvotes,microposts.downvotes,microposts.id,microposts.user_id
             FROM microposts, users
             WHERE microposts.user_id = users.id
             ORDER BY microposts.updated_at DESC";
 
  // executar a query
  if(!($result = @ mysql_query($query,$db )))
   showerror();



  // vai buscar o resultado da query

  $nrows  = mysql_num_rows($result);
   for($i=0; $i<$nrows; $i++)
     $tuple[$i] = mysql_fetch_array($result,MYSQL_ASSOC);


  // faz a atribuição das variáveis do template smarty
  $smarty->assign('posts',$tuple);
  $smarty->assign('MENU1',"SubForum1");
  $smarty->assign('MENU2',"SubForum2");
  $smarty->assign('MENU3',"SubForum3");
  $smarty->assign('FORUMName',"DAW Lab");
  $smarty->assign('href0',"index.php");

  if(isset($_COOKIE['autologin'])){
    $cValue=$_COOKIE['autologin'];
    $query = "SELECT name, id 
             FROM users
             WHERE remember_digest ='$cValue'";
    $result = @ mysql_query($query,$db);
    $nrows  = mysql_num_rows($result);
    if($nrows > 0) {
      $tuple[0] = mysql_fetch_array($result,MYSQL_ASSOC);
      $_SESSION['username'] = $tuple[0]['name'];
      $_SESSION['id'] = $tuple[0]['id'];
    }
  }

  if(isset($_SESSION['username'])){

    $smarty->assign('MENU4',"Logout");
    $smarty->assign('MENU5',"Welcome"." ".$_SESSION['username']);
    $smarty->assign('href4',"logout_action.php");
    $smarty->assign('href5',"#");
    $smarty->assign('login_id',$_SESSION['id']);
    $smarty->assign('MENU6',"Blog");
    $smarty->assign('href6',"blog.php");
  }
  else{
    $smarty->assign('MENU4',"Login");
    $smarty->assign('MENU5',"Register");
    $smarty->assign('href4',"login.php");
    $smarty->assign('href5',"register.php");
  }
  // Mostra a tabela
  $smarty->display('index_template.tpl');

  // fechar a ligação à base de dados
  mysql_close($db);
} // end if
?>