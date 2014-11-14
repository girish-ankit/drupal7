<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
//echo "************** <br />";
////session_start();
//$_SESSION['name'] = 'Ankit kumar';
//$_SESSION['age'] = 30.5;
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
////session_destroy();
//echo "************** <br />";
//echo '<br/>'.date("d/m/Y h:i:s", time()).'<br/>';
//$result = db_query("SELECT * FROM {sessions}");
//$i =1;
//foreach($result as $row){
//echo $i.'<br/>'.date("d/m/Y h:i:s", $row->timestamp).'----'.$row->session.'<br/>';
//$i++;
//}
//global $user;
//echo "<pre>";
//print_r($user);
//echo "</pre>";
//echo session_name();
//echo '<br />'.session_id();
menu_execute_active_handler();

