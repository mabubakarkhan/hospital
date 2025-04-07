<script>
$(function(){
	$(document).on('submit', '#emergency-setting-form-id', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#emergency-setting-form-id button").text('Wait...');
		$.post($form.attr('action'), {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#emergency-setting-form-id button").text('Update');
			alert(resp.msg);
		});
	});
	$(document).on('submit', '#emergency-setting-user-form-id', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#emergency-setting-user-form-id button").text('Wait...');
		$.post($form.attr('action'), {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#emergency-setting-user-form-id button").text('Update');
			alert(resp.msg);
		});
	});


    $('.user-select').each(function() {
        if (!$(this).hasClass('editMode')) {
            $(this).find('option').each(function() {
                $(this).hide();
            });
        }
    });

    $(document).on('change', '.service-select', function() {
        var serviceId = $(this).val();
        var $row = $(this).closest('.row');
        var $userSelect = $row.find('.user-select');

        $userSelect.find('option').each(function() {
            var userServiceId = $(this).attr('data-service');
            if (userServiceId != serviceId && serviceId != '') {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    $(document).on('click', '.addNewLine', function(e) {
        e.preventDefault();
        var $row = $(this).closest('.row');
        var $newRow = $row.clone();

        $newRow.find('.service-select').each(function() {
            $(this).val('');
            $(this).find('option').show();
        });
        $newRow.find('.user-select').each(function() {
            $(this).val('');
            $(this).find('option').hide();
        });
        $newRow.find('input[name="fee"]').val("<?=$q['fee']?>");
        $newRow.appendTo('.userServices');
    });

    $(document).on('click', '.removeLine', function(e) {
        e.preventDefault();
        var $row = $(this).closest('.row');
        if ($('.userServices .row').length > 1) {
            $row.remove();
        } else {
            alert("You cannot remove the last row.");
        }
    });

    document.getElementById("emergency-setting-user-form-id").addEventListener("submit", function(event) {
    document.querySelectorAll('input[name="formatted_user_id[]"]').forEach(input => input.remove());
    document.querySelectorAll(".userServices .row").forEach((row, index) => {
        let userSelect = row.querySelector(".user-select");
        let hiddenInput = document.createElement("input");

        hiddenInput.type = "hidden";
        hiddenInput.name = "formatted_user_id[]";
        hiddenInput.value  = Array.from(userSelect.selectedOptions).map(opt => opt.value).join(",");
        
        row.appendChild(hiddenInput);
    });
});




});//onload
</script>