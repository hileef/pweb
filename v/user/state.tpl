<?php $stateValue = $args[1]; ?>
<div class="container">

	<form role="form" action="?ctl=User&act=state" method="post">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title">Please select your new state :</h3>
		</div>

		<div class="list-group">
			<a class="list-group-item" >
				<div class="radio ext-nomarg"><label>
					<input type="radio" name="state" value="0" <?php if($stateValue == 0) echo "checked"; ?> />
					Offline
				</label></div>
			</a>
			<a class="list-group-item" >
				<div class="radio ext-nomarg"><label>
					<input type="radio" name="state" value="1" <?php if($stateValue == 1) echo "checked"; ?> />
					Online
				</label></div>
			</a>
			<a class="list-group-item" >
				<div class="radio ext-nomarg"><label>
					<input type="radio" name="state" value="2" <?php if($stateValue == 2) echo "checked"; ?> />
					Busy
				</label></div>
			</a>
		</div>

		<ul class="list-group">
			<li class="list-group-item">
				<input type="hidden" name="did" value="<?php echo $args[3]; ?>" />
				<input type="submit" name="submit" class="btn btn-primary" value="OK" />
			</li>

		</ul>

	</div>
	</form>

</div>



