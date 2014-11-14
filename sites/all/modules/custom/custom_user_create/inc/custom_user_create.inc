<?php

function mycustom_user_create(){


 $res = db_query("SELECT value FROM {sequences}")->fetchField();

$suffix = $res +1;

$account  = new stdClass();
$edit = array();

$account->name = 'user-'.$suffix;
$account->mail = $suffix.'x@x.com';
$account->init = $suffix.'x@x.com';
$account->status = 1;
// 2 and 5  are role id's
$roles = array(2 => true, 5 => true);
$account->roles = $roles;


// NOTE : you have to pass password in second arguments of user_save function
$edit['pass'] = 'user-'.$suffix;

// Inserting custom value field
//global $user;
//$language = ($user->language) ? $user->language : 'und';
$edit['field_first_name'] = array('und' => array(0 => array('value' => 'first name-'.$suffix,),),);
$edit['field_last_name'] = array('und' => array(0 => array('value' => 'last name-'.$suffix,),),);


$user_data = user_save($account, $edit);

if($user_data->uid){

return 'user having uid '.$user_data->uid.'  has been created';
}
else{
  return 'no user have been created';
}

}
