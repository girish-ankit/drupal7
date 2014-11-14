<?php

/**
 * Form Creations
 */
function custom_form() {
    $form = array();
    $form['custom-textfield'] = array(
        '#title' => t('Name'),
        '#type' => 'textfield',
        '#description' => t('Enter your name'),
        '#default_value' => 'Name',
        //'#required' => TRUE,
        '#size' => 30,
        '#maxlength' => 30,
    );



// DATE TYPE FORM API DEMO STARTS

    $date = date('Y-m-d H:i:s', time());
    $format = 'Y-m-d H:i';
    $form['date1'] = array(
        '#type' => 'date_select', // types 'date_text' and 'date_timezone' are also supported. See .inc file.
        '#title' => t('select a date'),
        '#default_value' => $date,
        '#date_format' => $format,
        '#date_label_position' => 'within', // See other available attributes and what they do in date_api_elements.inc
        '#date_timezone' => date_default_timezone(), // Optional, if your date has a timezone other than the site timezone.
        '#date_increment' => 15, // Optional, used by the date_select and date_popup elements to increment minutes and seconds.
        '#date_year_range' => '-3:+3', // Optional, used to set the year range (back 3 years and forward 3 years is the default).
    );

    $form['date2'] = array(
        '#type' => 'date_text', // types 'date_text' and 'date_timezone' are also supported. See .inc file.
        '#title' => t('Date text field'),
        '#default_value' => $date,
        '#date_format' => $format,
        '#date_label_position' => 'within', // See other available attributes and what they do in date_api_elements.inc
        '#date_timezone' => date_default_timezone(), // Optional, if your date has a timezone other than the site timezone.
        '#date_increment' => 15, // Optional, used by the date_select and date_popup elements to increment minutes and seconds.
        '#date_year_range' => '-3:+3', // Optional, used to set the year range (back 3 years and forward 3 years is the default).
    );

    $form['date3'] = array(
        '#type' => 'date_timezone', // types 'date_text' and 'date_timezone' are also supported. See .inc file.
        '#title' => t('select time zone'),
        '#default_value' => 'America/Chicago',
        '#date_label_position' => 'within',
    );

    $date = date('Y-m-d', time());
    $format = 'Y-m-d';
    $form['date4'] = array(
        '#type' => 'date_popup', // types 'date_text' and 'date_timezone' are also supported. See .inc file.
        '#title' => t('Date popup'),
        '#default_value' => $date,
        '#date_format' => $format,
        '#date_label_position' => 'within', // See other available attributes and what they do in date_api_elements.inc
        '#date_timezone' => date_default_timezone(), // Optional, if your date has a timezone other than the site timezone.
        '#date_increment' => 15, // Optional, used by the date_select and date_popup elements to increment minutes and seconds.
        '#date_year_range' => '-3:+3', // Optional, used to set the year range (back 3 years and forward 3 years is the default).
    );

// DATE TYPE FORM API DEMO ENDS
// ATTACHING CSS AND JS FILES TO FORM	

    $path = drupal_get_path('module', 'custom_form');

// $form['#attached'] = array('css' => array('type' =>'file', 'path'=> $path.'/css/custom_form.css' ), 'js' => array('type' => 'file', 'path' => $path.'/js/custom_form.js' ) );

    $form['#theme'] = 'custom_form_theme';
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );


    return $form;
}

/**
 * Form Validation
 */
function custom_form_validate($form, &$form_state) {

    if ($form_state['values']['custom-textfield'] == 'Name') {
        form_set_error('custom-testfield', t('Please change Name field value'));
    }

    if ($form_state['values']['custom-textfield'] == '') {
        form_set_error('custom-textfield', t('Test field can\'t be balnk'));
    }
}

/**
 * Form Submit 
 * *
 */
function custom_form_submit($form, &$form_state) {
    $name = $form_state['values']['custom-textfield'];

    drupal_set_message(t('Thanks for filling out the form, %name', array('%name' => $name)));
}

