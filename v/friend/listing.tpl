<div class="container">

	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<h3 class="panel-title">Your Friends</h3>
		</div>

		<!-- List group -->
		<ul class="list-group">
			<?php foreach($args[1] as $value) { ?>
			<li href="#" class="list-group-item">
				<a href='./index.php?ctl=Friend&act=remove&id=<?php echo($value[2]); ?>' role="button" class="btn-sm btn-default">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
				<span class="badge"><?php switch($value[1]) {
					case 0: echo " Offline "; break;
					case 1: echo " Online "; break;
					case 2: echo " Busy "; break;
				} ?></span> <?php echo($value[0]); ?> </li>
			<?php } ?>
			<a href="?ctl=Friend&act=add" class="list-group-item list-group-item-success">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add </a>
		</ul>
	</div>

</div>