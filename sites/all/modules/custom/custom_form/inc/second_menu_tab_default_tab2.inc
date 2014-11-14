<?php

function second_menu_tab_default_tab2(){
return drupal_get_form('anky_form');;
}

function anky_form(){
 $form = array();
 
  $form['node-title'] = array(
                               '#title' => t('Title'),
                               '#type' => 'textfield',
                               '#size' => 80,
                               '#maxlength' => 200,
                               '#required' => True,
                               '#description' => t('Enter node title'),
                               '#autocomplete_path' => 'custom-form/second/tab/autocomplete'
                             );
 return $form;
}

function second_menu_tab_default_tab_autocomplete($string = ''){

  $array = drupal_explode_tags($string);
   $last_string = trim(array_pop($array));
   $matches = array();
   
  if ($last_string!='') {
  
    $result = db_select('node', 'n')->fields('n', array('title'))->condition('title', db_like($last_string) . '%', 'LIKE')->range(0, 10)->execute();
    $prefix = count($array) ? implode(', ', $array) .', ' : '';
    
    foreach ($result as $node) {
		
		if(!in_array($node->title, $array))
		{
		  $n = $node->title.',';
                 $matches[$prefix . $n] = check_plain($node->title);
		  
		}	
    }
  }
  
  
  
  //$matches['name'] = 'ankit';
  drupal_json_output($matches);
  exit();
}