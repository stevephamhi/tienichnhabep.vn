<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
ini_set('session.save_path', 'tmp');
session_start();
ob_start();

/*
 * --------------------------------------------------------------------
 * app path
 * --------------------------------------------------------------------
 */

$appPath = dirname(__FILE__);
define("APPPATH", $appPath);

/*
 * --------------------------------------------------------------------
 * mvc path
 * --------------------------------------------------------------------
 */

$mvcFolder = "mvc";
define("MVCPATH", APPPATH.DIRECTORY_SEPARATOR.$mvcFolder);

/*
 * --------------------------------------------------------------------
 * core path
 * --------------------------------------------------------------------
 */

$coreFolder = "core";
define("COREPATH", MVCPATH.DIRECTORY_SEPARATOR.$coreFolder);

/*
 * --------------------------------------------------------------------
 * config path
 * --------------------------------------------------------------------
 */

$configFolder = "config";
define("CONFIGPATH", MVCPATH.DIRECTORY_SEPARATOR.$configFolder);

/*
 * --------------------------------------------------------------------
 * controllers path
 * --------------------------------------------------------------------
 */

$controllersFolder = "controllers";
define("CONTROLLERSPATH", MVCPATH.DIRECTORY_SEPARATOR.$controllersFolder);

/*
 * --------------------------------------------------------------------
 * models path
 * --------------------------------------------------------------------
 */

$modelsFolder = "models";
define("MODELSPATH", MVCPATH.DIRECTORY_SEPARATOR.$modelsFolder);

/*
 * --------------------------------------------------------------------
 * views path
 * --------------------------------------------------------------------
 */

$viewsFolder = "views";
define("VIEWSPATH", MVCPATH.DIRECTORY_SEPARATOR.$viewsFolder);

/*
 * --------------------------------------------------------------------
 * layout path
 * --------------------------------------------------------------------
 */

$layoutFolder = "Layouts";
define("LAYOUTSPATH", VIEWSPATH.DIRECTORY_SEPARATOR.$layoutFolder);

/*
 * --------------------------------------------------------------------
 * public path
 * --------------------------------------------------------------------
 */

$publicFolder = "public";
define("PUBLICSPATH", APPPATH.DIRECTORY_SEPARATOR.$publicFolder);

/*
 * --------------------------------------------------------------------
 * MY APP
 * --------------------------------------------------------------------
 */


require_once COREPATH.DIRECTORY_SEPARATOR."loadFile.php";

$app = new App();