

	<div class="panel panel-default ext-nodrop">
		<!-- Default panel contents -->
		<div class="panel-heading"><h3><?php foreach($args[1] as $usr) { echo $usr['login_user'] . ', '; } ?></h3></div>

		<!-- List group -->
		<ul class="list-group">
			<?php foreach($args[2] as $msg) { ?>
			<li class="list-group-item">
				<h4 class="list-group-item-heading"><?php echo $msg['login_user']; ?></h4>
				<p class="list-group-item-text"><?php echo $msg['payload_message']; ?></p>
			</li>
			<?php } ?>
		</ul>
	</div>

			<!-- List group -->
		<nav class="navbar navbar-default navbar-fixed-bottom">

			<div class="ext-spaced"><p>
					<form  role="form" method="post" action="?ctl=Discussion&act=push" class="input-group">
						<input type="text" name="payload" class="form-control" aria-label="...">
						<div class="input-group-btn dropup">
							<input type= "hidden" name="did" value= "<?php echo($args[3]); ?>" />
							<input role="button" class="btn btn-primary" type="submit" value="Send" />
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span></button>
							<ul class="dropdown-menu dropdown-menu-right" role="menu">
								<li><a href="?ctl=Discussion&act=add&did=<?php echo($args[3]); ?>">Add Friends</a></li>
								<li><a href="?ctl=Discussion&act=remove&did=<?php echo($args[3]); ?>">Remove Friends</a></li>
								<li class="divider"></li>
								<li><a href="?ctl=Discussion&act=leave&did=<?php echo($args[3]); ?>">Leave</a></li>
							</ul>
						</div>
					</form>
			</p></div>
		</nav>

