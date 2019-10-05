
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once'Config/Config.php';
require_once'Config/Autoload.php';

use Config\Autoload as Autoload;
use Config\Request as Request;
use Config\Router as Router;

Autoload::Start();
session_start();
/*poner base en el index. by leo*/
if(!isset($_SESSION['start']))
{
	require_once ('Views/Login.php');
	$_SESSION['start']=true;
}

$request = Request::getInstance();
Router::Route($request);

?>