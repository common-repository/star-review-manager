<?php
class ReviewContainer {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->title = '';
	$this->reviewlimit = 10;
	$this->anonymous = true;
	$this->mailnotification = '';
  }
  
  public function get_reviewcontainers(){
    global $wpdb;
    $container = $wpdb->get_results('SELECT * FROM '.SRM_DB_REVIEWCONTAINER);
	if(empty($container)) return '';
    return stripslashes_deep($container);
  }
  
  public function get_reviewcontainer($id){
    global $wpdb;
    $containers = $wpdb->get_results( $wpdb->prepare('SELECT * FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id=%d LIMIT 1', $id), ARRAY_A);
    if(empty($containers)) return '';
	if(is_array($containers)) {
		$container = $containers[0];
	}
	return stripslashes_deep($container);
  }
  
  public function get_ratingcategories($id){
    global $wpdb;
    $categories = $wpdb->get_results( $wpdb->prepare('SELECT ratingcategory FROM '.SRM_DB_CONTAINERRATING.' WHERE container_id=%d ORDER BY ratingpos', $id), ARRAY_A);
    if(empty($categories)) return '';
	return stripslashes_deep($categories);
  }

  public function update($container){
    global $wpdb;
    $wpdb->update(SRM_DB_REVIEWCONTAINER, $container, array('id'=>$menu['id'])); 
  }

  public function create($container){
    global $wpdb;
    $wpdb->insert(SRM_DB_REVIEWCONTAINER, $container); 
    return $wpdb->insert_id;
  }
  
  public function get_size($container_id, $status = 1) {
	 global $wpdb;
	 return $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) AS count FROM ".SRM_DB_REVIEWS." WHERE container_id=%d AND status=%d", $container_id, $status)); 
  }
  
  /* create different container ratings, mostly used for this instance */
  public function create_rating_categories($container_id, $categories) {
	global $wpdb;
	$pos = 0;
	foreach($categories as $category) {
		$containerrating = array(
			"container_id" => $container_id,
			"ratingcategory" => $category,
			"ratingpos" => $pos
		);
		$wpdb->insert(SRM_DB_CONTAINERRATING, $containerrating); 
		$pos ++;
	}
  }
  
  /* delete reviewcontainer and related reviews */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_CONTAINERRATING.' WHERE container_id=%d', $id)); 
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_RATING.' WHERE container_id=%d', $id)); 
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_REVIEWS.' WHERE container_id=%d', $id)); 
	$wpdb->query( $wpdb->prepare('DELETE FROM '.SRM_DB_REVIEWCONTAINER.' WHERE id=%d', $id)); 
  }
}
?>
