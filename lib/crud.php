<?php
	if( !empty($_POST) && !empty($_POST['srm_crud'])) {
	  if($_POST['srm_crud']['review']) {
		  /* reviews without id but container id */
		  if( empty($_POST['srm_crud']['id']) && !empty ($_POST['srm_crud']['action']) && !empty ($_POST['srm_crud']['container_id']) && filter_var($_POST['srm_crud']['container_id'], FILTER_VALIDATE_INT)) {
			if($_POST['srm_crud']['action'] == 'create'){
				/* create user */
				$user_id = null;
				if( !empty ($_POST['srm_crud']['firstname']) && !empty ($_POST['srm_crud']['lastname']) ) {
					$user = new User();
					$user->firstname = esc_attr($_POST['srm_crud']['firstname']);
					$user->lastname = esc_attr($_POST['srm_crud']['lastname']);
					if($_POST['srm_crud']['email'] && !empty ($_POST['srm_crud']['email'])) { $user->emailaddress = esc_attr($_POST['srm_crud']['email']); }
					$user_id = User::create((array) $user);
				}
				/* create review */
				$review = new Review();
				$review->container_id = $_POST['srm_crud']['container_id'];
				if($user_id) $review->user_id = $user_id;
				if(!empty($_POST['srm_crud']['message'])) $review->message = esc_attr($_POST['srm_crud']['message']);
				$review_id = Review::create((array) $review);
				if(!empty($_POST['srm_crud']['rating'])) {
					$ratingcategories = array_map( 'esc_attr', $_POST['srm_crud']['rating'] );
					Review::create_review_ratings($review_id, $review->container_id, $ratingcategories);
				}
			}
		  /* reviews with id */
		  } else if( !empty($_POST['srm_crud']['id']) && filter_var($_POST['srm_crud']['id'], FILTER_VALIDATE_INT) && $_POST['srm_crud']['action'] && $_POST['srm_crud']['container_id'] && filter_var($_POST['srm_crud']['container_id'], FILTER_VALIDATE_INT)) {
			if($_POST['srm_crud']['action'] == 'approve'){
			  Review::approve($_POST['srm_crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviews&container_id=".$_POST['srm_crud']['container_id']);
			  exit();
			}
			
			if($_POST['srm_crud']['action'] == 'delete'){
			  Review::delete($_POST['srm_crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviews&container_id=".$_POST['srm_crud']['container_id']);
			  exit();
			}
		  }
		} else if($_POST['srm_crud']['reviewcontainer'] && filter_var($_POST['srm_crud']['id'], FILTER_VALIDATE_INT)) {
			if($_POST['srm_crud']['action'] == 'delete'){
			  ReviewContainer::delete($_POST['srm_crud']['id']);
			  wp_redirect(admin_url()."admin.php?page=manage_reviewcontainers");
			  exit();
			}
		}
	}
?>
