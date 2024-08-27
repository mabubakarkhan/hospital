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
														                <div class="flex-fill lab-test-title-tile <?=($prescription_lab_tests && in_array($activeTest['lab_test_id'], $prescription_lab_tests)) ? 'active' : ''?>" data-id="<?=$activeTest['lab_test_id']?>" data-title="<?=$activeTest['title']?>">
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
								
								<div class="card-body" style="padding: 0;">
				                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
				                      <li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Current Investigation<div class="d-flex"></div></a></li>
				                      <li class="nav-item"><a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Previous Investigation</a></li>
				                    </ul>
				                    <div class="tab-content" id="pills-tabContent">
										<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
											<br>
											<form id="prescriptionFormInvestigation">
												<?php if ($prescription): ?>
													<input type="hidden" name="prescription_id" value="<?=$prescription['prescription_id']?>">
												<?php else: ?>
													<input type="hidden" name="prescription_id" value="0">
												<?php endif ?>
												<input type="hidden" name="token_id" value="<?=$token['token_id']?>">
												<input type="hidden" name="user_id" value="<?=$token['user_id']?>">

												<?php if ($investigations): ?>
													<?php foreach ($investigations as $keyInvestigation => $investigation): ?>
														<div class="row" style="margin-bottom: 20px;">
															<div class="col-md-3">
																<div class="form-gorup">
																	<label>Type</label>
																	<select name="lab_test_id[]" class="form-control">
																		<option value="">Select</option>
																		<?php foreach ($lab_active_tests as $keyLAT2 => $LAT2): ?>
																			<option value="<?=$LAT2['lab_test_id']?>" <?=($LAT2['lab_test_id'] == $investigation['lab_test_id']) ? 'selected="selected"' : ''?> ><?=$LAT2['title']?></option>
																		<?php endforeach ?>
																	</select>
																	<input type="hidden" class="previous_result_at" value="<?=date('Y-m-d',strtotime($investigation['at']))?>">
																</div><!-- /form-gorup -->
															</div><!-- /3 -->
															<div class="col-md-3">
																<div class="form-gorup">
																	<label>Result</label>
																	<input type="text" name="result[]" value="<?=$investigation['result']?>" class="form-control">
																</div><!-- /form-gorup -->
															</div><!-- /3 -->
															<div class="col-md-3">
																<div class="form-gorup">
																	<label>Previous Result</label>
																	<input type="text" name="previous_result[]" value="<?=$investigation['previous_result']?>" class="form-control" readonly>
																	<?php if (isset($investigation['previous_result']) && strlen($investigation['previous_result']) > 0): ?>
																		<input type="text" name="previous_result_at[]" value="<?=date('Y-m-d',strtotime($investigation['previous_result_at']))?>" class="form-control" readonly>
																	<?php else: ?>
																		<input type="text" name="previous_result_at[]" value="" class="form-control" readonly style="display: none;">
																	<?php endif ?>
																</div><!-- /form-gorup -->
															</div><!-- /3 -->
															<div class="col-md-2">
																<div class="form-gorup">
																	<label>Comment</label>
																	<textarea name="comment[]" class="form-control" rows="1"><?=$investigation['comment']?></textarea>
																</div><!-- /form-gorup -->
															</div><!-- /2 -->
															<div class="col-md-1" style="position: relative;">
																<span class="removeInvestigationSelectBoxBtn"><i class="fa fa-trash-o"></i></span>
															</div><!-- /1 -->
														</div><!-- /row -->
													<?php endforeach ?>
												<?php endif ?>

											</form><!-- #prescriptionFormInvestigation -->

											<div class="row">
												<div class="col-md-12" align="right">
													<br>
													<button class="btn btn-square btn-success saveInvestigationBtn">Save</button>
													<button class="btn btn-square btn-primary addInvestigationBtn">+ Investigation</button>
												</div>
											</div><!-- /row -->


										</div><!-- /pills-home -->
										<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
											<br>
											<table class="table table-bordered">
												<thead class="table-dark">
													<tr>
														<th>Test</th>
														<th>Result</th>
														<th>Comment</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($investigations as $keyInvestigation => $investigation): ?>
														<tr>
															<td><?=$investigation['labTestTitle']?></td>
															<td><?=$investigation['result']?></td>
															<td><?=$investigation['comment']?></td>
															<td><?=date('Y-m-d',strtotime($investigation['at']))?></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>


										</div><!-- /pills-profile -->
				                    </div><!-- /tab-content -->
			                  	</div><!-- /card-body -->

							</div><!-- #Investigation-icon -->
                    	</div><!-- /tab-content -->
                  	</div><!-- /card-body -->
                </div><!-- /card -->
          	</div><!-- /9 -->

          	<div class="col-sm-12 col-xl-3">
          		<div class="card">
          			<div class="card-body">
	                    <div class="default-according" id="accordionclose">

	                      	<div class="card">
								<div class="card-header" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="heading1" style="cursor: pointer;">
									<h5 class="mb-0"><button class="btn btn-link ps-0">Drugs</button></h5>
								</div><!-- /card-header -->
								<div class="collapse" id="collapse1" aria-labelledby="heading1" data-bs-parent="#accordionclose">
									<div class="card-body" style="padding: 20px 10px;">
										
										<p align="right"><a href="javascript:void(0);" class="addDrugToPrescription" style="color: #000;">+ Add</a></p>
										<div class="prescriptionDrugList">
											<?php if ($prescription_drugs): ?>
												<ul class="prescriptionDrugListItemWrap">
													<?php foreach ($prescription_drugs as $keyPD => $pd): ?>
														<li class="prescriptionDrugListItem">
															<span><?=$pd['name'].' '.$pd['type'].' '.$pd['strength_frequencey']?></span>
															<small>
																<a href="javascript://" class="editPrescriptionDrugItem" data-id="<?=$pd['prescription_drug_id']?>" data-prescription_id="<?=$pd['prescription_id']?>" data-drug_id="<?=$pd['drug_id']?>" data-name="<?=$pd['name']?>" data-type="<?=$pd['type']?>" data-generic_name="<?=$pd['generic_name']?>" data-strength="<?=$pd['strength']?>" data-strength_frequencey="<?=$pd['strength_frequencey']?>" data-instruction="<?=$pd['instruction']?>" data-duration="<?=$pd['duration']?>" data-duration_type="<?=$pd['duration_type']?>" data-frequency="<?=$pd['frequency']?>" data-quantity="<?=$pd['quantity']?>" data-quantity_type="<?=$pd['quantity_type']?>" data-route="<?=$pd['route']?>"><i class="icon-pencil-alt"></i></a> 
																<a href="javascript://" class="removePrescriptionDrugItem" data-id="<?=$pd['prescription_drug_id']?>" style="color: red;"><i class="fa fa-trash-o"></i></a>
															</small>
														</li>
													<?php endforeach ?>
												</ul>
											<?php endif ?>
										</div><!-- /prescriptionDrugList -->

									</div><!-- /card-body -->
								</div><!-- /collapse -->
	                      	</div><!-- /card -->

	                    </div><!-- /default-according -->
                  	</div><!-- /card-body -->
                </div><!-- /card -->
          	</div><!-- /3 -->

        </div><!-- row -->
    </div><!-- /container-fluid -->

</div><!-- /dashboard-default -->



<style>

</style>