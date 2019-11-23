<?php
include 'db.php';

require('libs/Smarty.class.php');
$smarty = new Smarty();

// ligação à base de dados
session_start();
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
  // criar query numa string
  $PostId=$_GET['Post_id'];
  if(isset($_GET['Post_id'])){
 	 $query  = "SELECT * FROM microposts WHERE id='$PostId'";
 	  	 if(!($result = @ mysql_query($query,$db)))
   			showerror();
   	 $nrows  = mysql_num_rows($result);
   	 
   	 if(isset($_SESSION['username']) && $nrows>0){
   	 	$content=$_REQUEST['postContent'];
  		$query  = "UPDATE microposts SET content='$content', updated_at=NOW() WHERE id='$PostId'";

  		$result= @ mysql_query($query,$db);
  		$smarty->assign('Msg', "SUCCESS: Post updated");	
  		$smarty->assign('text_color',"green");
   		$smarty->assign('back_color',"#00d269");
  	 }
  }
  else{
  	$smarty->assign('Msg', "ERROR: Not allowed");
  	$smarty->assign('text_color',"red");
   	$smarty->assign('back_color',"#ff9d9d");
  }
mysql_close($db);

$smarty->display('message_template.tpl');
} 

?>