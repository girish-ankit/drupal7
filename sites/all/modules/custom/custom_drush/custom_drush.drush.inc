<?php
/*
 * Implementation of hook_drush_command();
 */

function custom_drush_drush_command() {
    $items = array();

    $items['drush-demo-command'] = array(
        'description' => 'Demonstrate how Drush commands work.',
        'aliases' => array('ddc'),
        'callback' => 'drush_demo_command',
        'arguments' => array(
            'type' => 'The type of statement (error or success).',
        ),
        'options' => array(
            'repeat' => 'The number of statement repeats.',
        ),
    );


    $items['node-count'] = array(
        'callback' => 'custom_title_node_count', // Callback function
        'description' => 'Drush command to get node count of particular node type.',
        'aliases' => array('nc'), // alias of command
        'examples' => array(// List these example when user types : drush help nc
            'Get all nodes count' => 'drush nc',
            'Get articles node count' => 'drush nc article',
            'Get articles, pages node count' => 'drush nc article page',
        ),
    );

    return $items;
}

function drush_demo_command($type = FALSE) {

    // Check for correct argument
    $correct_args = array('error', 'success');
    if (!in_array($type, $correct_args)) {
        return drush_set_error(dt('"@type" is not a valid statement type. Please choose between "success" and "error".', array('@type' => $type)));
    }

    // Option
    $repeat = drush_get_option('repeat', 1);
    if ($repeat > 1 && is_numeric($repeat)) {
        for ($i = 0; $i < $repeat; $i++) {
            demo_drush_print_statement($type);
        }
    } else {
        demo_drush_print_statement($type);
    }
}

/**
 * 
 * @param type $type
 */
function demo_drush_print_statement($type = NULL) {
    drupal_set_message(t('Hello world!'), $type);
}

/*
 * Callback function for hook_drush_command().
 */

function custom_title_node_count() {
    // Get arguments passed in command, Ex: drush nc page blog
    $args = func_get_args();
    if ($args) {
        // Loop for types
        foreach ($args as $type) {
            // Query to get count of particular type
            $result = db_select('node', 'n')
                    ->fields('n', array('nid'))
                    ->condition('type', $type, '=')
                    ->execute();
            $num_of_results = $result->rowCount();
            drush_print($type . "'s node count : " . $num_of_results);
        }
    }
    // If no type passed then return total count
    else {
        drush_print('No node types mentioned');

        $result = db_select('node', 'n')
                ->fields('n', array('nid'))
                ->execute();
        $num_of_results = $result->rowCount();

        drush_print('Count of all nodes : ' . $num_of_results);
    }
}
