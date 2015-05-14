<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- BOOTSTRAP Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="./v/core/ext.css">
</head>

<body>

	<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="?">PWEB - CHAT</a>
        </div>
      </div>
    </nav>

	<div class="container">

		<?php if(isset($args[1]) && $args[1] != NULL) { ?>
		<!-- ALERT HERE --> 
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  			<span class="sr-only">Error:</span><?php echo $args[1]; ?>
		</div>
		<!-- /ALERT -->
		<?php } ?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Please authenticate yourself</h3>
			</div>
			<div class="panel-body">
				<!-- FORM HERE -->



				<form role="form" action="?ctl=Sign&act=log_redirect" method="post">
					<div class="form-group">
						<label for="login">Login:</label>
						<input type="text" class="form-control" name="login" id="login" placeholder="Enter login">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password">
					</div>
					<input type="submit" name="redirect" value="Log In" class="btn btn-success" />
					<input type="submit" name="redirect" value = "Sign Up" class="btn btn-primary" />
				</form>


				<!-- /FORM -->
			</div>
		</div>

	</div>

	<!-- JQUERY -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- BOOTSTRAP Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>

</html>