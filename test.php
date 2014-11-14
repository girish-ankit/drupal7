<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

function getChild($vid, $pid){

 $sql = "SELECT td.tid, td.name, td.vid FROM {taxonomy_term_data} AS td JOIN {taxonomy_term_hierarchy} AS th ON td.tid=th.tid WHERE td.vid=:vid AND th.parent=:pid ORDER BY td.weight, td.name";
 $res = db_query($sql, array(':vid' => $vid, ':pid'=> $pid));

 $output = '';
 $output .= '<ul>';

 foreach($res AS $row){

   
   $nbr_records = db_query("SELECT COUNT(tid) FROM {taxonomy_term_hierarchy} WHERE parent = :parent", array(':parent' => $row->tid))->fetchField();
  // $output .= '<li>'.$row->name.'-- '.$nbr_records.'</li>';
   $output .= '<li>'.$row->name; 
 if($nbr_records){
   $output .= getChild($vid, $row->tid);
 }
  $output .= '</li>'; 
 }
 $output .= '</ul>';
 return $output;
}

$vid = 3; $pid = 0;
print getChild($vid, $pid);
