<?php
require_once('components/Helper.php');
require_once('components/Database.php');

class Category {

	private $_conn;

	public $id;
	public $name;
	public $type;
	public $created_at;

	public function __construct($dB) {
		$this->_conn = $dB;
    }

    public function findBy($key, $value) {
		
		$sql = 'SELECT * FROM category WHERE '.$key.' = "'.$value.'"';

		try {
			$res = $this->_conn->query($sql);

			return $res->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];;
		}
	}

	public function getCategories() {

		$sql = 'SELECT * FROM category ORDER BY id ASC';

		try {
			$res = $this->_conn->query($sql);

			return $res->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}

	public function delete($categoryId) {

		$sql = 'DELETE FROM category WHERE id = '.intval($categoryId);

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'La catégorie a bien été supprimée.',
					] : [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement de la catégorie. Veuillez contacter l‘administrateur du site',
					];

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}

    public function save($category) {

    	$action = false;
    	if (isset($category['id'])) {
			$sql = 'UPDATE category SET name = "'.$category['name'].'" WHERE id = '.$category['id'];
    	} else {

    		$action = 'redirect';
			$sql = 'INSERT INTO category (name, created_at) VALUES ("'.$category['name'].'", "'.time().'")';
    	}

		try {
			$res = $this->_conn->query($sql);

			$msg = 'La catégorie a bien été sauvegardée.';

			return $res ? [
						'status' => 'success',
						'msg' => $msg,
						'action' => $action,
						'id' => $action ? $this->_conn->lastInsertId() : false,
					] : [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement de la catégorie. Veuillez contacter l‘administrateur du site',
					];

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}
}

?>