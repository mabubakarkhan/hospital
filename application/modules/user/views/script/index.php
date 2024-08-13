<script>
$(function(){
	$(document).on('click', '.getUserServicesBtn', function(event) {
		event.preventDefault();
		$btnThis = $(this);
		$("#showUserServicesModal .modal-title").text($btnThis.attr('data-title'));
		$("#showUserServicesModal input[name='id']").val($btnThis.attr('data-id'));
		$("#showUserServicesModal form .row").html('<p>Loading...</p>');
		$("#showUserServicesModal").modal('show');
		$.post('<?=BASEURL."user/get-user-services"?>', {id: $btnThis.attr('data-id')}, function(resp) {
			resp = $.parseJSON(resp);
			$("#showUserServicesModal form .row").html(resp.html);
		});
	});

	$(document).on('submit', '#showUserServicesModal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#showUserServicesModal form .submitBtn").text('Wait...');
		$.post('<?=BASEURL."user/update-user-services"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#showUserServicesModal form .submitBtn").text('Update');
			alert(resp.msg);
		});
	});

});//onload
</script>


<div class="modal fade bd-example-modal-lg" id="showUserServicesModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Title</h4>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div><!-- /modal-header -->
			<div class="modal-body">

				<form>
					<input type="hidden" name="id">
					<div class="row">

						<!-- HTML -->

					</div><!-- /row -->
				</form>

			</div><!-- /modal-body -->
		</div><!-- /modal-content -->
	</div><!-- /modal-lg -->
</div><!-- #showUserServicesModal -->

