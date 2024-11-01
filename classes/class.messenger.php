<?php
class Messenger {

  public function __construct() { }
  
  public function sendSubmitMessage($review_id, $container_id){
	global $wpdb;
	$receiver = $wpdb->get_results('SELECT mailnotification FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id='.$container_id);
    $review = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWS.' WHERE id='.$review_id);
	stripslashes_deep($receiver);
	stripslashes_deep($review);
	if(!empty($receiver) && !empty($review)) {
		$send_review = $review[0];
		$send_receiver = $receiver[0];
		$subject = __('Review submitted', 'star-review-manager');
		$message = __('The following review has just been submitted to your website: '. $send_review->message, 'star-review-manager');
		$headers = array(
		'Reply-To' => '<'.$send_receiver.'>'
		);
		$status = wp_mail($send_receiver->mailnotification, $subject, $message, $headers);
	}
  }
  
  public function get_reviews_by_container($container_id, $status = 1) {
	global $wpdb;
    $reviews = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWS.' WHERE container_id = '.$container_id.' AND status='.$status);
    return stripslashes_deep($reviews);
  }

  public function update($review){
    global $wpdb;
    $wpdb->update(SRM_DB_REVIEWS, $review); 
  }

  public function create($review){
    global $wpdb;
    $wpdb->insert(SRM_DB_REVIEWS, $review); 
    return $wpdb->insert_id;
  }

  /* delete review by id */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query("DELETE FROM ".SRM_DB_REVIEWS." WHERE id=".$id); 
  }
  
  public function approve($id) {
	global $wpdb;
	if(empty($id)) return '';
	$wpdb->query("UPDATE ".SRM_DB_REVIEWS." SET status=1 WHERE id=".$id);
  }
}
?>
