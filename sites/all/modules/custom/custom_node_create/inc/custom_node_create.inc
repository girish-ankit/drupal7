<?php

/* Drupal 7 basic node
* creation programatically
*/



function mycustom_node_create(){

 $body_text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pellentesque ultricies vulputate. Aenean id tincidunt est. Suspendisse condimentum purus nec mauris pellentesque sed blandit magna lacinia. Nullam sed augue quis eros dignissim rutrum. Ut in tellus enim. Duis dignissim pharetra enim ut lobortis. Donec bibendum bibendum turpis, eu fringilla nibh condimentum non. Morbi non rutrum quam. Nam quam nisl, accumsan quis malesuada eget, semper eget magna. Proin vehicula dolor at tellus laoreet feugiat. Quisque aliquet consectetur euismod. Vestibulum et mi id lacus lacinia ultrices sed sed nunc. Ut vulputate lectus quis nisl pulvinar euismod.

In a tortor magna, sit amet vulputate risus. Aenean consequat dui ut est fermentum eget sodales mi fermentum. Maecenas dapibus varius ultricies. Maecenas fermentum aliquam pretium. Maecenas eget arcu a ante ornare vulputate. Quisque rhoncus egestas tortor id fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris et odio libero. Phasellus vestibulum consectetur enim ut lobortis. Maecenas ipsum tortor, pretium non rutrum eget, porttitor vel erat. Nullam eros nisi, pretium ornare molestie sed, fermentum lacinia arcu. Fusce rutrum diam non mauris pretium fringilla.
Aliquam erat volutpat. Aliquam euismod elit vel dui auctor vel placerat quam dictum. Nulla suscipit vestibulum purus porta facilisis. Curabitur tempus arcu id nibh suscipit tincidunt. Aliquam egestas feugiat ultrices. Fusce et euismod quam. Morbi ullamcorper, purus at egestas aliquet, lacus felis porta magna, at accumsan justo massa ac sapien. Maecenas nunc tortor, mattis sit amet fermentum sed, rhoncus eu lorem. Fusce sit amet mollis enim. Ut et purus nec dui mollis tincidunt in laoreet turpis. Nulla tincidunt interdum ipsum at scelerisque.";

 $node = new stdClass();
 $node->type = 'page';
 node_object_prepare($node);

// Title field
 $node->title = "Node created programatically on ".date('c');
 $node->language = LANGUAGE_NONE;

// Body field
 $node->body[$node->language][0]['value'] = $body_text;
 $node->body[$node->language][0]['summary'] = text_summary( $body_text);
 $node->body[$node->language][0]['format'] = 'full_html';


// Custom field settings

$node->field_description[$node->language][0]['value'] = 'This is dummy data for description field';
$node->field_description[$node->language][0]['format'] = 'full_html';

$node->field_location[$node->language][0]['value'] = 'Location';

$node->field_game[$node->language][0]['value'] = 'Game 1';
$node->field_game[$node->language][1]['value'] = 'Game 2';
$node->field_game[$node->language][2]['value'] = 'Game 3';

// adding image field data

 $d = file_exists("caps/help.png");
// $d = file_exists("misc/druplicon.png");

if($d){
 drupal_set_message("File exists");
}
else{
drupal_set_message("File does not exist");

}
// Some file on our system
//$external_path = 'http://blogs.artinfo.com/russianews/files/2013/08/mospremiere-300x178.jpg';
$external_path = 'http://blogs.artinfo.com/modernartnotes/wp-content/themes/artinfo-modernartnotes-new/images/header-img.jpg';
//$external_path = 'http://blogs.artinfo.com/blunotes/wp-content/themes/artinfo-blunotes/images/header-img.jpg';
$image = file_get_contents($external_path);
if($image){

}else{
echo 'no'; die();
}

$extfile = file_save_data($image, 'public://' . $filename, FILE_EXISTS_RENAME);



//print_r($extfile); die();

/*$file_path = drupal_realpath($image);
//$file_path = drupal_realpath('caps/caps4.jpg'); 
 // Create a File object
$file = (object) array(
  'uid' => 1,
  'uri' => $file_path,
  'filemime' => file_get_mimetype($file_path),
  'status' => 1,
); 
$file = file_copy($file, 'public://'); // Save the file to the root of the files directory. You can specify a subdirectory, for example, 'public://images' 
*/
$node->field_upload_image[$node->language][0] = (array)$extfile; //associate the file object with the image field:


// Adding taxonomy term

$node->field_category[$node->language][0]['tid'] = 1;
$node->field_category[$node->language][1]['tid'] = 2;





// Node url settings
 $path = 'content/programatically-node-created-'.date('YmdHis');
 $node->path = array('alias'=> $path);

  node_save($node);


  return 'Node having id '.$node->nid.' has been Created ';
}