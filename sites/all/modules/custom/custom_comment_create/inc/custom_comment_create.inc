<?php

/* Drupal 7 basic node
* creation programatically
*/



function mycustom_comment_create(){

 $res = db_query("SELECT MAX(nid) FROM {node} WHERE type = :type", array(':type'=> 'page'))->fetchField();

 $comment = new stdClass();
 $comment->nid = $res;
 $comment->cid = 0;
 $comment->pid = 0;
 $comment->uid = 1;
 $comment->mail = 'a@a.com';
 $comment->name = 'My Name';
 $comment->thread = '01/';
 $comment->hostname = '127.0.01';
 $comment->created = time();
 $comment->is_anonymous = 0;
 $comment->homepage = '';
 $comment->status = COMMENT_PUBLISHED;
 $comment->language = LANGUAGE_NONE;
 $comment->subject = 'Comment Subject';
 $comment->comment_body[$comment->language][0]['value'] = 'comment body text';
 $comment->comment_body[$comment->language][0]['format'] = 'filtered_html';
 
// for comment form custom field

//$comment->field_custom_field_name[$comment->language][0]['value'] = ‘Some value’;

comment_submit($comment);
comment_save($comment); 


 return 'comment create page';

}
