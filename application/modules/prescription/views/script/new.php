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


	<script>
	$(function(){
		$(document).on('click', '.lab-test-title-tile', function(event) {
			event.preventDefault();
			$this = $(this);
			if ($this.hasClass('active')) {
				return true;
			}
			else{
				$this.addClass('active');
				$(".selectedLabTestListUl").append('<li data-id="'+$this.attr('data-id')+'">'+$this.attr('data-title')+' <i class="icofont icofont-close"></i></li>');
				$("#prescriptionFormId3").append('<input type="hidden" name="lab_test_id[]" value="'+$this.attr('data-id')+'">');
			}
		});
		$(document).on('click', '.selectedLabTestListUl li i', function(event) {
			event.preventDefault();
			$this = $(this);
			$labTestListId = $this.parent('li').attr('data-id');
			$this.parent('li').remove();
			$(".lab-test-title-tile[data-id='" + $labTestListId + "']").removeClass('active');
			$("#prescriptionFormId3 input[value='"+$labTestListId+"']").remove();
		});
		$(document).on('submit', '#prescriptionFormId3', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#prescriptionFormId3 button[type='submit']").text('Wait...');
			$.post('<?=BASEURL."prescription/lab-test-submit"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#prescriptionFormId3 button[type='submit']").text('Save');
				alert(resp.msg);
			});
		});

		$.each($(".lab-test-title-tile.active"), function(index, val) {
		    let $this = $(val);
		    $(".selectedLabTestListUl").append('<li data-id="' + $this.attr('data-id') + '">' + $this.attr('data-title') + ' <i class="icofont icofont-close"></i></li>');
		});


	});//onload
	</script>


	<style>
	.lab-test-title-tile{
		background: #fff;
		font-size: 12px;
		text-align: center;
		margin-bottom: 10px;
		padding: 5px;
		cursor: pointer;
		box-shadow: 0px 13px 15px -10px rgba(0,0,0,0.1);
	}
	.lab-test-title-tile:hover,
	.lab-test-title-tile.active{
		background: #000;
		color: #fff;
		border: 1px solid #000;
	}
	.selectedLabTestListUl{
		list-style: none;
		margin-bottom: 10px;
	}
	.selectedLabTestListUl li {
		display: block;
		padding: 5px 7px;
		border: 1px solid #eee;
		font-size: 13px;
		border-radius: 2px;
		margin-bottom: 10px;
		margin-right: 5px;
	}
	.selectedLabTestListUl li i{
		color: red;
		cursor: pointer;
	}
	.selectedLabTestListUl li:hover{
		background: #eee;
	}
	</style>

<?php
}//check permission
?>

