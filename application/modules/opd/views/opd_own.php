<div class="container-fluid dashboard-default">
	<?php if ($general_tokens): ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>General Tokens </h3>
					<br>
				</div>
			</div>
	    </div>

	    <div class="container-fluid">
	        <div class="row">
	        	
	        	<?php if ($general_tokens): ?>
					<?php foreach ($general_tokens as $key => $token): ?>
						<div class="col-sm-3">
							<a href="javascript://" class="tokentDetailBtn" data-id="<?=$token['token_id']?>" data-token_number="<?=$token['token_number']?>" data-comment="<?=$token['comment']?>" data-status="<?=$token['status']?>" data-type="<?=$token['type'].' consultation'?>" data-date="<?=date('l, F j',strtotime($token['at']))?>" data-title="<?=$token['patientFname'].' '.$token['patientLname']?>" data-mobile="<?=$token['patientMobile']?>">
								<div class="card">
				                  	<div class="widget-feedback card-body">
					                    <div class="feedback-top text-center">
					                      	<h1>
												<?php if ($token['status'] == 'scheduled'): ?>
													<span><span class="badge badge-pill badge-dark"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-dark" style="font-size: 14px;"><?=$token['status']?></span>
												<?php elseif ($token['status'] == 'confirmed'): ?>
													<span><span class="badge badge-pill badge-warning"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-warning" style="font-size: 14px;"><?=$token['status']?></span></span>
												<?php elseif ($token['status'] == 'checked in'): ?>
													<span><span class="badge badge-pill badge-info"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-info" style="font-size: 14px;"><?=$token['status']?></span></span>
												<?php elseif ($token['status'] == 'checked out'): ?>
													<span><span class="badge badge-pill badge-success"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-success" style="font-size: 14px;"><?=$token['status']?></span></span>
												<?php elseif ($token['status'] == 'no show'): ?>
													<span><span class="badge badge-pill badge-light"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-light" style="font-size: 14px;"><?=$token['status']?></span></span>
												<?php elseif ($token['status'] == 'dismissed'): ?>
													<span><span class="badge badge-pill badge-danger"><?=$token['token_number']?></span></span><br>
													<span><span class="badge badge-pill badge-adanger" style="font-size: 14px;"><?=$token['status']?></span></span>
												<?php endif ?>
											</h1>
					                    </div><!-- /feedback-top -->
										<ul>
											<li><h6 style="font-size: 12px;">Fee</h6><h3 class="font-danger"><?=$token['fee']?></h3></li>
											<li><h6 style="font-size: 12px;">Commission</h6><h3 class="font-success"><?=($token['fee']/100)*$token['user_commission']?></h3></li>
										</ul>
				                  	</div><!-- /widget-feedback -->
				                </div><!-- /card -->
			                </a>
						</div><!-- /4 -->
					<?php endforeach ?>
	        	<?php endif ?>

	        </div><!-- row -->
	    </div><!-- /container-fluid -->
	<?php endif ?>


    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Current Tokens 
					<?php if ($permissions == 'all' || in_array('create_token', $permissions)): ?>
						<a href="javascript://" class="btn btn-success createTokenBtn" style="float: right;">Create Token</a>
	              	<?php endif ?>
				</h3>
				<br>
			</div>
		</div>
    </div>

    <div class="container-fluid">
        <div class="row">
        	
        	<?php if ($tokens): ?>
				<?php foreach ($tokens as $key => $token): ?>
					<div class="col-sm-3">
						<a href="javascript://" class="tokentDetailBtn" data-id="<?=$token['token_id']?>" data-token_number="<?=$token['token_number']?>" data-comment="<?=$token['comment']?>" data-status="<?=$token['status']?>" data-type="<?=$token['type'].' consultation'?>" data-date="<?=date('l, F j',strtotime($token['at']))?>" data-title="<?=$token['patientFname'].' '.$token['patientLname']?>" data-mobile="<?=$token['patientMobile']?>">
							<div class="card">
			                  	<div class="widget-feedback card-body">
				                    <div class="feedback-top text-center">
				                      	<h1>
											<?php if ($token['status'] == 'scheduled'): ?>
												<span><span class="badge badge-pill badge-dark"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-dark" style="font-size: 14px;"><?=$token['status']?></span>
											<?php elseif ($token['status'] == 'confirmed'): ?>
												<span><span class="badge badge-pill badge-warning"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-warning" style="font-size: 14px;"><?=$token['status']?></span></span>
											<?php elseif ($token['status'] == 'checked in'): ?>
												<span><span class="badge badge-pill badge-info"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-info" style="font-size: 14px;"><?=$token['status']?></span></span>
											<?php elseif ($token['status'] == 'checked out'): ?>
												<span><span class="badge badge-pill badge-success"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-success" style="font-size: 14px;"><?=$token['status']?></span></span>
											<?php elseif ($token['status'] == 'no show'): ?>
												<span><span class="badge badge-pill badge-light"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-light" style="font-size: 14px;"><?=$token['status']?></span></span>
											<?php elseif ($token['status'] == 'dismissed'): ?>
												<span><span class="badge badge-pill badge-danger"><?=$token['token_number']?></span></span><br>
												<span><span class="badge badge-pill badge-adanger" style="font-size: 14px;"><?=$token['status']?></span></span>
											<?php endif ?>
										</h1>
				                    </div><!-- /feedback-top -->
									<ul>
										<li><h6 style="font-size: 12px;">Fee</h6><h3 class="font-danger"><?=$token['fee']?></h3></li>
										<li><h6 style="font-size: 12px;">Commission</h6><h3 class="font-success"><?=($token['fee']/100)*$token['user_commission']?></h3></li>
									</ul>
			                  	</div><!-- /widget-feedback -->
			                </div><!-- /card -->
		                </a>
					</div><!-- /4 -->
				<?php endforeach ?>
        	<?php endif ?>

        </div><!-- row -->
    </div><!-- /container-fluid -->

</div><!-- /dashboard-default -->

