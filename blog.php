<?php
include 'db.php';
require('libs/Smarty.class.php');
$smarty = new Smarty();

session_start();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$PostId=$_GET['Post_id'];
$user_id=$_SESSION['id'];

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db){
   $query  = "SELECT content FROM microposts WHERE user_id ='$user_id' AND id='$PostId'";
   $result = @ mysql_query($query,$db);
   $nrows  = mysql_num_rows($result);
   $tuple[0] = mysql_fetch_array($result,MYSQL_ASSOC);
   if($nrows>0) {
    $smarty->assign('Post_content',$tuple[0]['content']);
   } 
}
mysql_close($db);
  
  $smarty->assign('FORUMName',"DAW Lab");
  $smarty->assign('href0',"index.php");
  $smarty->assign('MENU1',"Blog");
  $smarty->assign('href1',"blog.php");
  $smarty->assign('ActionPost',"Write");
  
 
  if(isset($_GET['Post_id']))
    $smarty->assign('Action',"updateblog_action.php?Post_id=$PostId");
  else
    $smarty->assign('Action',"newblog_action.php");

  $smarty->display('blog_template.tpl');
?>