<?php

 function first_menu_tab_second_tab2(){
 return render(drupal_get_form('my_form'));
 }
 
 
function my_form($form, $form_state) {

  $query = db_select('node', 'n')
           ->extend('pagerDefault')
           ->condition('type', 'article')
           ->fields('n', array('nid', 'title', 'created'))
           ->limit(10);
           
   $result = $query->execute();
   
   $options = array();
   
  foreach ($result as $row) {
    $options[$row->nid] =array(
      'field_title' => $row->title,
      'field_created' => date("d/m/Y", $row->created),
    );
  }
  
  //$options .= theme('pager');
  
  

  $header = array(
    'field_title' => t('Title'),
    'field_created' => t('Created'),
  );
  
  $form['table'] = array(
    '#type' => 'tableselect',
    '#header' => $header,
    '#options' => $options,
    '#empty' => t('No node found'),
  );
  $form['pager'] = array(
                          '#markup' => theme('pager')
                         );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );
  return $form;
}