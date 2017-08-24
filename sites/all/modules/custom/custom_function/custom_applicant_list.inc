<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function custom_job_applicant_list($node) {
    $nid = $node->nid;
    $type = $node->type;
    $uid = $node->uid;
    $form_id = 66;

    /*     * *************************** */
    $output = '';
    $output .= '<div class="table-responsive">';
    $header = array('Name', 'Your Company', 'Address', 'E-mail', 'Comments', 'Resume', 'Temp files');

    $query = db_select('webform_submitted_data', 'wsd')
	    ->extend('PagerDefault')
	    ->condition('nid', $form_id, '=')
	    ->condition('data', $nid, '=')
	    ->condition('cid', 8, '=')
	    ->fields('wsd', array('sid'))
	    ->limit(10);

    $result = $query->execute();


    $data = array();

    foreach ($result as $rows) {
	$dd = get_serial_data($rows->sid, 66);
	$data[] = array($dd['name']['value'], $dd['your_company']['value'], $dd['address']['value'], $dd['e_mail']['value'], $dd['comments']['value'], $dd['resume']['value'], $dd['temp_files']['value']);
    }
    $output .= theme('table', array('header' => $header, 'rows' => $data, 'caption' => '', 'sticky' => TRUE, 'empty' => 'No application received yet', 'id' => 'my-custom-id', 'class' => 'table', 'border' => 1));

    $output .= theme('pager');
    $output .= '</div>';

    return $output;

    /*     * ******************************** */
}

function get_serial_data($sid, $nid) {

    $label_array = array();
    $data = array();

    $result = db_query("SELECT DISTINCT wc.cid, wc.form_key, wc.name FROM {webform_component} wc WHERE wc.nid=:nid ORDER BY wc.weight ASC", array(':nid' => $nid));

    //  print_r($result);
    //  die();

    $i = 0;
    foreach ($result as $row) {
	$label_array[$row->cid] = array('form_key' => $row->form_key, 'name' => $row->name);
	$i++;
    }

    // print_r($label_array);
    //  die();

    $result = db_query("SELECT * FROM {webform_submitted_data} WHERE nid = :nid AND sid=:sid", array(':nid' => $nid, 'sid' => $sid));

    // print_r($result);
    // die();


    foreach ($result as $row) {


	if ($label_array[$row->cid]['form_key'] == 'temp_files' || $label_array[$row->cid]['form_key'] == 'resume') {

	    $file = file_load($row->data);
	    $uri = $file->uri;
	    $url = file_create_url($uri);

	    $data[$label_array[$row->cid]['form_key']] = array('name' => $label_array[$row->cid]['name'], 'value' => l('Download', $url, array('attributes' => array('target' => '_blank'))));
	} else {
	    $data[$label_array[$row->cid]['form_key']] = array('name' => $label_array[$row->cid]['name'], 'value' => $row->data);
	    // echo $row->data . '--';
	}
    }
    // echo '<br />*************** <br />';
    // print_r($data);
    // die();

    return $data;
}
