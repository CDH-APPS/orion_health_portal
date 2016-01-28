<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Phoenix Health Ltd. - Administrator Portal</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	</head>
<body >

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		Phoenix Health Insurance Ltd.
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a href="#">
							Help Line
						</a></li>

						

						<li><a href="#">
							Forgot your password?
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="iniwrapper wrapper">
		<div class="container" align="center" >
			<div class="row" >
				<div class="module module-login span4 offset4" >
					<form class="form-vertical" method="get" action="/AdminLogin">
						<div class="module-head">
							<h3>Administrator - Login</h3>
						</div>
						<br>
						<p>
						<img src="images/logo.png" width="200" height="100" align="center"> 
						</p>

						<div class="module-body" style="height:150px">
							<div class="control-group">
								<div class="controls row-fluid">
							<input style="font-size:15px; padding:25px;" class="span12" type="text" id="username" name="username" placeholder="Username">
								</div>
							</div>

							
							<div class="control-group">
								
								<div class="controls row-fluid">
									<input style="font-size:15px; padding:25px;" class="span12" type="password" id="password" name="password" placeholder="Password">
								</div>
							</div>
							<p></p>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right">Login</button>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<label class="checkbox pull-left" >
										<input type="checkbox"> Remember me
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div><!--/.wrapper-->

	<div class="footer" style="background:white">
		<div class="container">
			 

			<b class="copyright">&copy; <?php echo date('Y'); ?> Phoenix Health Insurance. </b> All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

 <script type="text/javascript" src="scripts/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("images/login-bg.png", {speed: 500});
    </script>

	
