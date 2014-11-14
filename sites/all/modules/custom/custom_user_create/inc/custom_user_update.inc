<?php

function mycustom_user_update(){

$res = db_query("SELECT value FROM {sequences}")->fetchField();

$suffix = $res;
$account  = user_load($suffix);

//$account  = new stdClass();
//$edit = array();

$account->name = 'update-'.$suffix;
$account->mail = $suffix.'update@x.com';
$account->status = 1;
// Adding new role to user

$role_name = 'editor';
$roles = user_roles(TRUE);
$rid = array_search($role_name, $roles);

/* Logic to remove role 

if ($rid != FALSE) {
      // Make a copy of the roles array, without the deleted one.
      $new_roles = array();
      foreach($account->roles as $id => $name) {
        if ($id != $rid) {
          $new_roles[$id] = $name;
        }
      }
}

*/

/* Logic to add role */

$key = array_search($role_name, $account->roles);
if($key == FALSE){
$addrole = array($rid => $role_name);
$new_roles = $account->roles + $addrole;

}

//print_r($roles);
//print_r($account->roles);
//print_r($new_roles);
$edit['roles'] = $new_roles;


// NOTE : you have to pass password in second arguments of user_save function
$edit['pass'] = 'update-'.$suffix;

// Inserting custom value field
//global $user;
//$language = ($user->language) ? $user->language : 'und';
$edit['field_first_name'] = array('und' => array(0 => array('value' => 'update first name-'.$suffix,),),);
$edit['field_last_name'] = array('und' => array(0 => array('value' => 'update last name-'.$suffix,),),);


$user_data = user_save($account, $edit);

if($user_data->uid){

return 'user having uid '.$user_data->uid.' data  has been updated';
}
else{
  return 'no user data  has been update';
}

}
