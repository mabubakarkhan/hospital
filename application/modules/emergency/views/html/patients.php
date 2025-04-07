<div class="table-responsive theme-scrollbar">
	<table class="table">
  		<thead>
    		<tr class="border-bottom-primary">
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Phone</th>
				<th scope="col">Service</th>
				<th scope="col">Fee</th>
				<th scope="col">Check In</th>
				<th scope="col">Status</th>
				<?php if ($discharge): ?>
					<th scope="col">Discharge</th>
				<?php endif ?>
    		</tr>
  		</thead>
  		<tbody>
  			<?php if ($patients): ?>
  				<?php foreach ($patients as $key => $patient): ?>
            		<tr class="border-bottom-success">
						<th scope="row"><?=($key+1)?></th>
						<td><?=$patient['fname'].' '.$patient['lname']?></td>
						<td><?=$patient['mobile']?></td>
						<td><?=$patient['serviceTitle']?></td>
						<td><?=$patient['fee']?></td>
						<td><?=date('d-m h:i A',strtotime($patient['at']))?></td>
						<td><span class="badge badge-light-success"><?=$patient['status']?></span></td>
						<?php if ($discharge): ?>
							<td><a href="<?=BASEURL.'prescription/new/true/?id='.$patient['emergency_admit_id']?>"><span class="badge badge-light-primary"><i class="icon-pencil-alt"></i></span></a></td>
						<?php endif ?>
        			</tr>
  				<?php endforeach ?>
  			<?php else: ?>
  				<tr class="border-bottom-danger">
  					<th colspan="8">No patient admitted right now.</th>
    			</tr>
  			<?php endif ?>
			</tbody>
	</table>
	</div><!-- /table-responsive -->