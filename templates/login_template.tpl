<!DOCTYPE html>
<hmtl>
<head>
	<title>FORUM</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-inverse" style="background-color: #006699; border-color: #006699">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" style="color: white" href="{$href}">{$FORUMName}</a>
		</div>
		<ul class="nav navbar-nav navbar-left">
	    	<li class="dropdown table-bordered" ><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white; background-color: #006699">Menu&nbsp;<span class="caret"></span></a>
	    		<ul class="dropdown-menu">
	    			<li><a href="#">{$MENU1}</a></li>
	    			<li><a href="#">{$MENU2}</a></li>
	    			<li><a href="#">{$MENU3}</a></li>
	    		</ul>	
	    	</li>
	    	<li>
	    		<form class="navbar-form nav-letf" action="/action_page.php">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search">
						<div class="input-group-btn">
      						<button class="btn btn-default" type="submit">
        						<i class="glyphicon glyphicon-search"></i>
      						</button>
    					</div>
					</div>
				</form>
	    	</li>
        </ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{$href4}" style="color: white">{$MENU4}</a></li>
			<li><a href="#" style="color: white">{$MENU5}</a></li>
		</ul>
	</div>
</nav>
<div class="container" style="padding-top: 1%">
	<div class="well">
		<div class="container-fluid text-center" style="background-color: #0099ff;border-radius:5px">
			<h3 style="color: white;">Login</h3>
		</div>
		<div class="container-fluid text-left" style="padding-top: 0.5%;border-radius: 5px">
			 <form class="form-horizontal" action="login_action.php">
			 	<div class="form-group">
			      <label class="control-label col-sm-2" for="email">Email:</label>
			      <div class="col-sm-10">
			        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
			      </div>
			    </div>
			    <div class="form-group">
			      <label class="control-label col-sm-2" for="pwd">Password:</label>
			      <div class="col-sm-10">          
			        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
			      </div>
			    </div>
			     <div class="form-group">        
			      <div class="col-sm-offset-2 col-sm-10">
			        <div class="checkbox">
			          <label><input type="checkbox" name="autologin" value="1">Remember me.</label>
			        </div>
			      </div>
			    </div>
			    <div class="form-group">        
			      <div class="col-sm-offset-2 col-sm-10">
			        <button type="submit" class="btn btn-default">Sign in</button>
			      </div>
			    </div>
  			</form>
		</div>
		<div class="container-fluid text-right">
			<a href="password_reset.php"><p>Forgot your password?</p></a>
			<a href="#"><p>Forgot your username?</p></a>
		</div>
		{if $isWrong eq 1}
		<div class="container-fluid text-center" style="background-color: #ff9d9d;border-radius:5px">
			<h4 style="color: red;">{$ErrorMsg}</h4>
		</div>
		{/if}
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>