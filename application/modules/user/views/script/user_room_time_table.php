<script>
$(function(){

	$(document).on('submit', '#assigningRoomFormId form', function(event) {
		event.preventDefault();
		$form = $(this);
		$(".successMsgSection").hide(0);
		$(".errorMsgSection").hide(0);
		$("#assigningRoomFormId form button").text('wait...');
		$.post('<?=BASEURL."user/post-user-room-time-table"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#assigningRoomFormId form button").text('Submit');
			if (resp.status == true) {
				$(".successMsgSection p").text(resp.msg);
				$(".successMsgSection").show(0);
				location.reload();
			}
			else{
				$(".errorMsgSection p").text(resp.msg);
				$(".errorMsgSection").show(0);
			}
		});
	});

});//onload
</script>