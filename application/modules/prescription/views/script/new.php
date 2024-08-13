<?php
$checkUserPermissions = unserialize($_SESSION['user']);
if ($checkUserPermissions['permissions'] == 'all' || in_array('add_prescription_token', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){
		$(document).on('submit', '#prescriptionFormId1', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#prescriptionFormId1 button").text('Wait...');
			$.post('<?=BASEURL."prescription/submit"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				$("#prescriptionFormId1 button").text('Save');
			});
		});
		$(document).on('submit', '#prescriptionFormId2', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#prescriptionFormId2 button").text('Wait...');
			$.post('<?=BASEURL."prescription/submit"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				$("#prescriptionFormId2 button").text('Save');
			});
		});
	});//onload
	</script>

<?php
}//check permission
?>