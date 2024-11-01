<?php
	/* output for reviewform. */
	function get_reviewform_html($atts) {
		$container_id = $atts['container_id'];
		if(empty($atts['container_id']) || !is_numeric($atts['container_id']) ) return '';
		$ratingcategories = ReviewContainer::get_ratingcategories($container_id);
		$output = '<!-- '.__('generated review form', 'star-review-manager').' -->';
		
		$output .= '<script type="text/javascript">';
		$output .= 'function showFeedback() {';
		$output .= 'var feedback = document.getElementById("feedback");';
		$output .= 'if (feedback.style.display == "none") { feedback.style.display = ""; } };';
		$output .= 'jQuery(function() {';
		$output .= 'jQuery("#srm-form").submit(function(e) {';
		$output .= 'var postData = jQuery(this).serialize();';
		$output .= 'var formURL = jQuery(this).attr("action");';
		$output .= 'var formMethod = jQuery(this).attr("method");';
		$output .= 'jQuery.ajax({';
		$output .= 'url: formURL,';
		$output .= 'type: formMethod,';
		$output .= 'dataType: "text",';
		$output .= 'data: postData,';
        $output .= 'success:function(data, textStatus, jqXHR) {';
		$output .= 'var feedback = document.getElementById("feedback");';
		$output .= 'if (feedback.style.display == "none") { feedback.style.display = ""; }';
		$output .= 'jQuery("#srm-form").fadeOut(400);';
		$output .= 'jQuery(":input","#srm-form").not(":button, :submit, :reset, :hidden").val("").removeAttr("checked").removeAttr("selected");';
        $output .= '},';
        $output .= 'error: function(jqXHR, textStatus, errorThrown){';
        $output .= '}';
		$output .= '});';
		$output .= 'e.preventDefault(); });});';
		$output .= '</script>';
		
		$output .= '<div id="feedback" style="display: none;"><span><b>'.__("Thank you for sending in your review. 
		When your review has been approved, it will be made visible", "star-review-manager").'</b></span></div>';
		$output .= '<form class="srm-form" id="srm-form" method="post" action="">';
		$output .= '<div class="srm-form-group">';
		$output .= '<label><span>'.__("Firstname", "star-review-manager").'</span>';
		$output .= '<input name="srm_crud[firstname]" type="text" />';
		$output .= '</label>';
		$output .= '<label><span>'.__("Lastname", "star-review-manager").'</span>';
		$output .= '<input name="srm_crud[lastname]" type="text" />';
		$output .= '</label>';
		$output .= '</div>';
		
		$output .= '<div class="srm-form-group">';
		$output .= '<label><span>'.__("Message", "star-review-manager").'</span>';
		$output .= '<textarea required name="srm_crud[message]"></textarea>';
		$output .= '</label>';
		$output .= '</div>';
		
		$output .= '<div class="srm-form-group">';
		$output .= '<label><span>'.__("Rating", "star-review-manager").'</span></label>';
		foreach($ratingcategories as $ratingcategory) {
			$output .= '<small>'. $ratingcategory['ratingcategory'] .'</small>'; 
			$output .= '<div class="star-rating">';
				$output .= '<input type="radio" name="srm_crud[rating]['. $ratingcategory['ratingcategory'] .']" value="1"><i></i>';
				$output .= '<input type="radio" name="srm_crud[rating]['. $ratingcategory['ratingcategory'] . ']" value="2"><i></i>';
				$output .= '<input type="radio" name="srm_crud[rating]['. $ratingcategory['ratingcategory'] . ']" value="3"><i></i>';
				$output .= '<input type="radio" name="srm_crud[rating]['. $ratingcategory['ratingcategory'] . ']" value="4"><i></i>';
				$output .= '<input type="radio" name="srm_crud[rating]['. $ratingcategory['ratingcategory'] . ']" value="5"><i></i>';
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '<input type="hidden" name="srm_crud[container_id]" value="'.$container_id.'" />';
		$output .= '<input type="hidden" name="srm_crud[action]" value="create" />';
		$output .= '<input type="hidden" name="srm_crud[review]" value="'.__("Add review", "star-review-manager").'" /><!-- remove this one if you are not using ajax -->';
		$output .= '<div></div>';
		$output .= '<input class="button" type="submit" name="srm_crud[review]" value="'.__("Add review", "star-review-manager").'" />';
		$output .= '</form>';
		return $output;
	}
?>
