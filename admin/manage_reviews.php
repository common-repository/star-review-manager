<?php
	
	if(isset($_GET['container_id'])) {
		$container_id = $_GET['container_id'];
		$pending_reviews = Review::get_reviews_by_container($container_id, 0);
		$active_reviews = Review::get_reviews_by_container($container_id, 1);
	}
?>

<div class="wrap">
	<?php if(SRM_FREE) { showDonate(); }; ?><br><br>
	 <a class="button" href="<?php echo admin_url()."admin.php?page=manage_reviewcontainers"; ?>"/><?php _e('Back to review instances overview', 'star-review-manager'); ?></a>
	<h2 style="color: red;"><?php _e('Pending reviews', 'star-review-manager'); ?></h2>
	<table class="table">
		<thead>
			<tr>
				<th class="hidden-phone col-sm-1 col-lg-1 col-md-1"><?php _e('ID', 'star-review-manager'); ?></th>
				<th class="col-sm-4 col-lg-4 col-md-4"><?php _e('Message', 'star-review-manager'); ?></th>
				<th class="col-sm-1 col-lg-1 col-md-1"><?php _e('Rating', 'star-review-manager'); ?></th>
				<th class="hidden-phone col-sm-2 col-lg-2 col-md-2"><?php _e('Created', 'star-review-manager'); ?></th>
				<th class="hidden-phone col-sm-2 col-lg-2 col-md-2"><?php _e('User', 'star-review-manager'); ?></th>
				<th class="col-sm-1 col-lg-1 col-md-1"><?php _e('Delete', 'star-review-manager'); ?></th>
				<th class="col-sm-1 col-lg-1 col-md-1"><?php _e('Approve', 'star-review-manager'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($pending_reviews as $review) {
					if($review->status == 0) {?>
					<tr>
						<td><?php echo $review->id; ?></td>
						<td><?php echo $review->message; ?></td>
						<td>
							<div class="row">
							<?php
							$reviewratings = Review::get_review_ratings($review->id);
							if($reviewratings && !empty($reviewratings)) {
								foreach($reviewratings as $rating) {
									echo '<span class="col-xs-6 col-lg-6 col-md-6">'. $rating['ratingcategory'] .'</span>'; 
									echo '<span class="col-xs-6 col-lg-6 col-md-6"> ' . $rating['ratingvalue'] . '</span><br>';
								}
							}
							?>
							</div>
						</td>
						<td><?php echo date('F d, Y h:mA', strtotime($review->created)); ?></td>
						<td>
						<?php 	if($review->user_id != NULL) {
									$user = User::get_user($review->user_id);
									if($user) { 
										echo $user['firstname'] . ' ' . $user['lastname'];
									} else {
										_e('Anonymous', 'star-review-manager');
									}
								}?>
						</td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="srm_crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="srm_crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="srm_crud[action]" value="delete" />
								<input class="button" type="submit" name="srm_crud[review]" value="<?php _e('Delete', 'star-review-manager'); ?>" />
							 </form>
						 </td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="srm_crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="srm_crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="srm_crud[action]" value="approve" />
								<input class="button" type="submit" name="srm_crud[review]" value="<?php _e('Approve', 'star-review-manager'); ?>" />
							 </form>
						 </td>
					</tr>
				<?php
					}
				}?>
		</tbody>
	 </table>
	 
	 <h2 style="color: green;"><?php _e('Active reviews', 'star-review-manager'); ?></h2>
	<table class="table">
		<thead>
			<tr>
				<th class="hidden-phone col-sm-1 col-lg-1 col-md-1"><?php _e('ID', 'star-review-manager'); ?></th>
				<th class="col-sm-4 col-lg-4 col-md-4"><?php _e('Message', 'star-review-manager'); ?></th>
				<th class="col-sm-1 col-lg-1 col-md-1"><?php _e('Rating', 'star-review-manager'); ?></th>
				<th class="hidden-phone col-sm-2 col-lg-2 col-md-2"><?php _e('Created', 'star-review-manager'); ?></th>
				<th class="hidden-phone col-sm-2 col-lg-2 col-md-2"><?php _e('User', 'star-review-manager'); ?></th>
				<th class="col-sm-2 col-lg-2 col-md-2"><?php _e('Delete', 'star-review-manager'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($active_reviews as $review) {
					if($review->status && $review->status == 1) {?>
					<tr>
						<td><?php echo $review->id; ?></td>
						<td><?php echo $review->message; ?></td>
						<td>
							<div class="row">
							<?php
							$reviewratings = Review::get_review_ratings($review->id);
							if($reviewratings && !empty($reviewratings)) {
								foreach($reviewratings as $rating) {
									echo '<span class="col-xs-6 col-lg-6 col-md-6">'. $rating['ratingcategory'] .'</span>'; 
									echo '<span class="col-xs-6 col-lg-6 col-md-6"> ' . $rating['ratingvalue'] . '</span><br>';
								}
							}
							?>
							</div>
						</td>
						<td><?php echo gmdate("d M Y H:i", strtotime($review->created)); ?></td>
						<td>
						<?php 	if($review->user_id != NULL) {
									$user = User::get_user($review->user_id);
									if($user) { 
										echo $user['firstname'] . ' ' . $user['lastname'];
									} else {
										_e('Anonymous', 'star-review-manager');
									}
								}?>
						</td>
						<td>
							<form method="post" action="#">
								<input type="hidden" name="srm_crud[id]" value="<?php echo $review->id;?>" />
								<input type="hidden" name="srm_crud[container_id]" value="<?php echo $container_id;?>" />
								<input type="hidden" name="srm_crud[action]" value="delete" />
								<input class="button" type="submit" name="srm_crud[review]" value="<?php _e('Delete', 'star-review-manager'); ?>" />
							 </form>
						 </td>
					</tr>
				<?php
					}
				}?>
		</tbody>
	 </table>
</div>
