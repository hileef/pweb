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
			<h3 class="panel-title">Update your password</h3>
		</div>
		<div class="panel-body">
			<!-- FORM HERE -->



			<form role="form" action="?ctl=User&act=password" method="post">
				<div class="form-group">
					<label  for="oldpw" tabindex="1" > Your old password : </label> 
					<input name="oldpw" class="form-control" type="password" required="required" />
				</div>
				<div class="form-group">
					<label  for="newpw" tabindex="2" > Your new password : </label> 
					<input name="newpw" class="form-control" type="password" required="required" />
				</div>
				<div class="form-group">
					<label  for="cpypw" tabindex="3" > Confirm your new password : </label> 
					<input name="cpypw" class="form-control" type="password" required="required" />
				</div>
				<input type="submit" name="redirect" value = "OK" class="btn btn-primary" />
			</form>


			<!-- /FORM -->
		</div>
	</div>

</div>