<?php
/**
 * CONVERT CI SESSION TO NATIVE SESSION
 * https://stackoverflow.com/questions/7926455/access-codeigniter-session-values-from-external-files 
 */
$directory = DIRECTORY_SEPARATOR;
define('ENVIRONMENT', 'development');
define('BASEPATH', dirname(dirname(dirname(dirname(__FILE__)))));
define('APPPATH', BASEPATH . $directory . 'application' . $directory);
define('LIBBATH', BASEPATH . "{$directory}system{$directory}libraries{$directory}Session{$directory}");

require_once LIBBATH . 'Session_driver.php';
require_once LIBBATH . "drivers{$directory}Session_files_driver.php";
require_once BASEPATH . "{$directory}system{$directory}core{$directory}Common.php";

$config = get_config();

if (empty($config['sess_save_path'])) 
{
    $config['sess_save_path'] = rtrim(ini_get('session.save_path'), '/\\');
}

$config = array(
    'cookie_lifetime' => $config['sess_expiration'],
    'cookie_name'     => $config['sess_cookie_name'],
    'cookie_path'     => $config['cookie_path'],
    'cookie_domain'   => $config['cookie_domain'],
    'cookie_secure'   => $config['cookie_secure'],
    'expiration'      => $config['sess_expiration'],
    'match_ip'        => $config['sess_match_ip'],
    'save_path'       => $config['sess_save_path'],
    '_sid_regexp'     => '[0-9a-v]{32}',
);

$class = new CI_Session_files_driver($config);

if (is_php('5.4')) 
{
    session_set_save_handler($class, TRUE);
} 
else 
{
    session_set_save_handler(
        array($class, 'open'),
        array($class, 'close'),
        array($class, 'read'),
        array($class, 'write'),
        array($class, 'destroy'),
        array($class, 'gc')
    );
    register_shutdown_function('session_write_close');
}

session_name($config['cookie_name']);