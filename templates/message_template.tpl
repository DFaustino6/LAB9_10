<!DOCTYPE html>
<hmtl>
<head>
	<title>FORUM</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<meta http-equiv="refresh" content="3; url=index.php">
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
	<div class="container-fluid text-center" style="background-color: {$back_color};border-radius:5px">
		<h4 style="color: {$text_color};">{$Msg}&nbsp;<span class="{$icon}"></span></h4>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>