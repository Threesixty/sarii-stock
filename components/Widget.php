<?php
require_once('Helper.php');

class Widget {

	public function __construct() {

    }

    public static function add($view, $title, $user) {

		require_once('widgets/'.$view.'.php');
	}
}

?>