<?php
class Review {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->container_id = '';
	$this->user_id = NULL;
	$this->message = '';
	$this->rating = 0;
	//$this->created = '';
	$this->status = 0;
  }
  
  public function get_reviews(){
    global $wpdb;
    $reviews = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWS);
    return stripslashes_deep($reviews);
  }
  
  /* retrieves the reviews from the database */
  public function get_reviews_by_container($container_id, $status = 1, $limit = 0, $offset = 0) {
	global $wpdb;
	$query = 'SELECT * FROM '.SRM_DB_REVIEWS.' WHERE container_id = %d AND status=%d ORDER BY created DESC';
	if($limit != 0) {
		$query .= ' LIMIT %d'; 
	}
	if($offset != 0) {
		$query .= ' OFFSET %d'; 
	}
    $reviews = $wpdb->get_results($wpdb->prepare($query, $container_id, $status, $limit, $offset));
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

  public function create_review_ratings($review_id, $container_id, $ratings) {
	global $wpdb;
	$pos = 0;
	foreach($ratings as $key => $rating) {
		$ratingcategory = array(
			"container_id" => $container_id,
			"review_id" => $review_id,
			"ratingcategory" => $key,
			"ratingvalue" => $rating,
			"ratingpos" => $pos
		);
		$wpdb->insert(SRM_DB_RATING, $ratingcategory); 
		$pos ++;
	} 
  }
  
  public function get_review_ratings($review_id) {
	global $wpdb;
    $categories = $wpdb->get_results( $wpdb->prepare('SELECT ratingcategory, ratingvalue FROM '.SRM_DB_RATING.' WHERE review_id=%d ORDER BY ratingpos', $review_id), ARRAY_A);
    if(empty($categories)) return '';
	return stripslashes_deep($categories);
  }
  
  /* delete review by id */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_RATING.' WHERE review_id=%d', $id) ); 
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_REVIEWS.' WHERE id=%d', $id) ); 
  }
  
  public function approve($id) {
	global $wpdb;
	if(empty($id)) return '';
	$wpdb->query( $wpdb->prepare("UPDATE ".SRM_DB_REVIEWS." SET status=1 WHERE id=%d", $id) );
  }
}
?>
