<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


 $output = '';
 $tid_arr = array(8, 10, 11, 12);
 $tid_arr_replace = array(13, 14);
    $sql = "SELECT DISTINCT entity_id AS nid FROM field_data_field_muti_category WHERE field_muti_category_tid IN (8, 10, 11, 12) AND entity_type = 'node' AND bundle ='page'";

 $result = db_query($sql);   
 foreach($result as $row){
		
		
                $nd = node_load($row->nid);
                $field = $nd ->field_muti_category;
                $langArr = array_keys($field);
                $fieldLang = $langArr[0];
                $fieldLangValues = $field[$fieldLang];
                foreach($fieldLangValues AS $key => $value){
                    
                        if (in_array(11, $value))
                      {
                             $arrCount = count($fieldLangValues);
                             
                             foreach($tid_arr_replace AS $value){
                                   $sql = "SELECT entity_id FROM field_data_field_muti_category WHERE field_muti_category_tid = $value  AND entity_id = $nd->nid AND entity_type = 'node' AND bundle ='page'";
                                   
                                 
                                   $nbr_records = db_query($sql)->fetchField();
                                   
                                  if(!$nbr_records){
                                     $nd ->field_muti_category[$fieldLang][$arrCount]['tid'] = $value; 
                                     $arrCount++;
                                 
                                  }
                                
                             }
                            
                             
                             node_save($nd);
                         $output .= $row->nid ."---";
                      }
                }
	}
	
	
	print $output;

