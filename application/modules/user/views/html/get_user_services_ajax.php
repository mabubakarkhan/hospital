<?php if ($services): ?>
	<?php
	$canEdit = false;
	$checkUser = unserialize($_SESSION['user']);
    if ($checkUser['permissions'] == 'all' || in_array('service_allocation_to_user_edit', $checkUser['permissions'])) {
    	$canEdit = true;
    }
	?>
	<?php if ($canEdit == false): ?>
		<ul>
			<?php foreach ($services as $keyService => $q): ?>
				<?php if (in_array($q['service_id'], $ids)): ?>
					<li><?=$q['name']?></li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	<?php else: ?>
			<?php foreach ($services as $keyService => $q): ?>
				<div class="col-md-4">
					<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
						<input class="form-check-input" id="service_<?=$keyService?>" type="checkbox" name="service_id[]" value="<?=$q['service_id']?>" <?=(in_array($q['service_id'], $ids)) ? 'checked' : ''?>>
						<label class="form-check-label" for="service_<?=$keyService?>"><?=$q['name']?></label>
					</div>
				</div><!-- /4 -->
			<?php endforeach ?>
			<div class="col-md-12">
				<div class="form-group">
					<br>
					<button type="submit" class="btn btn-primary submitBtn">Update</button>
				</div><!-- /form-group -->
			</div><!-- /12 -->
	<?php endif ?>
<?php endif ?>