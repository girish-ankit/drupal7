<?php

function mycustom_comment_update(){

 $res = db_query("SELECT MAX(nid) FROM {node} WHERE type = :type", array(':type'=> 'page'))->fetchField();
 $cid = db_query("SELECT MAX(cid) FROM {comment} WHERE nid = :nid", array(':nid'=> $res))->fetchField();

 $comment = comment_load($cid, $reset = FALSE);

 $comment->created = time();
 $comment->subject = 'Comment Subject update';
 $comment->comment_body[$comment->language][0]['value'] = 'comment body text update';
 $comment->is_anonymous = 0;

 comment_submit($comment);
 comment_save($comment);
 return 'comment update page';
}
