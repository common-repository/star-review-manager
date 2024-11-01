<?php 
	if(isset($_POST['review_title'])) {
		$reviewcontainer = new ReviewContainer();
		$reviewcontainer->title = $_POST['review_title'];
		if(!empty($_POST['reviewlimit'])) { 
			$reviewcontainer->reviewlimit = $_POST['reviewlimit'];
		} else {
			$reviewcontainer->reviewlimit = 0;
		}
		
		if(isset($_POST['mailnotificationcheck']) && !empty($_POST['mailnotification'])) {
			$reviewcontainer->mailnotification = $_POST['mailnotification'];
		}
		$container_id = ReviewContainer::create((array)$reviewcontainer);
		if($_POST['ratingcategories'] && !empty($_POST['ratingcategories'])) {
			$reviewcontainer::create_rating_categories($container_id, $_POST['ratingcategories']);
		}
	}
?>

<script>
	jQuery(function() {
		jQuery('#mailnotificationcheck').change(function() {		
			if(jQuery(this).is(":checked")) {
				jQuery('#notifyemail').show();
			}else {
				jQuery('#notifyemail').hide();
			}
		});
		
		//perhaps I could make this more beautiful when I have more time:)
		jQuery('#categoryadd').click(function(e) {
			var categoryname = jQuery('#categoryname');
			debugger;
			if(categoryname.val()) {
				jQuery('#categories').append('<div id="category-' + categoryname.val() + '"></div>');
				var categoryContainer = jQuery('#category-' + categoryname.val());
				categoryContainer.append('<span class="list-group-item">' + categoryname.val() + '</span>');
				categoryContainer.append('<input type="hidden" name="ratingcategories[]" value ="' + categoryname.val() + '">');
				categoryContainer.append('<a href="" class="removeCategory" name="' + categoryname.val() + '">Remove</a>');
				categoryname.val('');
			}
			e.preventDefault();
		});
		
		jQuery('#categories').on('click', '.removeCategory', function(e) {
			jQuery(this).parent().remove();  
			e.preventDefault();
		});
		
	});
</script>

<div class="wrap">
	<h2><?php _e('New Review instance', 'star-review-manager'); ?></h2>
	<br>
	<div class="row">
		<form action="" method="post" role="form" class="col-lg-6 col-md-12 col-xs-12">
			<div class="form-group">
				<h4><?php _e('Title', 'star-review-manager'); ?></h4>
				<input class="form-control" placeholder="<?php _e('Title', 'star-review-manager'); ?>" id="review_title" type="text" name="review_title">
			</div>
			<div class="form-group">
				<h4><?php _e('Rating categories', 'star-review-manager'); ?></h4>
				<div id="categories" class="list-group">
				</div>
			</div>
			<div class="form-group">
				<input class="form-control"type="text" id="categoryname" placeholder="<?php _e('Category name', 'star-review-manager'); ?>"/>
				<a href="" class="button" id="categoryadd"><?php _e('Add category', 'star-review-manager'); ?></a>
			</div>
			<div class="form-group">
				<h4><?php _e('Email notification', 'star-review-manager'); ?></h4>
				<label for="mailnotificationcheck"><?php _e('Send me notifications on review submit', 'star-review-manager'); ?></label>
				<input class="checkbox" type="checkbox" name="mailnotificationcheck" id="mailnotificationcheck">
				<div id="notifyemail" style="display: none; ">
					<input placeholder="<?php _e('Email addres', 'star-review-manager'); ?>" class="form-control" id="mailnotification" type="text" name="mailnotification">
				</div>
			</div>
			<div class="form-group">
				<h4><?php _e('Amount of reviews per page', 'star-review-manager'); ?></h4>
				<input class="form-control" value="0" id="reviewlimit" placeholder="<?php _e('0 is infinite', 'star-review-manager'); ?>" type="text" name="reviewlimit">
			</div>
			<input value="<?php _e('Save', 'star-review-manager'); ?>" class="button" type="submit" />
			<a class="button" href="<?php echo admin_url()."admin.php?page=manage_reviewcontainers"; ?>"/><?php _e('Back to review instances overview', 'star-review-manager'); ?></a>
		</form>
	</div>
</div>