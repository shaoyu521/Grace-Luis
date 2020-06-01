<?php
/**
 * TimThumb by Ben Gillbanks and Mark Maunder
 */

define ('VERSION', '2.8.14');
//Load a config file if it exists. Otherwise, use the values below
if( file_exists(dirname(__FILE__) . '/timthumb-config.php'))    require_once('timthumb-config.php');