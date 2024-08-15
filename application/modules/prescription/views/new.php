<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h5>
					<?=$token['patientFname'].' '.$token['patientLname'].' - '.$token['patientGender'].' - '.$token['patientAge'].' - '.$token['patientMobile']?>
					<br><small><?=$token['serviceName']?></small>
				</h5>
				<br>
			</div>
		</div>
    </div>

    <div class="container-fluid">
        <div class="row">
        	
        	<div class="col-sm-12 col-xl-9">
                <div class="card">
                  	<div class="card-body">
	                    <ul class="nav nav-tabs" id="icon-tab" role="tablist" style="margin-bottom: 20px;">
							<li class="nav-item"><a class="nav-link active" id="icon-Prescription-tab" data-bs-toggle="tab" href="#icon-Prescription" role="tab" aria-controls="icon-Prescription" aria-selected="true"><i class="fa fa-plus-square"></i>Prescription</a></li>
							<li class="nav-item"><a class="nav-link" id="Vitals-icon-tab" data-bs-toggle="tab" href="#Vitals-icon" role="tab" aria-controls="Vitals-icon" aria-selected="false"><i class="fa fa-heartbeat"></i>Vitals</a></li>
							<li class="nav-item"><a class="nav-link" id="Lab-order-icon-tab" data-bs-toggle="tab" href="#Lab-order-icon" role="tab" aria-controls="Lab-order-icon" aria-selected="false"><i class="icofont icofont-laboratory"></i>Lab order</a></li>
							<li class="nav-item"><a class="nav-link" id="Radiology-order-icon-tab" data-bs-toggle="tab" href="#Radiology-order-icon" role="tab" aria-controls="Radiology-order-icon" aria-selected="false"><i class="icofont icofont-radio-active"></i>Radiology order</a></li>
							<li class="nav-item"><a class="nav-link" id="Investigation-icon-tab" data-bs-toggle="tab" href="#Investigation-icon" role="tab" aria-controls="Investigation-icon" aria-selected="false"><i class="icofont icofont-first-aid-alt"></i>Investigation</a></li>
						</ul>
                    	<div class="tab-content" id="icon-tabContent">
                    		
							<div class="tab-pane fade show active" id="icon-Prescription" role="tabpanel" aria-labelledby="icon-home-tab">
								
								<form id="prescriptionFormId1">
									<?php if ($prescription): ?>
										<input type="hidden" name="prescription_id" value="<?=$prescription['prescription_id']?>">
									<?php endif ?>
									<input type="hidden" name="token_id" value="<?=$token['token_id']?>">
									<input type="hidden" name="user_id" value="<?=$token['user_id']?>">
									<div class="form-gorup">
										<label>Medical History</label>
										<textarea name="medical_history" class="form-control"><?=(isset($prescription['medical_history'])) ? $prescription['medical_history'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Complaint</label>
										<textarea name="complaint" class="form-control"><?=(isset($prescription['complaint'])) ? $prescription['complaint'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Examination</label>
										<textarea name="examination" class="form-control"><?=(isset($prescription['examination'])) ? $prescription['examination'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Diagnosis</label>
										<textarea name="diagnosis" class="form-control"><?=(isset($prescription['diagnosis'])) ? $prescription['diagnosis'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Clinical Notes</label>
										<textarea name="clinical_notes" class="form-control"><?=(isset($prescription['clinical_notes'])) ? $prescription['clinical_notes'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Advice</label>
										<textarea name="advice" class="form-control"><?=(isset($prescription['advice'])) ? $prescription['advice'] : ''?></textarea>
									</div><!-- /form-gorup -->
									<div class="form-gorup">
										<label>Investigation</label>
										<textarea name="investigation" class="form-control"><?=(isset($prescription['investigation'])) ? $prescription['investigation'] : ''?></textarea>
									</div><!-- /form-gorup -->

									<?php if ($procedures): ?>
										<div class="form-gorup">
											<br>
											<h6>Procedure</h6>
											<div class="col-md-4 addProcedureSection">
												<?php if ($prescription_procedures): ?>
													<?php foreach ($prescription_procedures as $keyPP => $pp): ?>
														<div style="position: relative;">
															<select name="procedure_id[]" class="form-control" style="margin: 10px 0;">
																<option value="">Select Procedure</option>
																<?php foreach ($procedures as $keyProcedure => $procedure): ?>
																	<option value="<?=$procedure['procedure_id']?>" <?=($procedure['procedure_id'] == $pp['procedure_id']) ? 'selected="selected"' : ''?> ><?=$procedure['name']?></option>
																<?php endforeach ?>
															</select>
															<span class="removeProcedureSelectBoxBtn"><i class="fa fa-trash-o"></i></span>
														</div>		
													<?php endforeach ?>	
												<?php else: ?>
													<div style="position: relative;">
														<select name="procedure_id[]" class="form-control" style="margin: 10px 0;">
															<option value="">Select Procedure</option>
															<?php foreach ($procedures as $keyProcedure => $procedure): ?>
																<option value="<?=$procedure['procedure_id']?>"><?=$procedure['name']?></option>
															<?php endforeach ?>
														</select>
														<span class="removeProcedureSelectBoxBtn"><i class="fa fa-trash-o"></i></span>
													</div>
												<?php endif ?>
											</div>
										</div><!-- /form-gorup -->
										<div class="form-gorup">
											<br>
											<button class="btn btn-square btn-primary addProcedureBtn">Add Procedure</button>
										</div><!-- /form-gorup -->
									<?php endif ?>

									<div class="form-gorup" style="text-align: right;">
										<br>
										<button type="submit" class="btn btn-square btn-primary">Save</button>
									</div><!-- /form-gorup -->

								</form><!-- #prescriptionFormId1 -->

							</div><!-- #icon-home -->

							<div class="tab-pane fade" id="Vitals-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
								

								<form id="prescriptionFormId2">
									<?php if ($prescription): ?>
										<input type="hidden" name="prescription_id" value="<?=$prescription['prescription_id']?>">
									<?php endif ?>
									<input type="hidden" name="token_id" value="<?=$token['token_id']?>">
									<input type="hidden" name="user_id" value="<?=$token['user_id']?>">
									<div class="row">
										
										<div class="col-md-3">
											<div class="form-group">
												<label>Pulse Heart Rate</label>
												<input type="text" class="form-control" name="pulse_heart_rate" value="<?=(isset($prescription['pulse_heart_rate'])) ? $prescription['pulse_heart_rate'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Temperature</label>
												<input type="text" class="form-control" name="temperature" value="<?=(isset($prescription['temperature'])) ? $prescription['temperature'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Blood Pressure</label>
												<input type="text" class="form-control" name="blood_pressure" value="<?=(isset($prescription['blood_pressure'])) ? $prescription['blood_pressure'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Diastolic Blood Pressure</label>
												<input type="text" class="form-control" name="diastolic_blood_pressure" value="<?=(isset($prescription['diastolic_blood_pressure'])) ? $prescription['diastolic_blood_pressure'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Respiratory Rate</label>
												<input type="text" class="form-control" name="respiratory_rate" value="<?=(isset($prescription['respiratory_rate'])) ? $prescription['respiratory_rate'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Blood Sugar</label>
												<input type="text" class="form-control" name="blood_sugar" value="<?=(isset($prescription['blood_sugar'])) ? $prescription['blood_sugar'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Weight (in kg e.g: 70)</label>
												<input type="text" class="form-control" name="weight" value="<?=(isset($prescription['weight'])) ? $prescription['weight'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Height (in feet e.g: 5.6)</label>
												<input type="text" class="form-control" name="height" value="<?=(isset($prescription['height'])) ? $prescription['height'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Body Mass Index (BMI)</label>
												<input type="text" class="form-control" name="body_mass_index" value="<?=(isset($prescription['body_mass_index'])) ? $prescription['body_mass_index'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Oxygen Saturation</label>
												<input type="text" class="form-control" name="oxygen_saturation" value="<?=(isset($prescription['oxygen_saturation'])) ? $prescription['oxygen_saturation'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-3">
											<div class="form-group">
												<label>Body Surface Area (BSA)</label>
												<input type="text" class="form-control" name="body_surface_area" value="<?=(isset($prescription['body_surface_area'])) ? $prescription['body_surface_area'] : ''?>">
											</div><!-- /form-group -->
										</div><!-- /3 -->
										<div class="col-md-12">
											<div class="form-gorup">
												<br>
												<button type="submit" class="btn btn-square btn-primary">Save</button>
											</div><!-- /form-gorup -->
										</div><!-- /12 -->


									</div><!-- /row -->

								</form><!-- #prescriptionFormId2 -->


							</div><!-- #Vitals-icon -->

							<div class="tab-pane fade" id="Lab-order-icon" role="tabpanel" aria-labelledby="contact-icon-tab">
								
			                    <div class="row">
									<div class="col-md-12">
									<ul class="selectedLabTestListUl">
										
									</ul>	
									</div><!-- /12 -->

									<div class="col-sm-2 col-xs-12">
										<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
											<?php foreach ($lab_test_cats as $keyLabCat => $labCat): ?>
												<a class="nav-link <?=($keyLabCat == 0) ? 'active' : ''?>" id="lab-test-cat-<?=$labCat['lab_test_cat_id']?>-tab" data-bs-toggle="pill" href="#lab-test-cat-tests-<?=$labCat['lab_test_cat_id']?>" role="tab" aria-controls="lab-test-cat-tests-<?=$labCat['lab_test_cat_id']?>" aria-selected="<?=($keyLabCat == 0) ? 'true' : 'false'?>"><?=$labCat['title']?></a>
											<?php endforeach ?>
										</div><!-- /nav -->
									</div><!-- /2 -->
			                      	<div class="col-sm-10 col-xs-12">
			                        	<div class="tab-content" id="v-pills-tabContent">
											<?php foreach ($lab_test_cats as $keyLabCat_ => $labCat_): ?>
												<div class="tab-pane fade <?=($keyLabCat_ == 0) ? 'show active' : ''?>" id="lab-test-cat-tests-<?=$labCat_['lab_test_cat_id']?>" role="tabpanel" aria-labelledby="lab-test-cat-<?=$labCat_['lab_test_cat_id']?>-tab">
													<div class="container">
    													<div class="row d-flex flex-wrap">
															<?php foreach ($lab_active_tests as $keyActiveTest => $activeTest): ?>
																<?php if ($activeTest['lab_test_cat_id'] == $labCat_['lab_test_cat_id']): ?>
																	<div class="col-md-3 d-flex align-items-stretch">
														                <div class="flex-fill lab-test-title-tile <?=(in_array($activeTest['lab_test_id'], $prescription_lab_tests)) ? 'active' : ''?>" data-id="<?=$activeTest['lab_test_id']?>" data-title="<?=$activeTest['title']?>">
														                    <?=$activeTest['title']?>
														                </div>
														            </div>
																<?php endif ?>
															<?php endforeach ?>
														</div><!-- {/row} -->
													</div><!-- {/container} -->
												</div>
											<?php endforeach ?>
			                        	</div><!-- /tab-content -->
			                      	</div><!-- /10 -->

			                      	<div class="col-md-12">
			                      		<form id="prescriptionFormId3">
			                      			<?php if ($prescription): ?>
												<input type="hidden" name="prescription_id" value="<?=$prescription['prescription_id']?>">
											<?php endif ?>
											<input type="hidden" name="token_id" value="<?=$token['token_id']?>">
											<input type="hidden" name="user_id" value="<?=$token['user_id']?>">
			                      			<div class="form-group" align="right">
			                      				<hr>
												<button type="submit" class="btn btn-square btn-primary">Save</button>
			                      			</div><!-- /form-group -->
			                      			<?php if ($prescription_lab_tests): ?>
			                      				<?php foreach ($prescription_lab_tests as $keyPLT => $plt): ?>
			                      					<input type="hidden" name="lab_test_id[]" value="<?=$plt?>">
			                      				<?php endforeach ?>
			                      			<?php endif ?>
			                      		</form>
			                      	</div><!-- /12 -->
			                    </div><!-- /row -->

							</div><!-- #Lab-order-icon -->

							<div class="tab-pane fade" id="Radiology-order-icon" role="tabpanel" aria-labelledby="contact-icon-tab">
								<p class="mb-0 m-t-30">D Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
							</div><!-- #Radiology-order-icon -->

							<div class="tab-pane fade" id="Investigation-icon" role="tabpanel" aria-labelledby="contact-icon-tab">
								<p class="mb-0 m-t-30">E Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
							</div><!-- #Investigation-icon -->
                    	</div><!-- /tab-content -->
                  	</div><!-- /card-body -->
                </div><!-- /card -->
          	</div><!-- /12 -->

        </div><!-- row -->
    </div><!-- /container-fluid -->

</div><!-- /dashboard-default -->



<style>

</style>