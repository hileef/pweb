	<div class="container">

		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<h3 class="panel-title">Discussions Available</h3>
			</div>

			<!-- List group -->
			<ul class="list-group">
				<?php foreach($args[1] as $disc) { ?>
				<a href="?ctl=Discussion&act=display&did=<?php echo $disc[0]; ?>" class="list-group-item">
					<span class="badge"><?php echo $disc[0]; ?></span>
					<?php foreach ($disc['usr_ary'] as $usr) { echo($usr['login_user']); ?>, <?php }; ?></a>
				<?php } ?>
				<a href="?ctl=Discussion&act=create" class="list-group-item list-group-item-success">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create </a>
			</ul>
		</div>

	</div>