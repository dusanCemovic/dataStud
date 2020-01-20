<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| datastud global constants
|--------------------------------------------------------------------------
|
*/


define( 'DB_PREFIX', 'dts_' );
define( 'PROTOCOL', 'https' );

define( 'CURRENCY', '$' );

// dates
define( 'DATE_FORMAT_PHP', 'd-m-Y' ); // used for read
define( 'DATE_FORMAT_VIEW', 'd.m.Y' ); // used for items
define( 'TIME_FORMAT_PHP', 'G:i' );   // used for read
define( 'DATETIME_FORMAT_PHP', 'd-m-Y G:i' );
define( 'DATETIME_FORMAT_VIEW', 'd.m.Y G:i.v' );
define( 'DATE_FORMAT_JS', 'dd-mm-yyyy' );

// statistic
define( 'DATE_STATISTIC_FORMAT_PHP', 'd-m-Y-G-i' ); // used for read
define( 'DATE_STATISTIC_FORMAT_PHP_WITHOUT_TIME', 'd-m-Y' ); // used for read
define( 'DATE_STATISTIC_MONTH', 'm.Y' ); // used for read
define( 'DATE_STATISTIC_DAY', 'd.m.Y' ); // used for read

define( 'STARTING_DATE_STATISTIC', '01-08-2018-00-00' );
define( 'STARTING_DATE_STATISTIC_JS', '01-08-2018' );

// for tables
define( 'DATE_FORMAT_PHP_SORTABLE', 'Y-m-d' ); // used for read

define( 'ONE_HOUR_TIMESTAMP', 3600 );
define( 'ONE_DAY_TIMESTAMP', 86400 );
define( 'THIRTY_DAYS_TIMESTAMP', ONE_DAY_TIMESTAMP * 30 );

define( 'ADMIN_MAIL', 'admin@datastud.net' );
define( 'NOREPLY_MAIL', 'noreply@datastud.net' );

define( 'IN_DEVELOPEMENT', true );

// only for development phase
if ( IN_DEVELOPEMENT ) {

	define( 'MAIN_SITE_URL', 'https://datastud.net/demo' );
	define( 'MINIMIZE', '.min' );
	define( 'EMAIL_SENDING', true );
	define( 'GOOGLEANAL', true );

} else {

	define( 'MAIN_SITE_URL', 'https://datastud.net/demo' );
	define( 'MINIMIZE', '.min' );
	define( 'EMAIL_SENDING', true );
	define( 'GOOGLEANAL', true );

}

// user authenticating status
define( 'USER_DB_ERROR', - 1 );
define( 'USER_NOT_EXISTS', 0 );
define( 'USER_OK', 1 );
define( 'USER_NEW_PASS', 2 );
define( 'USER_NOT_ACTIVATED', 3 );
define( 'USER_BAD_PASS', 4 );


/* REST */

//custom regex

define( 'REGEX_FOR_EMAIL', '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/' );
define( 'REGEX_FOR_TEXTAREA', '/^[ŠšĐđČčĆćŽža-zA-Z0-9\.,\-_\n\s:\'"]+$/' );
define( 'REGEX_FOR_SKYPE', '/^[ŠšĐđČčĆćŽža-z][a-z0-9\.,\-_]{5,31}$/i' );
define( 'REGEX_FOR_NAME', '/^[ŠšĐđČčĆćŽža-zA-Z\s]+$/' );
define( 'REGEX_FOR_ADDRESS', '/^[ŠšĐđČčĆćŽža-zA-Z0-9\.,\-_\s:\'"]+$/' );
