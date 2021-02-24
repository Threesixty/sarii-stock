<?php
require_once('Helper.php');

class Configuration {

    public static function get() {

		require_once('config.php');
		
    	return $config;

	}
}

?>