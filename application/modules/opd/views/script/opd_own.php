<?php
$checkUserPermissions = unserialize($_SESSION['user']);
if ($checkUserPermissions['permissions'] == 'all' || in_array('change_token_status', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){
		$(document).on('click', '.tokentDetailBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#viewTokenModal .tokenIdModalInput").val($this.attr('data-id'));
			$("#viewTokenModal .modal-title").text($this.attr('data-title'));
			$("#viewTokenModal .tokenTypeModal span").text($this.attr('data-type'));
			$("#viewTokenModal .tokenDateModal span").text($this.attr('data-date'));
			$("#viewTokenModal .tokenMobileModal span").text($this.attr('data-mobile'));
			$("#viewTokenModal .tokenNumberModal").text($this.attr('data-token_number'));
			$("#viewTokenModal .tokenCommentModalTextarea").val($this.attr('data-comment'));
			$("#viewTokenModal .tokenAddRecodBtnModal a").prop("href","<?=BASEURL.'prescription/new/?id='?>"+$this.attr('data-id'));
			$tokenStatus = $this.attr('data-status');
			statusActive($tokenStatus);
			$("#viewTokenModal").modal('show');
		});
		$(document).on('click', '.tokenChangeStatusBtnModal', function(event) {
			event.preventDefault();
			statusActive($(this).attr('data-status'));
		});
		$(document).on('click', '.tokenEditSubmitModalBtn', function(event) {
			event.preventDefault();
			$btn = $(this);
			$btn.text('Wait...');
			$.post('<?=BASEURL."opd/submit-token-status"?>', {
				id: $("#viewTokenModal .tokenIdModalInput").val(),
				comment: $("#viewTokenModal .tokenCommentModalTextarea").val(),
				status: $("#viewTokenModal .tokenStatusModalInput").val()
			}, function(resp) {
				resp = $.parseJSON(resp);
				$btn.text('Save');
				alert(resp.msg);
				if (resp.status == true) {
					location.reload();
				}
			});
		});
		function statusActive($status) {
			$(".tokenChangeStatusListModal").html('');
			$tokenStatusListModalHtml = '';
			if ($status != 'checked in' && $status != 'checked out' && $status != 'no show' && $status != 'dismissed') {
				if ($status == 'scheduled') {
					$tokenStatusListModalHtml += '<li data-status="scheduled" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-dark" style="font-size: 10px;">Scheduled</span></li>';
					$(".tokenStatusModalInput").val('scheduled');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="scheduled" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-dark" style="font-size: 10px;">Scheduled</span></li>';
				}
			}
			if ($status != 'checked in' && $status != 'checked out' && $status != 'no show' && $status != 'dismissed') {
				if ($status == 'confirmed') {
					$tokenStatusListModalHtml += '<li data-status="confirmed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-warning" style="font-size: 10px;">Confirmed</span></li>';
					$(".tokenStatusModalInput").val('confirmed');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="confirmed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-warning" style="font-size: 10px;">Confirmed</span></li>';
				}
			}
			if ($status != 'no show' && $status != 'dismissed') {
				if ($status == 'checked in') {
					$tokenStatusListModalHtml += '<li data-status="checked in" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-info" style="font-size: 10px;">Checked In</span></li>';
					$(".tokenStatusModalInput").val('checked in');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="checked in" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-info" style="font-size: 10px;">Checked In</span></li>';
				}
			}
			if ($status != 'no show' && $status != 'dismissed') {
				if ($status == 'checked out') {
					$tokenStatusListModalHtml += '<li data-status="checked out" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-success" style="font-size: 10px;">Checked Out</span></li>';
					$(".tokenStatusModalInput").val('checked out');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="checked out" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-success" style="font-size: 10px;">Checked Out</span></li>';
				}
			}
			if ($status != 'checked in' && $status != 'checked out' && $status != 'confirmed' && $status != 'dismissed') {
				if ($status == 'no show') {
					$tokenStatusListModalHtml += '<li data-status="no show" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-light" style="font-size: 10px;">No Show</span></li>';
					$(".tokenStatusModalInput").val('no show');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="no show" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-light" style="font-size: 10px;">No Show</span></li>';
				}
			}
			if ($status != 'checked out') {
				if ($status == 'dismissed') {
					$tokenStatusListModalHtml += '<li data-status="dismissed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-danger" style="font-size: 10px;">Dismissed</span></li>';
					$(".tokenStatusModalInput").val('dismissed');
				}
				else{
					$tokenStatusListModalHtml += '<li data-status="dismissed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-danger" style="font-size: 10px;">Dismissed</span></li>';
				}
			}
			$(".tokenChangeStatusListModal").html($tokenStatusListModalHtml);
		}
	});//onload
	</script>


	<div class="modal fade bd-example-modal-lg" id="viewTokenModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Patient Name</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<p>
						<style>
						ul.tokenChangeStatusListModal li{
							display: inline-block;
						}
						</style>
						<input type="hidden" class="tokenStatusModalInput">
						<input type="hidden" class="tokenIdModalInput">
						<ul class="tokenChangeStatusListModal">
							<li data-status="scheduled" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-dark" style="font-size: 10px;">Scheduled</span></li>
							<li data-status="confirmed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-warning" style="font-size: 10px;">Confirmed</span></li>
							<li data-status="checked in" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-info" style="font-size: 10px;">Checked In</span></li>
							<li data-status="checked out" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-success" style="font-size: 10px;">Checked Out</span></li>
							<li data-status="no show" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-light" style="font-size: 10px;">No Show</span></li>
							<li data-status="dismissed" class="tokenChangeStatusBtnModal" style="margin-right:2px;"><span class="btn btn-square btn-outline-danger" style="font-size: 10px;">Dismissed</span></li>
						</ul>
					</p>

					<div class="row d-flex justify-content-between">
						<div class="col-md-6">
							<ul>
								<li class="tokenTypeModal" style="margin-bottom: 7px;"><i class="fa fa-exclamation-circle"></i> <span style="text-transform: capitalize;">Token Consultation</span></li>
								<li class="tokenDateModal" style="margin-bottom: 7px;"><i class="fa fa-calendar"></i> <span style="text-transform: capitalize;">Tuesday, August 13</span></li>
								<li class="tokenMobileModal" style="margin-bottom: 7px;"><i class="fa fa-tablet"></i> <span style="text-transform: capitalize;">3455555555</span></li>
								<?php if ($checkUserPermissions['permissions'] == 'all' || in_array('add_prescription_token', $checkUserPermissions['permissions'])): ?>
									<li class="tokenAddRecodBtnModal" style="margin-bottom: 7px;"><a href="javascript://" target="_blank" style="color:#000;"><i class="fa fa-file"></i> <span style="text-transform: capitalize;">Add Health Record</span></a></li>
								<?php endif ?>
							</ul>
						</div><!-- /6 -->
						<div class="col-md-6">
							<h1 align="right"><small style="font-size: 13px">token# </small><span class="tokenNumberModal" style="font-size: 80px;">1</span></h1>
						</div><!-- /6 -->
					</div><!-- /row -->
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Comment</label>
								<textarea class="tokenCommentModalTextarea form-control"></textarea>
							</div><!-- /form-group -->
						</div><!-- /12 -->
					</div><!-- /row -->
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary tokenEditSubmitModalBtn">Save</button>
						</div><!-- /12 -->
					</div><!-- /row -->
				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #viewTokenModal -->
<?php
}//check permission
?>