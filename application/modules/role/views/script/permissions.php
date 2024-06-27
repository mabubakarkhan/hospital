<script>
$(function(){

	$(document).on('submit', 'form', function(event) {
		event.preventDefault();
		$form = $(this);
		$(".card-footer").fadeOut();
		$(".card-footer-loader").fadeIn();
		$.post('<?=BASEURL."role/update-permissions"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$(".card-footer-loader").fadeOut();
			$(".card-footer").fadeIn();
			if (resp.status == true) {
				$(".show-msg").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Updated :)</strong> '+resp.msg+'<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}
			else{
				$(".show-msg").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> '+resp.msg+'<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}
		});

	});


});//onload
</script>