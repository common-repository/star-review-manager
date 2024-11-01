<div class="wrap">
	<?php if(SRM_FREE) { showDonate(); }; ?><br><br>
	<h2><?php _e('Review instances', 'star-review-manager'); ?></h2>
	<a class="button" href="<?php echo admin_url()."admin.php?page=new_reviewcontainer"; ?>"/><?php _e('Create review instance', 'star-review-manager'); ?></a>
	<table class="table table-fluid">
		<thead>
			<tr>
				<th><?php _e('Title', 'star-review-manager'); ?></th>
				<th><?php _e('Review limit', 'star-review-manager'); ?></th>
				<th><?php _e('Pending reviews', 'star-review-manager'); ?></th>
				<th><?php _e('Active reviews', 'star-review-manager'); ?></th>
				<th><?php _e('Manage reviews', 'star-review-manager'); ?></th>
				<th><?php _e('Shortcode', 'star-review-manager'); ?></th>
				<th><?php _e('Delete', 'star-review-manager'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$reviewcontainers = ReviewContainer::get_reviewcontainers();
				foreach ($reviewcontainers as $container) {?>
					<tr>
						<td><?php echo $container->title; ?></td>
						<td><?php echo $container->reviewlimit; ?></td>
						<td style="color: red;"><?php echo ReviewContainer::get_size($container->id, 0); ?></td>
						<td style="color: green;"><?php echo ReviewContainer::get_size($container->id, 1); ?></td>
						<td><a href="<?php echo admin_url()."admin.php?page=manage_reviews&container_id=".$container->id; ?>"><?php _e('Manage reviews', 'star-review-manager')?></a></td>
						<td>[srm_review id=<?php echo $container->id; ?>]</td>
						<td>
							<form method="post" action="#" onsubmit="return confirm('<?php _e('Are you sure that you want to delete this container and all related reviews?', 'star-review-manager'); ?>');">
								<input type="hidden" name="srm_crud[id]" value="<?php echo $container->id;?>" />
								<input type="hidden" name="srm_crud[action]" value="delete" />
								<input class="button" type="submit" name="srm_crud[reviewcontainer]" value="<?php _e('Delete', 'star-review-manager'); ?>" />
							 </form>
						 </td>
					</tr>
			<?php
				}?>
		</tbody>
	 </table>
	 <a class="button" style="float: right;" href="<?php echo admin_url()."admin.php?page=help"; ?>"/>Help?</a>
</div>
