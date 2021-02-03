<?php include '_functions.php'; ?>
<div class="form-group xform_field">

	<div class="floating-options">
		<div class="btn-group">
		  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="floation-actions dropdown-menu">
		    <li><a class="fire-action" data-action="full" href="#">Full size</a></li>
		    <li><a class="fire-action" data-action="half" href="#">Half size</a></li>
		    <li><a class="fire-action" data-action="third" href="#">One third</a></li>
		    <li role="separator" class="divider"></li>
		    <li><a class="fire-action" data-action="remove" href="#">Remove</a></li>
		  </ul>
		</div>
	</div>

	<div class="xform_inner" id="<?=token(4)?>" data-type="select">
		<label>Label</label>
		<select class="form-control" name="" id="">
			<option value="">-- Select an option --</option>
			<option value="">Option 1</option>
			<option value="">Option 2</option>
		</select>
	</div>

</div>