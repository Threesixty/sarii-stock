<?php
require_once('Helper.php');

class Database {

	private $_conn;

    /**
     * Construct.
     *
     * @param array $config
     * @return true | PDOException
     */
    public function init($config) {
		try {
			$this->_conn = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'], $config['user'], $config['pwd']);

			// set the PDO error mode to exception
			$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_conn->query("SET CHARACTER SET utf8");

			return $this->_conn;

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage(),
				];
		}

	}
	
	public function getUsers() {

		$sql = 'SELECT * FROM user ORDER BY id ASC';

		try {
			$res = $this->_conn->query($sql);

			return $res->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return ['error' => $e->getMessage()];
		}
	}

	public function getUser($id) {
		
		$sql = 'SELECT * FROM user WHERE id = '.$id;

		try {
			$res = $this->_conn->query($sql);

			return $res->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return ['error' => $e->getMessage()];
		}
	}

	public function getHistories() {

		$sql = 'SELECT * FROM history ORDER BY id ASC';

		try {
			$res = $this->_conn->query($sql);

			return $res->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return ['error' => $e->getMessage()];
		}
	}

	public function getHistory($by, $id) {
		
		$sql = '';
		switch ($by) {
			case 'user':
				$sql = 'SELECT * FROM history WHERE idUser = '.$id;
				break;
			case 'product':
				$sql = 'SELECT * FROM history WHERE idProduct = '.$id;
				break;
			
			default:
				break;
		}


		try {
			$res = $this->_conn->query($sql);

			return $res->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return ['error' => $e->getMessage()];
		}
	}

}

?>