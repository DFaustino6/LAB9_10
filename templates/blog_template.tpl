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
			<a class="navbar-brand" style="color: white" href="{$href0}">{$FORUMName}</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="{$href1}" style="color: white">{$MENU1}</a></li>
		</ul>
	</div>
</nav>
<div class="container" style="padding-top: 1%">
	<div class="container-fluid well">
        <form class="form-vertical" action="{$Action}" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-3" for="post" style="font-size: x-large">{$ActionPost} your post:</label>
              <div>
                <textarea rows="5" class="form-control" id="post" name="postContent" style="resize: vertical;">{$Post_content}</textarea>
              </div>
            </div>
            <div class="form-group" style="padding-top: 1%">
              <button type="submit" name="submit" class="btn btn-success btn-lg">Post</button>
              <a href="index.php" role="button" name="cancel" class="btn btn-danger btn-lg">Cancel</a>
            </div>
        </form>
    </div>
</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>