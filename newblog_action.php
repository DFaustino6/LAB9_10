<?php
include 'db.php';
session_start();

require('libs/Smarty.class.php');
$smarty = new Smarty();
// ligação à base de dados
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
  // criar query numa string
  $PostId=$_GET['PostId'];
  $user_id=$_SESSION['id'];
  if(isset($_SESSION['username'])){
  	$content=$_REQUEST['postContent'];
  	$query  = "INSERT INTO microposts(user_id,content,created_at,updated_at) VALUES ('$user_id','$content',NOW(),NOW())";
  	$result= @ mysql_query($query,$db);
  	$smarty->assign('Msg', "SUCCESS: New post submitted");	
  	$smarty->assign('text_color',"green");
   	$smarty->assign('back_color',"#00d269");
  }
  else{
  	$smarty->assign('Msg', "ERROR: Login first");
  	$smarty->assign('text_color',"red");
   	$smarty->assign('back_color',"#ff9d9d");
  }
  mysql_close($db);

  $smarty->display('message_template.tpl');
 } 
?>