<script>
$(function(){

	$(document).on('change', 'select[name="building_id"]', function(event) {
		event.preventDefault();
		$this = $(this);
		$id = $this.val();
		$('select[name="floor_id"]').html('<option value="">Select</option>');
		$('select[name="room_id"]').html('<option value="">Select</option>');
		if ($id.length > 0) {
			$.post('<?=BASEURL."user/get-floors"?>', {id: $id}, function(resp) {
				resp = jQuery.parseJSON(resp);
				if (resp.status == true) {
					$('select[name="floor_id"]').html(resp.html);
				}
				else{
					alert(resp.msg);
				}
			});
		}
	});

	$(document).on('change', 'select[name="floor_id"]', function(event) {
		event.preventDefault();
		$this = $(this);
		$id = $this.val();
		$('select[name="room_id"]').html('<option value="">Select</option>');
		if ($id.length > 0) {
			$.post('<?=BASEURL."user/get-rooms"?>', {id: $id}, function(resp) {
				resp = jQuery.parseJSON(resp);
				if (resp.status == true) {
					$('select[name="room_id"]').html(resp.html);
				}
				else{
					alert(resp.msg);
				}
			});
		}
	});

});//onload
</script>