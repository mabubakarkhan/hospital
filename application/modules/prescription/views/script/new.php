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
		//Add Drug List
		$(document).on('click', '.addDrugToPrescription', function(event) {
			event.preventDefault();
			$("#addDrugToPrescriptionModal").modal('show');
		});

		$(document).on('keyup', '#drugSearchInput', function(event) {
			event.preventDefault();
			$this = $(this);
			$(".dropdownDrugSearchList").html('');
			$("#addDrugToPrescriptionModal input[name='drug_id']").val('');
			$key = $this.val();
			if ($key.length > 0) {
				$.post('<?=BASEURL."drug/drug-search-by-key"?>', {key: $key}, function(resp) {
					resp = $.parseJSON(resp);
					console.log(resp.html);
					$("#addDrugToPrescriptionModal .dropdownDrugSearchList").html(resp.html);
					$("#addDrugToPrescriptionModal .dropdownDrugSearchList").show(0);
				});
			}
		});
		$(document).on('click', '#addDrugToPrescriptionModal .selectDrugBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#drugSearchInput").val($this.attr('data-name'));
			$("#addDrugToPrescriptionModal input[name='drug_id']").val($this.attr('data-id'));
			$("#addDrugToPrescriptionModal input[name='generic_name']").val($this.attr('data-generic_name'));
			$("#addDrugToPrescriptionModal input[name='strength']").val($this.attr('data-strength'));
			$('#addDrugToPrescriptionModal form select[name="strength_frequencey"] option').each(function() {
			    if ($(this).val() == $this.attr('data-strength_frequencey')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#addDrugToPrescriptionModal form select[name="type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#addDrugToPrescriptionModal .dropdownDrugSearchList").hide(0);
			$("#addDrugToPrescriptionModal .dropdownDrugSearchList").html('');
		});

		$(document).on('submit', '#addDrugToPrescriptionModal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#addDrugToPrescriptionModal button[type='submit']").text('Wait...');
			$.post('<?=BASEURL.'prescription/add-prescription-drug'?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#addDrugToPrescriptionModal button[type='submit']").text('Save');
				alert(resp.msg);
				$("#addDrugToPrescriptionModal input[name='prescription_id']").val(resp.prescription_id);
				if (resp.status == true) {
					$(".prescriptionDrugList").html(resp.html);
					$("#addDrugToPrescriptionModal").modal('hide');
				}
			});
		});

		//Remove Drug List
		$(document).on('click', '.removePrescriptionDrugItem', function(event) {
			event.preventDefault();
			$this = $(this);
			$.post('<?=BASEURL.'prescription/delete-prescription-drug'?>', {id: $this.attr('data-id')}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				if (resp.status == true) {
					$this.parent('small').parent('li').remove();
				}
			});
		});
		//Edit Drug List
		$(document).on('click', '.editPrescriptionDrugItem', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#editDrugToPrescriptionModal input[name='id']").val($this.attr('data-id'));
			$("#editDrugToPrescriptionModal input[name='prescription_id']").val($this.attr('data-prescription_id'));
			$("#editDrugToPrescriptionModal input[name='drug_id']").val($this.attr('data-drug_id'));
			$("#editDrugToPrescriptionModal input[name='name']").val($this.attr('data-name'));
			$("#editDrugToPrescriptionModal input[name='generic_name']").val($this.attr('data-generic_name'));
			$("#editDrugToPrescriptionModal input[name='strength']").val($this.attr('data-strength'));
			$("#editDrugToPrescriptionModal input[name='duration']").val($this.attr('data-duration'));
			$("#editDrugToPrescriptionModal input[name='quantity']").val($this.attr('data-quantity'));
			$('#editDrugToPrescriptionModal select[name="type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="strength_frequencey"] option').each(function() {
			    if ($(this).val() == $this.attr('data-strength_frequencey')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="instruction"] option').each(function() {
			    if ($(this).val() == $this.attr('data-instruction')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="duration_type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-duration_type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="frequency"] option').each(function() {
			    if ($(this).val() == $this.attr('data-frequency')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="quantity_type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-quantity_type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal select[name="route"] option').each(function() {
			    if ($(this).val() == $this.attr('data-route')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#editDrugToPrescriptionModal").modal('show');
		});
		$(document).on('keyup', '#drugSearchInput2', function(event) {
			event.preventDefault();
			$this = $(this);
			$("dropdownDrugSearchList").html('');
			$("#editDrugToPrescriptionModal input[name='drug_id']").val('');
			$key = $this.val();
			if ($key.length > 0) {
				$.post('<?=BASEURL."drug/drug-search-by-key"?>', {key: $key}, function(resp) {
					resp = $.parseJSON(resp);
					$("#editDrugToPrescriptionModal .dropdownDrugSearchList").html(resp.html);
					$("#editDrugToPrescriptionModal .dropdownDrugSearchList").show(0);
				});
			}
		});
		$(document).on('click', '#editDrugToPrescriptionModal .selectDrugBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#drugSearchInput2").val($this.attr('data-name'));
			$("#editDrugToPrescriptionModal input[name='drug_id']").val($this.attr('data-id'));
			$("#editDrugToPrescriptionModal input[name='generic_name']").val($this.attr('data-generic_name'));
			$("#editDrugToPrescriptionModal input[name='strength']").val($this.attr('data-strength'));
			$('#editDrugToPrescriptionModal form select[name="strength_frequencey"] option').each(function() {
			    if ($(this).val() == $this.attr('data-strength_frequencey')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#editDrugToPrescriptionModal form select[name="type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#editDrugToPrescriptionModal .dropdownDrugSearchList").hide(0);
			$("#editDrugToPrescriptionModal .dropdownDrugSearchList").html('');
		});
		$(document).on('submit', '#editDrugToPrescriptionModal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#editDrugToPrescriptionModal button[type='submit']").text('Wait...');
			$.post('<?=BASEURL.'prescription/edit-prescription-drug'?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#editDrugToPrescriptionModal button[type='submit']").text('Update');
				alert(resp.msg);
				if (resp.status == true) {
					$(".prescriptionDrugList").html(resp.html);
				}
			});
		});

		/* Investigation */
		$(document).on('click', '.addInvestigationBtn', function(event) {
			event.preventDefault();
			$("#prescriptionFormInvestigation").append($(".investigationSectionToAddHide").html());
		});
		$(document).on('click', '.removeInvestigationSelectBoxBtn', function(event) {
			event.preventDefault();
			$(this).closest('.row').remove();
		});
		$(document).on('change', '#prescriptionFormInvestigation select[name="lab_test_id[]"]', function(event) {
			event.preventDefault();
			$this = $(this);
			$selectedInvestigationTypeOptionId = $this.val();
			$investigationPreviousResult = '';
			$('#prescriptionFormInvestigation select[name="lab_test_id[]"]').each(function() {

				if ($(this).is($this)) {
		            return;
		        }

                if ($(this).val() == $selectedInvestigationTypeOptionId) {
                	$investigationPreviousResult = $(this).closest('.row').find('input[name="result[]"]').val();
                	$investigationPreviousResultDate = $(this).closest('.row').find('.previous_result_at').val();
                }
            });
            if ($investigationPreviousResult.length > 0) {
            	$this.closest('.row').find('input[name="previous_result[]"]').val($investigationPreviousResult);
            	$this.closest('.row').find('input[name="previous_result_at[]"]').val($investigationPreviousResultDate);
            	$this.closest('.row').find('input[name="previous_result_at[]"]').show(0);
            	//$this.closest('.row').find('input[name="previous_result[]"]').parent('div').append('<input type="text" name="previous_result_at[]" class="form-control" value="'+$investigationPreviousResultDate+'" readonly>');
            }
		});
		$(document).on('click', '.saveInvestigationBtn', function(event) {
			event.preventDefault();
			$thisBtn = $(this);
			$thisBtn.text('Wait...');
			$form = $("#prescriptionFormInvestigation");
			$.post('<?=BASEURL.'prescription/post-investigation'?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$thisBtn.text('Save');
				alert(resp.msg);
				if (resp.status == true) {
					location.reload();
				}
			});
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
	<div class="investigationSectionToAddHide" style="display: none;">
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-md-3">
				<div class="form-gorup">
					<label>Type</label>
					<select name="lab_test_id[]" class="form-control">
						<option value="">Select</option>
						<?php foreach ($lab_active_tests as $keyLAT2 => $LAT2): ?>
							<option value="<?=$LAT2['lab_test_id']?>"><?=$LAT2['title']?></option>
						<?php endforeach ?>
					</select>
					<input type="hidden" class="previous_result_at" value="<?=date('Y-m-d')?>">
				</div><!-- /form-gorup -->
			</div><!-- /3 -->
			<div class="col-md-3">
				<div class="form-gorup">
					<label>Result</label>
					<input type="text" name="result[]" class="form-control">
				</div><!-- /form-gorup -->
			</div><!-- /3 -->
			<div class="col-md-3">
				<div class="form-gorup">
					<label>Previous Result</label>
					<input type="text" name="previous_result[]" class="form-control" readonly>
					<input type="text" name="previous_result_at[]" class="form-control" readonly style="display: none;">
				</div><!-- /form-gorup -->
			</div><!-- /3 -->
			<div class="col-md-2">
				<div class="form-gorup">
					<label>Comment</label>
					<textarea name="comment[]" class="form-control" rows="1"></textarea>
				</div><!-- /form-gorup -->
			</div><!-- /2 -->
			<div class="col-md-1" style="position: relative;">
				<span class="removeInvestigationSelectBoxBtn"><i class="fa fa-trash-o"></i></span>
			</div><!-- /1 -->
		</div><!-- /row -->
	</div>


	<div class="modal fade bd-example-modal-lg" id="addDrugToPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Add Drug</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<?php if ($prescription): ?>
							<input type="hidden" name="prescription_id" value="<?=$prescription['prescription_id']?>">
						<?php else: ?>
							<input type="hidden" name="prescription_id" value="0">
						<?php endif ?>
						<input type="hidden" name="drug_id">
						<input type="hidden" name="token_id" value="<?=$token['token_id']?>">
						<input type="hidden" name="user_id" value="<?=$token['user_id']?>">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label>Name</label>
									<input class="form-control" id="drugSearchInput" placeholder="Search Name, Generic name" name="name" type="text" required="">
									<div class="dropdown-drug-search-list dropdownDrugSearchList"></div>
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Type *</label>
									<select name="type" class="form-control" required>
										<option value="">Select Drug Type</option> <option value="tab">TAB</option> <option value="cap">CAP</option> <option value="syp">SYP</option> <option value="pwd">PWD</option> <option value="mouthwash">M/W</option> <option value="cream">CREAM</option> <option value="Eye Drops">Eye Drops</option> <option value="Lotion">Lotion</option> <option value="Ointment">Ointment</option> <option value="Gel">Gel</option> <option value="Vaccination">Vaccination</option> <option value="Toothpaste">Toothpaste</option> <option value="inj">INJ</option> <option value="Oral Spray">Oral Spray</option> <option value="Oil">Oil</option> <option value="Body Wash">Body Wash</option> <option value="Face Wash">Face Wash</option> <option value="Shampoo">Shampoo</option> <option value="Sunblock">Sunblock</option> <option value="Soap">Soap</option> <option value="Botox">Botox</option> <option value="Fillers">Fillers</option> <option value="Serum">Serum</option> <option value="Spray">Spray</option> <option value="Solution">Solution</option> <option value="Insulin">Insulin</option> <option value="Sachet">Sachet</option> <option value="Nasal Spray">Nasal Spray</option> <option value="Ear Drops">Ear Drops</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Generic name</label>
									<input class="form-control" name="generic_name" type="text" value="" required="">
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Strength</label>
									<input class="form-control" name="strength" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Strength Frequencey</label>
									<select name="strength_frequencey" class="form-control">
										<option value="">Select Frequencey</option> <option value="mg">mg</option> <option value="ml">ml</option> <option value="g">g</option> <option value="%">%</option> <option value="IU">IU</option> <option value="mcg">mcg</option> <option value="meg">meg</option> <option value="mmol">mmol</option> <option value="unit">unit</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Instruction</label>
									<select name="instruction" class="form-control">
										<option value="">Select Instruction</option> <option value="Before Breakfast">Before Breakfast</option> <option value="After Breakfast">After Breakfast</option> <option value="Before Dinner">Before Dinner</option> <option value="After Dinner">After Dinner</option> <option value="Empty Stomach">Empty Stomach</option> <option value="At Bedtime">At Bedtime</option> <option value="Immediately">Immediately</option> <option value="Before Lunch">Before Lunch</option> <option value="After Lunch">After Lunch</option> <option value="Before Meal">Before Meal</option> <option value="After Meal">After Meal</option> <option value="When Required">When Required</option> <option value="As needed">As needed</option> <option value="Every six hours">Every six hours</option> <option value="Every four hours">Every four hours</option> <option value="Every two hours">Every two hours</option> <option value="Every one hour">Every one hour</option> <option value="Every other day">Every other day</option> <option value="Every two weeks">Every two weeks</option> <option value="Three times a week">Three times a week</option> <option value="Two times a week">Two times a week</option> <option value="Once a week">Once a week</option> <option value="Once a month">Once a month</option> <option value="Once in two months">Once in two months</option> <option value="Once in three months">Once in three months</option> <option value="For muscles">For muscles</option> <option value="For increasing appetite">For increasing appetite</option> <option value="For increasing urine">For increasing urine</option> <option value="For transplant">For transplant</option> <option value="For keeping calm">For keeping calm</option> <option value="For kidneys">For kidneys</option> <option value="For sleep">For sleep</option> <option value="For stomach">For stomach</option> <option value="STAT">STAT</option> <option value="For increasing immunity">For increasing immunity</option> <option value="For abdominal gas">For abdominal gas</option> <option value="For itching">For itching</option> <option value="For improving blood deficiency">For improving blood deficiency</option> <option value="For breathing difficulty">For breathing difficulty</option> <option value="For Diabetes">For Diabetes</option> <option value="For Blood Pressure">For Blood Pressure</option> <option value="For diarrhea">For diarrhea</option> <option value="For swelling">For swelling</option> <option value="PRN">PRN</option> <option value="For nerves">For nerves</option> <option value="For chest infection">For chest infection</option> <option value="For severe Pain">For severe Pain</option> <option value="For joint Pain">For joint Pain</option> <option value="For joints">For joints</option> <option value="For uric acid">For uric acid</option> <option value="For thyroid">For thyroid</option> <option value="For bladder">For bladder</option> <option value="To keep calm">To keep calm</option> <option value="For fever">For fever</option> <option value="For muscle pain">For muscle pain</option> <option value="For muscle strain">For muscle strain</option> <option value="Steroid medicine">Steroid medicine</option> <option value="For strength of joints">For strength of joints</option> <option value="To prevent uric acid effects">To prevent uric acid effects</option> <option value="To reduce inflamation">To reduce inflamation</option> <option value="To prevent fits">To prevent fits</option> <option value="For bone strength">For bone strength</option> <option value="Before dialysis">Before dialysis</option> <option value="After dialysis">After dialysis</option> <option value="During dialysis">During dialysis</option> <option value="At the start of dialysis">At the start of dialysis</option> <option value="For headache">For headache</option> <option value="For pain in stomach">For pain in stomach</option> <option value="For abdominal bloating">For abdominal bloating</option> <option value="For burning in chest">For burning in chest</option> <option value="For chest pain">For chest pain</option> <option value="Vaccine to prevent hepatitis B">Vaccine to prevent hepatitis B</option> <option value="Vaccine to prevent Flu">Vaccine to prevent Flu</option> <option value="Vaccine for pneumonia">Vaccine for pneumonia</option> <option value="Vaccine to prevent meningitis">Vaccine to prevent meningitis</option> <option value="For light pain">For light pain</option> <option value="For Pain">For Pain</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Duration</label>
									<input class="form-control" name="duration" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Duration Type</label>
									<select name="duration_type" class="form-control">
										<option value="">Select Duration Type</option> <option value="day(s)">Day(s)</option> <option value="week(s)">Week(s)</option> <option value="month(s)">Month(s)</option> <option value="Continuously">Continuously</option> <option value="When Required">When Required</option> <option value="STAT">STAT</option> <option value="PRN">PRN</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Frequencey</label>
									<select name="frequency" class="form-control">
										<option value="">Select Frequency</option> <option value="Only Once">Only Once</option> <option value="Once a day">Once a day</option> <option value="Twice a day">Twice a day</option> <option value="Thrice a day">Thrice a day</option> <option value="Four times a day">Four times a day</option> <option value="Before Bed">Before Bed</option> <option value="Every hour">Every hour</option> <option value="Every 2 hours">Every 2 hours</option> <option value="Every 3 hours">Every 3 hours</option> <option value="Every 4 hours">Every 4 hours</option> <option value="Every 6 hours">Every 6 hours</option> <option value="Every 8 hours">Every 8 hours</option> <option value="Every 12 hours">Every 12 hours</option> <option value="Every Other day">Every Other day</option> <option value="Every 3 Days">Every 3 Days</option> <option value="Once a week">Once a week</option> <option value="Twice a week">Twice a week</option> <option value="Thrice a week">Thrice a week</option> <option value="Every 10 Days">Every 10 Days</option> <option value="Every 15 Days">Every 15 Days</option> <option value="Once a Month">Once a Month</option> <option value="Once 3 Months">Once 3 Months</option> <option value="Once a Year">Once a Year</option> <option value="Every Morning">Every Morning</option> <option value="Every Evening">Every Evening</option> <option value="Every Night">Every Night</option> <option value="If needed">If needed</option> <option value="Before Breakfast">Before Breakfast</option> <option value="Continuously">Continuously</option> <option value="Before Lunch">Before Lunch</option> <option value="After Lunch">After Lunch</option> <option value="Before Meal">Before Meal</option> <option value="After Meal">After Meal</option> <option value="Before Dinner">Before Dinner</option> <option value="After Dinner">After Dinner</option> <option value="As Advised">As Advised</option> <option value="Twice a month">Twice a month</option> <option value="After Breakfast">After Breakfast</option> <option value="Before Breakfast and Lunch">Before Breakfast and Lunch</option> <option value="Before Lunch and Dinner">Before Lunch and Dinner</option> <option value="Before breakfast and dinner">Before breakfast and dinner</option> <option value="After Breakfast and Lunch">After Breakfast and Lunch</option> <option value="After Lunch and Dinner">After Lunch and Dinner</option> <option value="After breakfast and dinner">After breakfast and dinner</option> <option value="Before Breakfast, Lunch and Dinner">Before Breakfast, Lunch and Dinner</option> <option value="After Breakfast, Lunch and Dinner">After Breakfast, Lunch and Dinner</option> <option value="at noon">at noon</option> <option value="noon and evening">noon and evening</option> <option value="morning, evening, night">morning, evening, night</option> <option value="Morning and noon">Morning and noon</option> <option value="at 6 am, 10 am, 2pm, 6 pm, 10 pm">at 6 am, 10 am, 2pm, 6 pm, 10 pm</option> <option value="Thrice a day for 21 days, then only at night for next 2 months">Thrice a day for 21 days, then only at night for next 2 months</option> <option value="Twice a day for 21 days, then only at night for next 2 months">Twice a day for 21 days, then only at night for next 2 months</option> <option value="Twice a day for 21 days, then onwards for next two months take 1 capsule by skipping 1 day">Twice a day for 21 days, then onwards for next two months take 1 capsule by skipping 1 day</option> <option value="Twice a week after dialysis">Twice a week after dialysis</option> <option value="Thrice a week after dialysis">Thrice a week after dialysis</option> <option value="After dialysis in double lumen">After dialysis in double lumen</option> <option value="At the start of dialysis">At the start of dialysis</option> <option value="During dialysis">During dialysis</option> <option value="Before dialysis">Before dialysis</option> <option value="First injection now, then after 1 month , next at 2 months end, 3rd injection at 6 months end">First injection now, then after 1 month , next at 2 months end, 3rd injection at 6 months end</option> <option value="Once in a year">Once in a year</option> <option value="One injection now, next after a month">One injection now, next after a month</option> <option value="One injection now, one after a month, next after 6 months">One injection now, one after a month, next after 6 months</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Quantity</label>
									<input class="form-control" name="quantity" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Quantity Type</label>
									<select name="quantity_type" class="form-control">
										<option value="">Select Quantity Type</option> <option value="capsule(s)">Capsule(s)</option> <option value="tablet(s)">Tablet(s)</option> <option value="ml">ml</option> <option value="mg">mg</option> <option value="iu">IU</option> <option value="drop">Drop</option> <option value="tablespoon">Tablespoon</option> <option value="teaspoon">Teaspoon</option> <option value="unit(s)">Unit(s)</option> <option value="puff(s)">Puff(s)</option> <option value="sachet">Sachet</option> <option value="injection">Injection</option> <option value="dose step">Dose Step</option> <option value="dropper">Dropper</option> <option value="ml/h">ml/h</option> <option value="units/kg">Units/kg</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Route</label>
									<select name="route" class="form-control">
										<option value="">Select Route</option> <option value="Oral">Oral</option> <option value="Intramuscular">Intramuscular</option> <option value="Nasal">Nasal</option> <option value="Intravenous">Intravenous</option> <option value="Topical">Topical</option> <option value="Intraosseous">Intraosseous</option> <option value="Intrathecal">Intrathecal</option> <option value="Intraperitoneal">Intraperitoneal</option> <option value="Intradermal">Intradermal</option> <option value="Nasogastric">Nasogastric</option> <option value="Sub lingual">Sub lingual</option> <option value="Per Rectum">Per Rectum</option> <option value="Subcutaneous">Subcutaneous</option> <option value="Per Vaginal">Per Vaginal</option> <option value="Inhalation">Inhalation</option> <option value="Intraoccular">Intraoccular</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Save</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #addDrugToPrescriptionModal -->


	<div class="modal fade bd-example-modal-lg" id="editDrugToPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Edit Drug</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="id" value="0">
						<input type="hidden" name="prescription_id" value="0">
						<input type="hidden" name="drug_id">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label>Name</label>
									<input class="form-control" id="drugSearchInput2" placeholder="Search Name, Generic name" name="name" type="text" required="">
									<div class="dropdown-drug-search-list dropdownDrugSearchList"></div>
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Type *</label>
									<select name="type" class="form-control" required>
										<option value="">Select Drug Type</option> <option value="tab">TAB</option> <option value="cap">CAP</option> <option value="syp">SYP</option> <option value="pwd">PWD</option> <option value="mouthwash">M/W</option> <option value="cream">CREAM</option> <option value="Eye Drops">Eye Drops</option> <option value="Lotion">Lotion</option> <option value="Ointment">Ointment</option> <option value="Gel">Gel</option> <option value="Vaccination">Vaccination</option> <option value="Toothpaste">Toothpaste</option> <option value="inj">INJ</option> <option value="Oral Spray">Oral Spray</option> <option value="Oil">Oil</option> <option value="Body Wash">Body Wash</option> <option value="Face Wash">Face Wash</option> <option value="Shampoo">Shampoo</option> <option value="Sunblock">Sunblock</option> <option value="Soap">Soap</option> <option value="Botox">Botox</option> <option value="Fillers">Fillers</option> <option value="Serum">Serum</option> <option value="Spray">Spray</option> <option value="Solution">Solution</option> <option value="Insulin">Insulin</option> <option value="Sachet">Sachet</option> <option value="Nasal Spray">Nasal Spray</option> <option value="Ear Drops">Ear Drops</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Generic name</label>
									<input class="form-control" name="generic_name" type="text" value="" required="">
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Strength</label>
									<input class="form-control" name="strength" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Strength Frequencey</label>
									<select name="strength_frequencey" class="form-control">
										<option value="">Select Frequencey</option> <option value="mg">mg</option> <option value="ml">ml</option> <option value="g">g</option> <option value="%">%</option> <option value="IU">IU</option> <option value="mcg">mcg</option> <option value="meg">meg</option> <option value="mmol">mmol</option> <option value="unit">unit</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Instruction</label>
									<select name="instruction" class="form-control">
										<option value="">Select Instruction</option> <option value="Before Breakfast">Before Breakfast</option> <option value="After Breakfast">After Breakfast</option> <option value="Before Dinner">Before Dinner</option> <option value="After Dinner">After Dinner</option> <option value="Empty Stomach">Empty Stomach</option> <option value="At Bedtime">At Bedtime</option> <option value="Immediately">Immediately</option> <option value="Before Lunch">Before Lunch</option> <option value="After Lunch">After Lunch</option> <option value="Before Meal">Before Meal</option> <option value="After Meal">After Meal</option> <option value="When Required">When Required</option> <option value="As needed">As needed</option> <option value="Every six hours">Every six hours</option> <option value="Every four hours">Every four hours</option> <option value="Every two hours">Every two hours</option> <option value="Every one hour">Every one hour</option> <option value="Every other day">Every other day</option> <option value="Every two weeks">Every two weeks</option> <option value="Three times a week">Three times a week</option> <option value="Two times a week">Two times a week</option> <option value="Once a week">Once a week</option> <option value="Once a month">Once a month</option> <option value="Once in two months">Once in two months</option> <option value="Once in three months">Once in three months</option> <option value="For muscles">For muscles</option> <option value="For increasing appetite">For increasing appetite</option> <option value="For increasing urine">For increasing urine</option> <option value="For transplant">For transplant</option> <option value="For keeping calm">For keeping calm</option> <option value="For kidneys">For kidneys</option> <option value="For sleep">For sleep</option> <option value="For stomach">For stomach</option> <option value="STAT">STAT</option> <option value="For increasing immunity">For increasing immunity</option> <option value="For abdominal gas">For abdominal gas</option> <option value="For itching">For itching</option> <option value="For improving blood deficiency">For improving blood deficiency</option> <option value="For breathing difficulty">For breathing difficulty</option> <option value="For Diabetes">For Diabetes</option> <option value="For Blood Pressure">For Blood Pressure</option> <option value="For diarrhea">For diarrhea</option> <option value="For swelling">For swelling</option> <option value="PRN">PRN</option> <option value="For nerves">For nerves</option> <option value="For chest infection">For chest infection</option> <option value="For severe Pain">For severe Pain</option> <option value="For joint Pain">For joint Pain</option> <option value="For joints">For joints</option> <option value="For uric acid">For uric acid</option> <option value="For thyroid">For thyroid</option> <option value="For bladder">For bladder</option> <option value="To keep calm">To keep calm</option> <option value="For fever">For fever</option> <option value="For muscle pain">For muscle pain</option> <option value="For muscle strain">For muscle strain</option> <option value="Steroid medicine">Steroid medicine</option> <option value="For strength of joints">For strength of joints</option> <option value="To prevent uric acid effects">To prevent uric acid effects</option> <option value="To reduce inflamation">To reduce inflamation</option> <option value="To prevent fits">To prevent fits</option> <option value="For bone strength">For bone strength</option> <option value="Before dialysis">Before dialysis</option> <option value="After dialysis">After dialysis</option> <option value="During dialysis">During dialysis</option> <option value="At the start of dialysis">At the start of dialysis</option> <option value="For headache">For headache</option> <option value="For pain in stomach">For pain in stomach</option> <option value="For abdominal bloating">For abdominal bloating</option> <option value="For burning in chest">For burning in chest</option> <option value="For chest pain">For chest pain</option> <option value="Vaccine to prevent hepatitis B">Vaccine to prevent hepatitis B</option> <option value="Vaccine to prevent Flu">Vaccine to prevent Flu</option> <option value="Vaccine for pneumonia">Vaccine for pneumonia</option> <option value="Vaccine to prevent meningitis">Vaccine to prevent meningitis</option> <option value="For light pain">For light pain</option> <option value="For Pain">For Pain</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Duration</label>
									<input class="form-control" name="duration" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Duration Type</label>
									<select name="duration_type" class="form-control">
										<option value="">Select Duration Type</option> <option value="day(s)">Day(s)</option> <option value="week(s)">Week(s)</option> <option value="month(s)">Month(s)</option> <option value="Continuously">Continuously</option> <option value="When Required">When Required</option> <option value="STAT">STAT</option> <option value="PRN">PRN</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Frequencey</label>
									<select name="frequency" class="form-control">
										<option value="">Select Frequency</option> <option value="Only Once">Only Once</option> <option value="Once a day">Once a day</option> <option value="Twice a day">Twice a day</option> <option value="Thrice a day">Thrice a day</option> <option value="Four times a day">Four times a day</option> <option value="Before Bed">Before Bed</option> <option value="Every hour">Every hour</option> <option value="Every 2 hours">Every 2 hours</option> <option value="Every 3 hours">Every 3 hours</option> <option value="Every 4 hours">Every 4 hours</option> <option value="Every 6 hours">Every 6 hours</option> <option value="Every 8 hours">Every 8 hours</option> <option value="Every 12 hours">Every 12 hours</option> <option value="Every Other day">Every Other day</option> <option value="Every 3 Days">Every 3 Days</option> <option value="Once a week">Once a week</option> <option value="Twice a week">Twice a week</option> <option value="Thrice a week">Thrice a week</option> <option value="Every 10 Days">Every 10 Days</option> <option value="Every 15 Days">Every 15 Days</option> <option value="Once a Month">Once a Month</option> <option value="Once 3 Months">Once 3 Months</option> <option value="Once a Year">Once a Year</option> <option value="Every Morning">Every Morning</option> <option value="Every Evening">Every Evening</option> <option value="Every Night">Every Night</option> <option value="If needed">If needed</option> <option value="Before Breakfast">Before Breakfast</option> <option value="Continuously">Continuously</option> <option value="Before Lunch">Before Lunch</option> <option value="After Lunch">After Lunch</option> <option value="Before Meal">Before Meal</option> <option value="After Meal">After Meal</option> <option value="Before Dinner">Before Dinner</option> <option value="After Dinner">After Dinner</option> <option value="As Advised">As Advised</option> <option value="Twice a month">Twice a month</option> <option value="After Breakfast">After Breakfast</option> <option value="Before Breakfast and Lunch">Before Breakfast and Lunch</option> <option value="Before Lunch and Dinner">Before Lunch and Dinner</option> <option value="Before breakfast and dinner">Before breakfast and dinner</option> <option value="After Breakfast and Lunch">After Breakfast and Lunch</option> <option value="After Lunch and Dinner">After Lunch and Dinner</option> <option value="After breakfast and dinner">After breakfast and dinner</option> <option value="Before Breakfast, Lunch and Dinner">Before Breakfast, Lunch and Dinner</option> <option value="After Breakfast, Lunch and Dinner">After Breakfast, Lunch and Dinner</option> <option value="at noon">at noon</option> <option value="noon and evening">noon and evening</option> <option value="morning, evening, night">morning, evening, night</option> <option value="Morning and noon">Morning and noon</option> <option value="at 6 am, 10 am, 2pm, 6 pm, 10 pm">at 6 am, 10 am, 2pm, 6 pm, 10 pm</option> <option value="Thrice a day for 21 days, then only at night for next 2 months">Thrice a day for 21 days, then only at night for next 2 months</option> <option value="Twice a day for 21 days, then only at night for next 2 months">Twice a day for 21 days, then only at night for next 2 months</option> <option value="Twice a day for 21 days, then onwards for next two months take 1 capsule by skipping 1 day">Twice a day for 21 days, then onwards for next two months take 1 capsule by skipping 1 day</option> <option value="Twice a week after dialysis">Twice a week after dialysis</option> <option value="Thrice a week after dialysis">Thrice a week after dialysis</option> <option value="After dialysis in double lumen">After dialysis in double lumen</option> <option value="At the start of dialysis">At the start of dialysis</option> <option value="During dialysis">During dialysis</option> <option value="Before dialysis">Before dialysis</option> <option value="First injection now, then after 1 month , next at 2 months end, 3rd injection at 6 months end">First injection now, then after 1 month , next at 2 months end, 3rd injection at 6 months end</option> <option value="Once in a year">Once in a year</option> <option value="One injection now, next after a month">One injection now, next after a month</option> <option value="One injection now, one after a month, next after 6 months">One injection now, one after a month, next after 6 months</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-8">
								<div class="form-group">
									<label>Quantity</label>
									<input class="form-control" name="quantity" type="text">
								</div><!-- /form-group -->
							</div><!-- /8 -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Quantity Type</label>
									<select name="quantity_type" class="form-control">
										<option value="">Select Quantity Type</option> <option value="capsule(s)">Capsule(s)</option> <option value="tablet(s)">Tablet(s)</option> <option value="ml">ml</option> <option value="mg">mg</option> <option value="iu">IU</option> <option value="drop">Drop</option> <option value="tablespoon">Tablespoon</option> <option value="teaspoon">Teaspoon</option> <option value="unit(s)">Unit(s)</option> <option value="puff(s)">Puff(s)</option> <option value="sachet">Sachet</option> <option value="injection">Injection</option> <option value="dose step">Dose Step</option> <option value="dropper">Dropper</option> <option value="ml/h">ml/h</option> <option value="units/kg">Units/kg</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /4 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Route</label>
									<select name="route" class="form-control">
										<option value="">Select Route</option> <option value="Oral">Oral</option> <option value="Intramuscular">Intramuscular</option> <option value="Nasal">Nasal</option> <option value="Intravenous">Intravenous</option> <option value="Topical">Topical</option> <option value="Intraosseous">Intraosseous</option> <option value="Intrathecal">Intrathecal</option> <option value="Intraperitoneal">Intraperitoneal</option> <option value="Intradermal">Intradermal</option> <option value="Nasogastric">Nasogastric</option> <option value="Sub lingual">Sub lingual</option> <option value="Per Rectum">Per Rectum</option> <option value="Subcutaneous">Subcutaneous</option> <option value="Per Vaginal">Per Vaginal</option> <option value="Inhalation">Inhalation</option> <option value="Intraoccular">Intraoccular</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Update</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #editDrugToPrescriptionModal -->




	<style>
	.removeInvestigationSelectBoxBtn{
		position: absolute;
		right: 0px;
		top: 36px;
		color: red;
		cursor: pointer;
		font-size: 20px;
	}
	.removeProcedureSelectBoxBtn{
		position: absolute;
		right: -30px;
		top: 10px;
		color: red;
		cursor: pointer;
	}
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
	.dropdown-drug-search-list {
	    display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 300px;
	    max-height: 300px;
	    overflow: hidden;
	    overflow-y: auto;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 10000;
	}
	.dropdown-drug-search-list a {
	    color: black;
	    padding: 12px 16px;
	    text-decoration: none;
	    display: block;
	}
	.prescriptionDrugList{
		padding: 0;
		margin: 0;
	}
	.prescriptionDrugListItem{
		font-size: 11px;
		margin-bottom: 5px;
		border-bottom: 1px solid #eee;
		display: block;
		width: 100%;
		padding: 0 0 5px 0;
		position: relative;
	}
	.prescriptionDrugListItem span{
		width: 90%;
		display: block;
		float: left;
	}
	.prescriptionDrugListItem small{
		width: 10%;
		display: block;
		float: left;
	}
	</style>

<?php
}//check permission
?>

