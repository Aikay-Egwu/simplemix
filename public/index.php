<?php

use MVC\Library\App as App ;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

define('VIEWS_PATH', ROOT.DS.'MVC'.DS.'Views');
define('CACHE_PATH', VIEWS_PATH.DS.'Cache');

/**
* This is a test code
* This function is to clear the
* twig cache folder each time a page is loaded
*
* @param  string $dir [directory of file]
* @return null
*/
function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") {
                    rrmdir($dir."/".$object);
                } else {
                    unlink($dir."/".$object);
                }
            }
        }
        reset($objects);
        //rmdir($dir);
    }
}

//clear the twig cache in views folder
rrmdir(CACHE_PATH);


define('TRUST_PATH', DS.'assets'.DS.'trust_images'.DS);
//Define the root folder
//Default is an empty string if in site root
define('ROOT_FOLDER', DS.'simplemix'.DS);
define('IMAGE', ROOT_FOLDER.'public'.DS.'assets'.DS);
define('IMAGES', DS.'public'.DS.'assets'.DS);
define('URL', 'http://www.misturadevelopment.org'.ROOT_FOLDER);
$twig = '';

//loads database and settings
require_once __DIR__ . "/../core/init.php" ;


//start session
session_start();
App::run($_SERVER['REQUEST_URI']);
