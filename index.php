<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
ini_set('session.save_path', 'tmp');
session_start();
ob_start();

/**
 * APP PATH
 */
define("APP_PATH", dirname(__FILE__));

/**
 * MVC PATH
 */
define("MVC_PATH", APP_PATH . DIRECTORY_SEPARATOR . "mvc");

/**
 * CONFIG PATH
 */
define("CONFIG_PATH", MVC_PATH . DIRECTORY_SEPARATOR . "Config");

/**
 * CONTROLLER PATH
 */
define("CONTROLLER_PATH", MVC_PATH . DIRECTORY_SEPARATOR . "Controllers");

/**
 * MODEL PATH
 */
define("MODEL_PATH", MVC_PATH . DIRECTORY_SEPARATOR . "Models");

/**
 * VIEW PATH
 */
define("VIEW_PATH", MVC_PATH . DIRECTORY_SEPARATOR . "Views");

/**
 * CORE PATH
 */
define("CORE_PATH", MVC_PATH . DIRECTORY_SEPARATOR . "Core");

/**
 * Start App
 */

require "./mvc/sendMail/index.php";

require_once CORE_PATH . DIRECTORY_SEPARATOR . "App.php";

new App;