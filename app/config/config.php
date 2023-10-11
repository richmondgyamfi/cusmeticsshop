<?php
# ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************

//Database params
define('DB_HOST', 'localhost'); //Add your db host
define('DB_USER', 'root'); // Add your DB root
define('DB_PASS', 'iamRichmond@1234'); //Add your DB pass
define('DB_NAME', 'sellshopdb'); //Add your DB Name

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);

//APPROOT
define('APPROOT', dirname(dirname(__FILE__)));
define('APPROOT2', dirname(dirname(dirname(__FILE__))));

//URLROOT (Dynamic links)
define('URLROOT', 'http://localhost:8080');

//Sitename
define('SITENAME', 'Login & Register script');
