<?php
$tokenNumbers = array_column($tokens, 'token_number');
$tokenIndex = 101;
if (count($tokens) >= '100') {
	$tokenIndex = count($tokens) + 11;
}
?>
<div class="schedule-container">
    <div class="schedule-date"><?=date('D d, F Y',strtotime($currentDate))?></div>
    <?php
    for ($i=1; $i < $tokenIndex; $i++) {
    	$index = array_search((string)$i, $tokenNumbers);
    	if ($index !== false && $tokens) {
    	?>
    		<div class="schedule-row" style="background: rgba(92,97,242,0.1);">
				<div class="count"><?=$i?></div>
				<div class="schedule-item" style="border-left: 2px solid rgba(92,97,242,1);">
					<div>
						<strong><?=$tokens[$index]['patientFname'].' '.$tokens[$index]['patientLname']?></strong>
						<br>
						<small><?=$tokens[$index]['serviceName'].' - '.$tokens[$index]['roomTitle'].' - '.$tokens[$index]['floorTitle']?></small>
					</div>
					<div class="d-flex align-items-center">
						<!-- <select class="form-select status-select " aria-label="Select Status">
							<option selected>Select Status</option>
							<option value="1">Pending</option>
							<option value="2">In Progress</option>
							<option value="3">Completed</option>
						</select> -->
						<div class="action-buttons ms-3">
							<?php if ($tokens[$index]['status'] == 'scheduled'): ?>
								<span><span class="badge badge-pill badge-dark" style="font-size: 11px;"><?=$tokens[$index]['status']?></span>
							<?php elseif ($tokens[$index]['status'] == 'confirmed'): ?>
								<span><span class="badge badge-pill badge-warning" style="font-size: 11px;"><?=$tokens[$index]['status']?></span></span>
							<?php elseif ($tokens[$index]['status'] == 'checked in'): ?>
								<span><span class="badge badge-pill badge-info" style="font-size: 11px;"><?=$tokens[$index]['status']?></span></span>
							<?php elseif ($tokens[$index]['status'] == 'checked out'): ?>
								<span><span class="badge badge-pill badge-success" style="font-size: 11px;"><?=$tokens[$index]['status']?></span></span>
							<?php elseif ($tokens[$index]['status'] == 'no show'): ?>
								<span><span class="badge badge-pill badge-light" style="font-size: 11px;"><?=$tokens[$index]['status']?></span></span>
							<?php elseif ($tokens[$index]['status'] == 'dismissed'): ?>
								<span><span class="badge badge-pill badge-adanger" style="font-size: 11px;"><?=$tokens[$index]['status']?></span></span>
							<?php endif ?>
							<i class="fa fa-print" title="Print"></i>
							<i class="fa fa-trash" title="Delete"></i>
						</div><!-- /action-buttons -->
					</div><!-- /d-flex -->
				</div><!-- /schedule-item -->
		    </div><!-- /schedule-row -->
    	<?php
	    }//if (in_array)
	    else {
	    ?>
		    <div class="schedule-row  <?=($allowCreateTokenButton) ? 'createTokenBtnTokenNumber' : ''?>" data-token="<?=$i?>">
		    	<div class="count"><?=$i?></div>
		    </div><!-- /schedule-row -->
	    <?php
	    }//else
    }//for
    ?>
</div><!-- /schedule-container -->