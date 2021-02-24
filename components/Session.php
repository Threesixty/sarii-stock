<?php
require_once('Helper.php');

class Session {

	public function __construct() {
		#session_set_cookie_params(3600, '/');
        session_start();
    }

    public static function get($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
	}

    public static function set($key, $value) {
		$_SESSION[$key] = $value;

		return $_SESSION[$key];
	}

    public static function delete($key) {
		unset($_SESSION[$key]);
	}
}

?>