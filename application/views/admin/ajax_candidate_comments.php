<div class="indidual-div-previos-comments">
<?php if(!empty($comments)){$i=1;foreach ($comments as $cmnts) { ?>
<div class="previos-comments">
<div class="app-reviews-card">
	<p class="app-reviews-card-count mb-0"><?php echo $i; ?>)</p>
	<div class="app-reviews-card-content">
		<ul>
			<li><p>Comments</p> <span>: <?php echo $cmnts['comments']; ?></span></li>
			<li>
				<p>Status</p>
				<span> :
					<?php 
						if($cmnts['status']=='source_applied'){
							echo 'source/applied';
						}else if($cmnts['status']=='internal_interview'){
							echo 'internal interview';
						}else if($cmnts['status']=='client_interview'){
							echo 'client interview';
						}else{
							echo $cmnts['status'];
						}
					?>
				</span>
			</li>
			<li><p>Date</p> <span>: <?php echo DD_M_YY_h_i_s($cmnts['date']); ?></span></li>
		</ul>
	</div> 
</div>
</div>
<?php $i++;} } ?>
</div>