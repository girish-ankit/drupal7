<?php

function custom_auto_form(){
return drupal_get_form('giri_form');;
}

function giri_form(){
 $form = array();
 
  $form['node-title'] = array(
                               '#title' => t('Title'),
                               '#type' => 'textfield',
                               '#size' => 80,
                               '#maxlength' => 200,
                               '#required' => True,
                               '#description' => t('Enter node title'),
                               '#autocomplete_path' => 'custom-form/second/autocomplete'
                             );
 return $form;
}

function custom_auto_data($string = ''){

   $matches = array();
   
  
    $result = db_select('node', 'n')->fields('n', array('title'))->condition('title', db_like($last_string) . '%', 'LIKE')->range(0, 10)->execute();
    
    foreach ($result as $node) {
		
                 $matches[$node->title] = check_plain($node->title);
		  
  }
  
  
  
  //$matches['name'] = 'ankit';
  drupal_json_output($matches);
  exit();
}