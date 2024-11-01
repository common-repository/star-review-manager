<?php
class User {

  public function __construct($id = 'NO_ID') { 
    $this->id = '';
	$this->email = '';
	$this->username = '';
	$this->firstname = '';
	$this->lastname = '';
  }
  
  public function get_users(){
    global $wpdb;
    $users = $wpdb->get_results('SELECT * FROM '.SRM_DB_USERS);
    return stripslashes_deep($users);
  }

  public function get_user($id){
    global $wpdb;
    $user = $wpdb->get_results('SELECT * FROM '.SRM_DB_USERS.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
	return stripslashes_deep($user[0]);
  }

  public function update($user){
    global $wpdb;
    $wpdb->update(SRM_DB_USERS, $user); 
  }

  public function create($user){
    global $wpdb;
    $wpdb->insert(SRM_DB_USERS, $user); 
    return $wpdb->insert_id;
  }

  /* delete user by id */
  public function delete($id){
    global $wpdb;
    if(empty($id)) return '';
	$wpdb->query("DELETE FROM ".SRM_DB_USERS." WHERE id=".$id); 
  }
}
?>
