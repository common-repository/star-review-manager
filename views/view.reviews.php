<?php		
	function get_rating($amount) {
		$output = '';
		for($i = 0; $i <= $amount; $i++) {
			$output .= '<span></span>'; 
		}
		return $output;
	}
	
	/* output for reviews. */
	function get_reviews_html($atts) {
		global $wpdb;
		$container_id = $atts['id'];
		$option_type = 'bullets';
		if(empty($atts['id']) || !is_numeric($atts['id']) ) return '';
		if(!empty($atts['option_type'])) $option_type = $atts['option_type']; //set optiontype if specified. 
		$review_container = ReviewContainer::get_reviewcontainer($container_id);
		$amount_reviews = ReviewContainer::get_size($container_id);
		
		//if there is a page limit >
		if($review_container['reviewlimit'] && $review_container['reviewlimit'] != 0) {
			$limit = $review_container['reviewlimit'];
			$pages = ceil($amount_reviews / $limit);
			
			$page = 1; //default
			$page = min($pages, filter_input(INPUT_GET, 'srm-page', FILTER_VALIDATE_INT, array(
					'options' => array(
						'default'   => 1,
						'min_range' => 1,
					),
			)));

			$offset = ($page - 1)  * $limit;
			//get reviews with limit and offset.
			$reviews = Review::get_reviews_by_container($container_id, 1, $limit, $offset);
			
			//information to show the user.
			$start = $offset + 1;
			$end = min(($offset + $limit), $amount_reviews);
			
		} else {
			$reviews = Review::get_reviews_by_container($container_id);
		}
		
		//-------------------------------------
		//-------------------------------------
		$output = '<!-- '.__("automatically generated review output", "star-review-manager").' -->';
		foreach($reviews as $review) {
			$output .= '<div class="srm-review">';
			$output .= '<div class="srm-grouping">';
			$output .= '<div>'.$review->message.'</div>';
			$output .= '</div>';
			$output .= '<div class="srm-grouping">';
			$reviewratings = Review::get_review_ratings($review->id);
			if($reviewratings && !empty($reviewratings)) {
				$output .= '<div class="srm-ratingcontainer">';
				foreach($reviewratings as $rating) {
					$output .= '<div class="srm-categoryrating-grouping">';
					$output .= '<small class="srm-category">'. $rating['ratingcategory'] .'</small>'; 
					$output .= '<div class="srm-rating srm-'. $option_type .'-rating">' . get_rating($rating['ratingvalue']) . '</div>';
					$output .= '</div>';
				}
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '<div class="srm-grouping">';
			if($review->user_id != NULL && User::get_user($review->user_id)) {
				$user = User::get_user($review->user_id);
				if($user) { 
					$output .= '<span><i>'.__("created by ", "star-review-manager"). $user['firstname'] . ' ' . $user['lastname'].'</i></span>';
				}
			} else {
				$output .= '<span><i>'.__("created by Anonymous", "star-review-manager").'</i></span>';
			}
			$output .= '<span><i> '.__(" at ", "star-review-manager"). gmdate("d M Y H:i", strtotime($review->created)) .'</i></span>';
			$output .= '</div>';
			$output .= '</div>';
		}
		// Display the paging information
		if($pages > 1) {
			$output .= '<div class="srm-pagination">';
			$output .= ($page > 1) ? '<a href="?srm-page=1" class="page-indicator">'. __('first', 'star-review-manager') .'</a>' : '<span class="page-indicator disabled">'. __('first', 'star-review-manager') .'</span>';
			for($i = 1; $i <= $pages; $i++) {
				$output .= '<a href="?srm-page=' . $i . '" class="page-indicator' . ($page == $i ? ' active' : '') . '">' . $i . '</a>';
			}
			$output .= ($page < $pages) ? '<a href="?srm-page=' . $pages . '" class="page-indicator">'. __('last', 'star-review-manager') .'</a>' : '<span class="page-indicator disabled">'. __('last', 'star-review-manager') .'</span>';
			$output .= '</div>';
		}
		return $output;
	}

?>
