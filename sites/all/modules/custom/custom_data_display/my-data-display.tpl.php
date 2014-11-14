<?php
  
  echo '<h2 align="center">'.$developer.'</h2>';

 

  $header = array('Title', 'View', 'Edit', 'Delete', 'Created');

  $data = array();
	
	foreach($nodeData as $rows){
		$path   = 'node/'.$rows['nid'];
		$edit   = 'node/'.$rows['nid'].'/edit';
		$delete = 'node/'.$rows['nid'].'/delete';
		$data[] = array($rows['title'], l('view', $path), l('Edit', $edit), l('Delete', $delete), date("d/m/Y", $rows['created']));
		
             }

    $output = theme('table', array('header' => $header, 'rows' => $data, 'caption' => 'Creating Drupal 7 style tables', 'sticky' => TRUE, 'empty' => 'No nodes created...', 'id'=>'my-custom-id', 'class'=>'my-custom-class', 'border'=>3));
    
    


	print $output;

?>




