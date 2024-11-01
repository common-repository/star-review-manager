<div class="wrap">
	<h2>Reviews</h2>
	<a class="button" href="<?php echo admin_url()."admin.php?page=new_review"; ?>"/>Create Review</a>
	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				<th>Option type</th>
				<th>Review limit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$reviewcontainers = ReviewContainer::get_reviewcontainers();
				foreach ($reviewcontainers as $container) {?>
					<tr>
						<td><?php echo $container->title; ?></td>
						<td><?php echo $container->optiontype; ?></td>
						<td><?php echo $container->reviewlimit; ?></td>
						<td>Delete</td>
					</tr>
			<?php
				}?>
		</tbody>
	 </table>
</div>