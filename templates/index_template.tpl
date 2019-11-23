
<!DOCTYPE html>
<hmtl>
<head>
  <title>FORUM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .carousel-inner img {
            margin: auto;
        }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse" style="background-color: #006699; border-color: #006699">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="color: white" href="{$href0}">{$FORUMName}</a>
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
      <li><a href="{$href6}" style="color: white">{$MENU6}</a></li>
      <li><a href="{$href4}" style="color: white">{$MENU4}</a></li>
      <li><a href="{$href5}" style="color: white">{$MENU5}</a></li>
    </ul>
  </div>
</nav>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img1.png" >
    </div>

    <div class="item">
      <img src="img2.png" >
    </div>

    <div class="item">
      <img src="img3.png" >
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="container" style="padding-top: 2%">
  <div class="row">
    <div class="col-sm-2">
      <div class="well text-center">
        <a href="newblog_action.php"><img src="plus.png" style="width: 60%;" class="center"></a>
        <p>Add new post</p>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="well" >
        <div class="panel-group">
          {foreach item=post from=$posts}
          <div class="panel panel-default" style="background-color:#0099ff ">
            <div class="panel panel-heading" style="background-color:#0099ff">
              <div class="media">
                <div class="media-top">
                  <img src="img_avatar1.png" class="media-object" style="width:12%">
                </div>
              </div>
              <div class="row" style="padding: 1%" >
                <div class="col-sm-6">
                    <h4 style="color:white;">Created by:{$post.name}</h4>
                    {if $post.user_id eq $login_id}
                      <a href="blog.php?Post_id={$post.id}" role="button" class="btn btn-success" style="width: 35%"><span class="glyphicon glyphicon-edit"></span>&nbsp;Update</a>
                    {/if}
                </div>
                <div class="col-sm-6">
                  <h4 style="color:white;text-align: right">Last updated:{$post.updated_at}</h4>
                </div>
              </div>
            </div>
            <div class="panel-body" style="background-color: white;border-style:solid;border-width: thin;border-radius:5px">
                <h4 style="color: black">{$post.content}</h4>
            </div>
            <div class="panel-footer" style="background-color:#0099ff">
              <div class="row" style="padding: 1%; "> 
                <div class="col-sm-10">
                  <h4 style="color: white"> Created:{$post.created_at}</h4>
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-success" style="width: 90%"><span class="glyphicon glyphicon-arrow-up"></span>&nbsp;{$post.upvotes}</button>
                          
                        <button type="button" class="btn btn-danger" style="width: 90%"> <span class="glyphicon glyphicon-arrow-down"></span>&nbsp;{$post.downvotes}</button>
                      </div>  
                    </div>
                  </div>  
          </div>
          {/foreach}
        </div>
      </div>  
    </div>
    <div class="col-sm-2">
      <div class="well text-center">
        <a href="#" style="font-size: 4em"><span  class="glyphicon glyphicon-bell" ></span></a>
        <p>Notification</p>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>