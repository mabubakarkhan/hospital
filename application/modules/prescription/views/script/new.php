<?php
$checkUserPermissions = unserialize($_SESSION['user']);
if ($checkUserPermissions['permissions'] == 'all' || in_array('add_prescription_token', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){
		$(document).on('submit', '#prescriptionFormId1', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#prescriptionFormId1 button[type='submit']").text('Wait...');
			$.post('<?=BASEURL."prescription/submit"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				$("#prescriptionFormId2 button[type='submit']").text('Save');
				location.reload();
			});
		});
		$(document).on('submit', '#prescriptionFormId2', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#prescriptionFormId2 button[type='submit']").text('Wait...');
			$.post('<?=BASEURL."prescription/submit"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				$("#prescriptionFormId2 button[type='submit']").text('Save');
				location.reload();
			});
		});

		$(document).on('click', '.addProcedureBtn', function(event) {
			event.preventDefault();
			$(".addProcedureSection").append($(".procedureSectionToAddHide").html());
		});
		$(document).on('click', '.removeProcedureSelectBoxBtn', function(event) {
			event.preventDefault();
			$(this).parent('div').remove();
		});

	});//onload
	</script>

	<div class="procedureSectionToAddHide" style="display: none;">
		<div style="position: relative;">
			<select name="procedure_id[]" class="form-control" style="margin: 10px 0;">
				<option value="">Select Procedure</option>
				<?php foreach ($procedures as $keyProcedure => $procedure): ?>
					<option value="<?=$procedure['procedure_id']?>"><?=$procedure['name']?></option>
				<?php endforeach ?>
			</select>
			<span class="removeProcedureSelectBoxBtn"><i class="fa fa-trash-o"></i></span>
		</div>
	</div>

	<style>
	.removeProcedureSelectBoxBtn{
		position: absolute;
		right: -30px;
		top: 10px;
		color: red;
		cursor: pointer;
	}
	</style>

<?php
}//check permission
?>


