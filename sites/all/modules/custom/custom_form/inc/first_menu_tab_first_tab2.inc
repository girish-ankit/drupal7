<?php

function first_menu_tab_first_tab2() {
    $output = '';
    $output .= '<p><b>This page show all form element of drupal</b></p>';
    $output .= render(drupal_get_form('custom_form_element_demo'));
    return $output;
}

function custom_form_element_demo() {
    $form = array();
    $form['custom-textfield'] = array(
        '#title' => t('Name'),
        '#type' => 'textfield',
        '#description' => t('Enter your name'),
        '#default_value' => 'Name',
        '#required' => TRUE,
        '#size' => 30,
        '#maxlength' => 30,
        '#weight' => 1,
    );
    $form['custom-checkbox'] = array(
        '#type' => 'checkbox',
        '#title' => t('Single checkbox'),
        '#default_value' => 1,
        '#description' => t('Demo single checkbox'),
        '#weight' => 2,
    );

    $form['custom-checkboxes'] = array(
        '#title' => t('Select your choice'),
        '#type' => 'checkboxes',
        '#options' => array('1' => t('ankit'), '2' => t('kumar'), '3' => t('Thakur')),
        '#default_value' => array('1', '2'),
        '#description' => t('Demo of checkboxes'),
        '#weight' => 3,
    );

    $active = array(0 => t('Closed'), 1 => t('Active'));

    $form['custom-checkbox'] = array(
        '#title' => t('What is you status ?'),
        '#type' => 'radios',
        '#options' => $active,
        '#default_value' => 0,
        '#description' => t('Demo radio buttons'),
        '#weight' => 4,
    );

    $form['custom-selectbox'] = array(
        '#title' => t('Select'),
        '#type' => 'select',
        '#options' => array('one', 'two', 'three', 'four'),
        '#weight' => 5,
        '#default_value' => '2',
        '#description' => t('Demo of single select'),
    );

    $form['custom-selectbox-multiple'] = array(
        '#title' => t('Select Multiple'),
        '#type' => 'select',
        '#options' => range(0, 100, 10),
        '#size' => 2,
        '#weight' => 6,
        '#multiple' => TRUE,
        '#default_value' => array('0', '1', '2'),
        '#description' => t('Demo multiple select'),
    );
    $form['custom-pass'] = array(
        '#title' => t('Password'),
        '#type' => 'password',
        '#maxlength' => 64,
        '#size' => 15,
        '#weight' => 7,
    );

    $form['custom-confirm-pass'] = array(
        '#title' => t('Please Enter you password'),
        '#type' => 'password_confirm',
        '#maxlength' => 64,
        '#size' => 25,
        '#weight' => 8,
    );

    $form['custom-date'] = array(
        '#title' => t('Enter Date'),
        '#type' => 'date',
        '#default_value' => array('year' => 2007, 'month' => 2, 'day' => 15),
        '#weight' => 9,
    );

    $form['custom-upload'] = array(
        '#title' => t('Upload Files'),
        '#type' => 'file',
        '#weight' => 10,
    );

    $form['custom-textarea'] = array(
        '#title' => t('Description'),
        '#type' => 'textarea',
        '#weight' => 11,
        '#default_value' => 'Please Enter your thoughts',
        '#cols' => 10,
        '#rows' => 3,
        '#resizable' => FALSE,
    );


    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
        '#weight' => 12,
    );


    return $form;
}