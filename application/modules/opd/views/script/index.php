<?php
$checkUser = unserialize($_SESSION['user']);
$canCreateToken = false;
if ($checkUser['permissions'] == 'all' || in_array('create_token', $checkUser['permissions'])) {
	$canCreateToken = true;
}
?>

<?php if ($canCreateToken): ?>
	<script>
	$(function(){
		$(document).on('click', '.createTokenBtn', function(event) {
			event.preventDefault();
			$.post('<?=BASEURL."home/get-current-active-doctors-for-opd"?>', {id: 463}, function(resp) {
				resp = $.parseJSON(resp);
				$("#createTokenModal select[name='user_id']").html(resp.html);
				$("#createTokenModal select[name='token_number'] option").each(function () {
			        if ($(this).val() !== '') {
			            $("#createTokenModal select[name='token_number']").val($(this).val());
			            return false;
			        }
			    });
				$("#createTokenModal").modal('show');
			});
		});
		$(document).on('click', '.createTokenBtnTokenNumber', function(event) {
			event.preventDefault();
			$this = $(this);
			$.post('<?=BASEURL."home/get-current-active-doctors-for-opd"?>', {id: 463}, function(resp) {
				resp = $.parseJSON(resp);
				$("#createTokenModal select[name='user_id']").html(resp.html);
				$("#createTokenModal select[name='token_number']").val($this.attr('data-token'));
				$("#createTokenModal").modal('show');
			});
		});
		$(document).on('change', "#createTokenModal select[name='user_id']", function(event) {
			event.preventDefault();
			$this = $(this);
			$val = $this.val();
			if ($val.length > 0) {
				$("#createTokenModal input[name='room_id']").val($this.children('option:selected').attr('data-room_id'));
				$("#createTokenModal input[name='user_room_time_id']").val($this.children('option:selected').attr('data-user_room_time_id'));
				$("#createTokenModal input[name='service_id']").val($this.children('option:selected').attr('data-service_id'));
				$("#createTokenModal input[name='user_commission']").val($this.children('option:selected').attr('data-user_commission'));
				$("#createTokenModal input[name='fee']").val($this.children('option:selected').attr('data-fee'));
				$("#createTokenModal .showFeeTokenCreateForm").val($this.children('option:selected').attr('data-fee'));
			}
			else{
				$("#createTokenModal input[name='room_id']").val('');
				$("#createTokenModal input[name='user_room_time_id']").val('');
				$("#createTokenModal input[name='service_id']").val('');
				$("#createTokenModal input[name='user_commission']").val('');
				$("#createTokenModal input[name='fee']").val('');
				$("#createTokenModal .showFeeTokenCreateForm").val('');
			}
		});
		$(document).on('keyup', '#createTokenInputPatientSearch', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#dropdownPatientSearchList").html('');
			$("#createTokenModal input[name='patient_id']").val('');
			$key = $this.val();
			if ($key.length > 0) {
				$.post('<?=BASEURL."home/patient-search-for-token"?>', {key: $key}, function(resp) {
					resp = $.parseJSON(resp);
					$("#dropdownPatientSearchList").html(resp.html);
					$("#dropdownPatientSearchList").show(0);
				});
			}
		});
		$(document).on('click', '#createTokenModal .selectPatientBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#createTokenInputPatientSearch").val($this.attr('data-title'));
			$("#createTokenModal input[name='patient_id']").val($this.attr('data-id'));
			$("#dropdownPatientSearchList").hide(0);
			$("#dropdownPatientSearchList").html('');
		});
		$(document).on('submit', '#createAppointmentModal form, #createTokenModal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$.post('<?=BASEURL."opd/create-token"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				alert(resp.msg);
				//auto select next token
				if (resp.status == true) {
				    var $select = $form.find('select[name="token_number"]');
				    var selectedToken = parseInt($select.val(), 10);
				    $select.find('option:selected').remove();
				    if ($select.children('option').length > 0) {
				        var nextOption = $select.children('option').first();
				        $select.children('option').each(function() {
				            if (parseInt($(this).val(), 10) > selectedToken) {
				                nextOption = $(this);
				                return false;
				            }
				        });
				        nextOption.prop('selected', true);
				    } else {
				        var newValue = selectedToken + 1;
				        var newOption = new Option(newValue, newValue);
				        $select.append(newOption);
				        $select.val(newValue);
				    }
				    location.reload();
				}//if (resp.status == true)
			});//post
		});//form submit


		//Appointment
		$(document).on('click', '.createAppointmentBtn', function(event) {
			event.preventDefault();
			$("#createAppointmentModal").modal('show');
		});

		$(document).on('keyup', '#createAppointmentInputPatientSearch', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#dropdownPatientSearchListAppointment").html('');
			$("#createAppointmentModal input[name='patient_id']").val('');
			$key = $this.val();
			if ($key.length > 0) {
				$.post('<?=BASEURL."home/patient-search-for-token"?>', {key: $key}, function(resp) {
					resp = $.parseJSON(resp);
					$("#dropdownPatientSearchListAppointment").html(resp.html);
					$("#dropdownPatientSearchListAppointment").show(0);
				});
			}
		});
		$(document).on('click', '#createAppointmentModal .selectPatientBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#createAppointmentInputPatientSearch").val($this.attr('data-title'));
			$("#createAppointmentModal input[name='patient_id']").val($this.attr('data-id'));
			$("#dropdownPatientSearchListAppointment").hide(0);
			$("#dropdownPatientSearchListAppointment").html('');
			$.post('<?=BASEURL."home/get-patient-appointments"?>', {id: $this.attr('data-id')}, function(resp) {
				resp = $.parseJSON(resp);
				$("#createAppointmentModal select[name='user_id']").html(resp.html);
			});
		});

		$(document).on('change', "#createAppointmentModal select[name='user_id']", function(event) {
			event.preventDefault();
			$this = $(this);
			$val = $this.val();
			if ($val.length > 0) {
				$("#createAppointmentModal input[name='room_id']").val($this.children('option:selected').attr('data-room_id'));
				$("#createAppointmentModal input[name='user_room_time_id']").val($this.children('option:selected').attr('data-user_room_time_id'));
				$("#createAppointmentModal input[name='service_id']").val($this.children('option:selected').attr('data-service_id'));
				$("#createAppointmentModal input[name='user_commission']").val($this.children('option:selected').attr('data-user_commission'));
				$("#createAppointmentModal input[name='fee']").val($this.children('option:selected').attr('data-fee'));
				$("#createAppointmentModal .showFeeTokenCreateForm").val($this.children('option:selected').attr('data-fee'));
			}
			else{
				$("#createAppointmentModal input[name='room_id']").val('');
				$("#createAppointmentModal input[name='user_room_time_id']").val('');
				$("#createAppointmentModal input[name='service_id']").val('');
				$("#createAppointmentModal input[name='user_commission']").val('');
				$("#createAppointmentModal input[name='fee']").val('');
				$("#createAppointmentModal .showFeeTokenCreateForm").val('');
			}
		});

	});//onload

	$(document).ready(function() {
	    // Function to hide the dropdown
	    function hideDropdown() {
	    	if ($("#dropdownPatientSearchList").is(":visible")) {
	        	$('#dropdownPatientSearchList').hide();
			}
	    }

	    // Click event on the document
	    $(document).on('mousedown', function(e) {
	        var input = $("#createTokenInputPatientSearch");
	        var dropdown = $("#dropdownPatientSearchList");

	        // Check if the click was outside the input and the dropdown
	        if (!input.is(e.target) && !dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
	            hideDropdown();
	        }
	    });

	    // Optional: Hide dropdown when input loses focus (with delay to allow click events inside the dropdown to register)
	    $('#createTokenInputPatientSearch').on('blur', function() {
	        setTimeout(function() {
	            if (!$('#dropdownPatientSearchList').is(':focus') && !$('#createTokenInputPatientSearch').is(':focus')) {
	                $('#dropdownPatientSearchList').hide();
	            }
	        }, 200); // Adjust the delay if needed
	    });

	    ////Appointment
	    // Function to hide the dropdown
	    function hideDropdownAppointment() {
	    	if ($("#dropdownPatientSearchListAppointment").is(":visible")) {
	        	$('#dropdownPatientSearchListAppointment').hide();
			}
	    }

	    // Click event on the document
	    $(document).on('mousedown', function(e) {
	        var input = $("#createAppointmentInputPatientSearch");
	        var dropdown = $("#dropdownPatientSearchListAppointment");

	        // Check if the click was outside the input and the dropdown
	        if (!input.is(e.target) && !dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
	            hideDropdownAppointment();
	        }
	    });

	    // Optional: Hide dropdown when input loses focus (with delay to allow click events inside the dropdown to register)
	    $('#createAppointmentInputPatientSearch').on('blur', function() {
	        setTimeout(function() {
	            if (!$('#dropdownPatientSearchListAppointment').is(':focus') && !$('#createAppointmentInputPatientSearch').is(':focus')) {
	                $('#dropdownPatientSearchListAppointment').hide();
	            }
	        }, 200); // Adjust the delay if needed
	    });
	});
	</script>
	<div class="modal fade bd-example-modal-lg" id="createTokenModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Create Token</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="patient_id">
						<input type="hidden" name="room_id">
						<input type="hidden" name="user_room_time_id">
						<input type="hidden" name="service_id">
						<input type="hidden" name="user_commission">
						<input type="hidden" name="fee">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Patient</label>
									<input class="form-control" id="createTokenInputPatientSearch" placeholder="Search by name, mobile" type="text" required="">
									<div id="dropdownPatientSearchList" class="dropdown-patient-search-list"></div>
									<a href="javascript://" class="addPatientBtn">+ Add Patient</a>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Doctor *</label>
									<select name="user_id" class="form-control" required>
										<option value="">Select</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Date</label>
									<input class="form-control" name="at" type="date" value="<?=date('Y-m-d')?>" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Token #</label>
									<select name="token_number" class="form-control" required>
										<option value="">Select Token</option>
										<?php
										$tokenNumberKey = 0;
										$tokenNumberKeyTotal = 101;
										$token_numbers = explode(',', $token_numbers['token_numbers']);
										if (count($token_numbers) >= 101) {
											$tokenNumberKeyTotal = count($token_numbers) + 20;
										}
										for ($i=1; $i < $tokenNumberKeyTotal; $i++) {
										?>
											<?php if (!(in_array($i, $token_numbers))): ?>
												<?php if ($tokenNumberKey == 0): ?>
													<?php $tokenNumberKey = 1; ?>
													<option value="<?=$i?>" selected><?=$i?></option>
												<?php else: ?>
													<option value="<?=$i?>"><?=$i?></option>
												<?php endif ?>
											<?php endif ?>
										<?php
										}
										?>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Fee</label>
									<input class="form-control showFeeTokenCreateForm" type="text" value="" readonly>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Comment</label>
									<textarea name="comment" class="form-control"></textarea>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Add</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #createTokenModal -->
	<div class="modal fade bd-example-modal-lg" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Appointment</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="patient_id">
						<input type="hidden" name="room_id">
						<input type="hidden" name="user_room_time_id">
						<input type="hidden" name="service_id">
						<input type="hidden" name="user_commission">
						<input type="hidden" name="fee">
						<input type="hidden" name="type" value="general">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Patient</label>
									<input class="form-control" id="createAppointmentInputPatientSearch" placeholder="Search by name, mobile" type="text" required="">
									<div id="dropdownPatientSearchListAppointment" class="dropdown-patient-search-list"></div>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Doctor *</label>
									<select name="user_id" class="form-control" required>
										<option value="">Select</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Date</label>
									<input class="form-control" name="at" type="date" value="<?=date('Y-m-d')?>" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Token #</label>
									<select name="token_number" class="form-control" required>
										<option value="">Select Token</option>
										<?php
										$tokenNumberKey = 0;
										$tokenNumberKeyTotal = 101;
										$general_token_numbers = explode(',', $general_token_numbers['token_numbers']);
										if (count($general_token_numbers) >= 101) {
											$tokenNumberKeyTotal = count($general_token_numbers) + 20;
										}
										for ($i=1; $i < $tokenNumberKeyTotal; $i++) {
										?>
											<?php if (!(in_array($i, $general_token_numbers))): ?>
												<?php if ($tokenNumberKey == 0): ?>
													<?php $tokenNumberKey = 1; ?>
													<option value="<?=$i?>" selected><?=$i?></option>
												<?php else: ?>
													<option value="<?=$i?>"><?=$i?></option>
												<?php endif ?>
											<?php endif ?>
										<?php
										}
										?>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Fee</label>
									<input class="form-control showFeeTokenCreateForm" type="text" value="" readonly>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Comment</label>
									<textarea name="comment" class="form-control"></textarea>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Add</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #createAppointmentModal -->
<?php endif ?>


<style>
.dropdown-patient-search-list {
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
.dropdown-patient-search-list a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.schedule-container {
  	margin: 20px;
}
.createTokenBtnTokenNumber{
  	cursor: pointer;
}
.schedule-date {
	font-size: 1.5rem;
	font-weight: bold;
	padding: 10px;
}
.schedule-row {
	border-bottom: 1px solid #ddd;
	display: flex;
	align-items: center;
	min-height: 60px;
	margin-bottom: 2px;
}
.schedule-item {
	padding: 10px;
	flex: 1;
	display: flex;
	justify-content: space-between;
	align-items: center;
}
.count {
	font-weight: bold;
	font-size: 1.2rem;
	text-align: center;
	width: 50px;
}
.status-select {
	width: 150px;
}
.action-buttons i {
	margin: 0 5px;
	cursor: pointer;
}
</style>