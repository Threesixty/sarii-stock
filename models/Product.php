<?php
require_once('components/Helper.php');
require_once('components/Database.php');

class Product {

	private $_conn;

	public $id;
	public $name;
	public $description;
	public $reference;
	public $category_id;
	public $stock;
	public $stock_mini;
	public $status;
	public $created_at;

	public function __construct($dB) {
		$this->_conn = $dB;
    }

    public function findBy($key, $value) {

		$sql = 'SELECT * FROM product WHERE '.$key.' = "'.$value.'"';

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

    public function save($product) {

    	if (isset($product['id'])) {

			$sql = 'UPDATE product SET name = "'.$product['name'].', description = "'.$product['description'].'", reference = "'.$product['reference'].'", category_id = "'.$product['category_id'].'", stock = "'.$product['stock'].'", stock_mini = "'.$product['stock_mini'].'", status = "'.$product['status'].'" WHERE id = '.$product['id'];
    	} else {

			$sql = 'INSERT INTO user (name, description, reference, category_id, stock, stock_mini, status, created_at) VALUES ("'.$product['name'].'", "'.$product['description'].'", "'.$product['reference'].'", "'.$product['category_id'].'", "'.$product['stock'].'", "'.$product['stock_mini'].'", 1, "'.time().'")';
    	}

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'Le produit a bien été enregistré.',
						'action' => 'signin',
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
}

?>