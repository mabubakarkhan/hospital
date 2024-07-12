<script>
$(function(){

	$(document).on('click', '.get-room-facilities', function(event) {
		event.preventDefault();
		$this = $(this);
		$id = $this.attr('data-id');
		$("#show-facilities-modal .modal-title").text($this.attr('data-title')+' - Facilities');
		$("#show-facilities-modal .modal-body").html('Loading...');
		$("#show-facilities-modal").modal('show');
		$("#show-facilities-modal .show-modal-msg").hide(0);
		$.post('<?=BASEURL."building/get-room-facilities"?>', {id: $id}, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$("#show-facilities-modal .modal-body").html(resp.html);
			}
			else{
				$("#show-facilities-modal").modal('hide');
				alert(resp.msg);
			}
		});
	});

	$(document).on('submit', '#show-facilities-modal form', function(event) {
		event.preventDefault();
		$form  = $(this);
		$("#show-facilities-modal .show-modal-msg").show(0);
		$("#show-facilities-modal .show-modal-msg").html('<p class="alert">Loading...<p>');
		$.post('<?=BASEURL."building/save-room-facilities"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$("#show-facilities-modal .show-modal-msg").html('<p class="alert alert-success">'+resp.msg+'</p>');
			}
			else{
				$("#show-facilities-modal .show-modal-msg").html('<p class="alert alert-danger">'+resp.msg+'</p>');
			}
		});
	});

});//onload
</script>


<div class="modal fade bd-example-modal-lg" id="show-facilities-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Facilities</h4>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div><!-- /modal-header -->
			<div class="modal-body">


			</div><!-- /modal-body -->
		</div><!-- /modal-content -->
	</div><!-- /modal-lg -->
</div><!-- #show-facilities-modal -->