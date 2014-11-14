-- SUMMARY --

Croninfinite | croning cron without cron

Croninfinite allows you to run cron just like a cron job - but completely
without a cron job, a site visitor or a manual cron run.
It's really a kind of PHP implementation of the unix cron utility what
is recommended for most sites.


-- USE CASE --

- You don't want to rely on drupals default cron setting
  (only triggers if your site is visited).
- You are not able to use or don't even know about unix crontab.
- But you want to have your cron run routinely.


-- REQUIREMENTS --

None.


-- How to use it? --

Install as usual, see http://drupal.org/node/895232 for further information.

After installation you have to configure the interval cron should be triggered
at cron's settings page (admin/config/system/cron) and start croninfinite.
Now it should keep running as background process and trigger cron as desired.

-- Advanced cron-timing --

Croninfinite offers you a very comfortable way to time your cron runs but
sometimes this is not enough and you need an advanced timing. This is what
timing-rules are made for: The format of rules for advanced timing is very
similar to the unix crontab utility syntax:

* * * * * <= the timing-rule
┬ ┬ ┬ ┬ ┬
│ │ │ │ │
│ │ │ │ └──── Weekday (0-6) (Sunday=0) [-Weekday]
│ │ │ └────── Month (1-12) [-Month]
│ │ └──────── Day (1-31) [-Day]
│ └────────── [*/] Hour (0-23)
└──────────── [*/] Minute (0-59)

Examples:

0	    *	    *	    *	    *	    Hourly
*/30	*	    *	    *	    *	    Every thirty minutes
0	    0	    *	    *	    1-5	  At midnight from Monday to Friday
*/5	  0	    1	    *	    *	    Every five minutes about 0 o'clock on
                              the first day of each month
0	    */3 	*	    2-11	*	    Every three hours from Februar to November


-- How does it work? --

Croninfinite depends on a script that runs "infinite".
(Before you pass judgement on this claim, please continue reading)

- The script does not depend on a site visitors request
- It runs with minimal system rights, a set maximum_execution_time
  and save mode
- Independent from any third party service like online-cron's

The "infinite" running script doesn't run endless actually, it just times the
right moment to re-execute itself just before it may gets killed by
max_execution_time. I have seen this behaviour on PHP-based malware and it
seems to work very solid.


-- Technical aspects and problems --

The max_execution_time sets the maximum time in seconds a script is allowed to
run before it is terminated. The default setting is 30 seconds. A value of 0
would enable scripts to run infinite. Croninfinite could be enabled to run
infinite by setting max_execution_time value to 0 (using ini_set()) or by
expanding the maximum value (using set_time_limit())

But..
  ..when running safe mode this setting cannot be changed while runtime.
  ..execution could also be interrupted by the web server's timeout
    configuration.
  The sleep() function delays the script execution for the given number
  of seconds. Time spend sleeping is not used to determine the time that
  the script has been running. Croninfinite could be enabled to run infinite
  by using the sleep function between cron runs.

But..
  ..sleeping time is ignored under Linux, but it counts as execution time on
    Windows
  ..while sleeping execution could also be interrupted by the web server's
    timeout configuration.
  The ignore_user_abort() function sets whether a client disconnect should
  cause a script to be aborted. By fsockopen() a socket connection (eg. HTTP
  with TCP) can be opened with minimal requirements. Croninfinite can be
  enabled to run infinite by restarting itself independent through HTTP using
  these functions. To save CPU performance it can delay the "re-spawn" by
  sleeping the left max_execution_time before it may get killed (read above).

But the max_execution_time cannot be determined reliable by PHP's configuration
because many hosts set it to values like -1 to control it through kernel.
Croninfinite tries to assess it by executing a script that wants to run much
longer than it's allowed to and time the period until it gets killed. This
period should be equal to the value of max_execution_time.


-- Related projects --

- Ultimate Cron (Similar but more advanced)
    http://drupal.org/project/ultimate_cron
- Background Process (Similar technology)
    http://drupal.org/project/background_process
- Elysia Cron (Similar timing granularity)
    http://drupal.org/project/elysia_cron
