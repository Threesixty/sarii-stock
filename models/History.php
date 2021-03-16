<?php
require_once('components/Helper.php');
require_once('components/Database.php');

class History {

	private $_conn;

	public $id;
	public $id_product;
	public $id_user;
	public $operation;
	public $value;
	public $created_at;

	public function __construct($dB) {
		$this->_conn = $dB;
    }

    public function findBy($key, $value, $one = true) {

		$sql = 'SELECT * FROM history WHERE '.$key.' = "'.$value.'" ORDER BY id DESC';

		try {
			$res = $this->_conn->query($sql);

			return $one ? $res->fetch(PDO::FETCH_ASSOC) : $res->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];;
		}
	}

	public function delete($productId) {

		$sql = 'DELETE FROM history WHERE id = '.intval($productId);

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'Le mouvement de stock a bien été supprimé.',
					] : [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement du produit. Veuillez contacter l‘administrateur du site',
					];

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}

    public function save($productId, $userId, $operation, $value) {

		$sql = 'INSERT INTO history (id_product, id_user, operation, value, created_at) VALUES ("'.$productId.'", "'.$userId.'", "'.$operation.'", "'.$value.'", "'.time().'")';

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'Le mouvement de stock a bien été sauvegardé.',
					] : [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement de le mouvement de stock. Veuillez contacter l‘administrateur du site',
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