<div class="container">


	<?php if(isset($args[5]) && $args[5] != NULL) { ?> <!-- ALERT HERE --> 
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span><?php echo $args[5]; ?>
	</div> <!-- /ALERT -->
	<?php } ?>

	<form role="form" action="?ctl=<?php echo($args[1]) ?>&act=<?php echo($args[2]) ?>" method="post">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title">Please pick from the following :</h3>
		</div>

		<div class="panel-body">
			<div class="input-group">
				<input type="text" name="tlogin" class="form-control" placeholder="Enter user login here..." />
				<span class="input-group-btn">
					<input role="button" type="submit" class="btn btn-primary" value="OK" />
				</span>
			</div>
		</div>

		<?php if($args[3] != NULL) { ?>
		<div class="list-group">
			<?php $icc = 0; foreach($args[3] as $usr) { ?>
			<a href="javascript:toggleBL(<?php echo $icc; ?>)" class="list-group-item" id="link_<?php echo $icc; ?>">
			    <div class="checkbox ext-nomarg"><label onclick="toggleMinus(<?php echo $icc; ?>)">
					<input onclick="togglePlus(<?php echo $icc; ?>)" class="ext-noshow" id="box_<?php echo $icc; $icc++; ?>" type="checkbox" name="uids[]" value="<?php echo($usr['id_user']); ?>">
					<?php echo($usr['login_user']); ?>
				</label></div>
			</a>
			<?php } ?>
		</div>

		<ul class="list-group">
			<li class="list-group-item">
				<input type="hidden" name="did" value="<?php echo $args[4]; ?>" />
				<input type="submit" class="btn btn-primary" value="OK" />
			</li>

		</ul>
		<?php } else { ?>
			<ul class="list-group"> <li class="list-group-item">
				<p> Sorry but no one is available. </p>
			</li> </ul>
		<?php } ?>
	</div>
	</form>

</div>

<script>



var tgMinusGuard = 0;
var tgPlusGuard = 0;

function toggleBL(i) {
	// console.log('BL called');
	// toggleBox(i);
	// toggleLink(i);
}

function toggleBox(i) {
	// console.log('box');
	// $('#box_' + i).prop('checked', !$('#box_' + i).prop('checked'));
}

function toggleLink(i) {
	// console.log('link');
	// $('#link_' + i).toggleClass("list-group-item-info");
}

function togglePlus(i) {
	// tgPlusGuard = (tgPlusGuard + 1) % 6;
	// if(tgPlusGuard == 0) {
	// 	console.log('plus called BL');
	// 	toggleBL(i);
	// }
}

function toggleMinus(i) {
	// tgMinusGuard = (tgMinusGuard + 1) % 2;
	// if(tgMinusGuard == 0) {
	// 	console.log('minus called BL');
	// 	toggleLink(i);
	// }
}

//	var max = <?php echo($icc); ?>;
//	for (i = 0; i < max; i++) {
//	    $('link_' + i).onclick = toggleBox(i);
//	}



</script>