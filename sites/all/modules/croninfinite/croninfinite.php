<?php
/**
 * @file
 * Croninfinite | croning cron without cron.
 *
 * This is the 'infinite' running croninfinite script
 * that triggers a planned execution of drupals cron.
 *
 * NOTE: This file will not be included by drupal.
 *       We don't want to annoy the server with
 *       Drupal's bootstrap over and over again.
 */

/**
 * Ignores the abort of requests and runs till it is
 * killed by configured maximum_execution_time or exit().
 *
 * Without this croninfinite can't respawn independend.
 */
@ignore_user_abort(TRUE);


/**
 * Grab request information.
 *
 * We check and trust the token, so none of them
 * need to be checked for security reaosons.
 */
$cron_key            = @$_GET['cron_key'];
$token               = @$_GET['token'];
$rule                = @$_GET['rule'];
$max_execution_time  = @$_GET['max_execution_time'];
$temporary_path      = @$_GET['temporary_path'];
$drupal_base_path    = @$_GET['drupal_base_path'];
$drupal_root_path    = @$_GET['drupal_root_path'];
$phase               = @$_GET['phase'];

// Change current working directory to drupal root.
@chdir($drupal_root_path);

// Check for Croninfinite lockfile (also verifies cron_key and token).
$lockfile = $temporary_path . sha1($cron_key . $token) . '.croninfinite.lock';
if (!file_exists($lockfile)) {
  exit();
}

// Check for planned cron task.
if (croninfinite_cron_task($rule, $lockfile)) {
  // Start cron.
  croninfinite_cron_trigger($cron_key, $drupal_base_path);
  // Refresh token change (to be shure not to do one task twice).
  file_put_contents($lockfile, (int) (time() / 60));
}

// No planned task.
else {
  // Change logfile every 5 minutes, to show that it is (still) running.
  if ($phase == 'start' || @idate('i') % 5 == 0) {
    file_put_contents($lockfile, (int) (time() / 60));
  }
  // Sleep almost till the end of execution (before it may get killed).
  if ($phase != 'start') {
    @sleep($max_execution_time - 1);
  }
}

// Re-execute the script before it may gets killed.
croninfinite_respawn($cron_key, $token, $rule, $max_execution_time, $temporary_path, $drupal_base_path);

/**
 * Function to Respawn croninfinite.
 */
function croninfinite_respawn($cron_key, $token, $rule, $max_execution_time, $temporary_path, $drupal_base_path) {
  // Create the HTTP query to croninfinite.php.
  $request  = "GET " . $_SERVER['PHP_SELF']
    . "?cron_key=" . $cron_key
    . "&token=" . $token
    . "&rule=" . urlencode($rule)
    . "&max_execution_time=" . $max_execution_time
    . "&temporary_path=" . $temporary_path
    . "&drupal_base_path=" . $drupal_base_path
    . " HTTP/1.1\r\n";
  $request .= "Host: " . $_SERVER['SERVER_NAME'] . "\r\n";
  $request .= "Connection: Close\r\n\r\n";

  // Open a TCP connection and send the HTTP query.
  $fsock = @fsockopen($_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT'], $error_no, $error_str, 5);
  if ($fsock) {
    fwrite($fsock, $request);
    fclose($fsock);
  }
}


/**
 * Function to start cron.
 */
function croninfinite_cron_trigger($cron_key, $drupal_base_path) {
  // Execute cron via HTTP request.
  // (Inclusion could kill some kittens here).
  $request  = "GET " . $drupal_base_path . "cron.php?cron_key=" . $cron_key . " HTTP/1.1\r\n";
  $request .= "Host: " . $_SERVER['SERVER_NAME'] . "\r\n";
  // We don't need to keep alive because cron ignores aborts.
  $request .= "Connection: Close\r\n\r\n";
  // Open a TCP connection and send the HTTP query.
  $fsock = @fsockopen($_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT'], $error_no, $error_str, 10);
  if ($fsock) {
    fwrite($fsock, $request);
    fclose($fsock);
  }
}

/**
 * Function to check for a planned cron task.
 * The following lines will try to interprete the given rule.
 */
function croninfinite_cron_task($rule, $lockfile) {
  // Get rule parts.
  list($rule_minute, $rule_hour, $rule_day, $rule_month, $rule_weekday) = explode(' ', $rule);

  // Get current date parts.
  $current_minute  = @idate('i');
  $current_hour    = @idate('H');
  $current_day     = @idate('d');
  $current_month   = @idate('m');
  $current_weekday = @idate('w');

  // Check minute.
  if ($rule_minute != $current_minute) {
    if (@$rule_minute[1] != '/' || $current_minute % substr($rule_minute, 2) != 0) {
      return FALSE;
    }
  }

  // Check hour.
  if ($rule_hour != '*' && $rule_hour != $current_hour) {
    if (@$rule_hour[1] != '/' || $current_hour % substr($rule_hour, 2) != 0) {
      return FALSE;
    }
  }

  // Check day.
  if ($rule_day != '*' && (string) $rule_day != (string) $current_day) {
    $rule_day = explode('-', $rule_day);
    if (!isset($rule_day[1])) {
      return FALSE;
    }
    if ((int) $rule_day[0] > (int) $current_day || (int) $rule_day[1] < (int) $current_day) {
      return FALSE;
    }
  }

  // Check month.
  if ($rule_month != '*' && (string) $rule_month != (string) $current_month) {
    $rule_month = explode('-', $rule_month);
    if (!isset($rule_month[1])) {
      return FALSE;
    }
    if ((int) $rule_month[0] > (int) $current_month || (int) $rule_month[1] < (int) $current_month) {
      return FALSE;
    }
  }

  // Check weekday.
  if ($rule_weekday != '*' && (string) $rule_weekday != (string) $current_weekday) {
    $rule_weekday = explode('-', $rule_weekday);
    if (!isset($rule_weekday[1])) {
      return FALSE;
    }
    if ((int) $rule_weekday[0] > (int) $current_weekday || (int) $rule_weekday[1] < (int) $current_weekday) {
      return FALSE;
    }
  }

  // Check last token change (to be shure not to do one task twice).
  return (int) @file_get_contents($lockfile) != (int) (time() / 60);
}
