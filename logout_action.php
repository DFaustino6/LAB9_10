<?php
include 'db.php';

require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);

session_start();

	if(isset($_COOKIE['autologin'])) {
    	$user_id = $_SESSION['id'];
    	$query = "UPDATE users
               SET remember_digest = null
               WHERE id = $user_id";          
        $result = @ mysql_query($query,$db);
    	unset($_COOKIE['autologin']);
	}

session_unset();
session_destroy();


   $smarty->assign('MENU4',"Login");
   $smarty->assign('MENU5',"Register");
   $smarty->assign('href4',"login.php");
   $smarty->assign('href5',"register.php");
   $smarty->assign('Msg',"See you back soon!");
   $smarty->assign('text_color',"black");
   $smarty->assign('back_color',"#ff9966");
   $smarty->assign('icon',"glyphicon glyphicon-log-out");

   $smarty->display('message_template.tpl');
?>