<?php
require_once('components/Helper.php');
require_once('components/Database.php');

class Product {

	private $_conn;

	public $id;
	public $name;
	public $description;
	public $photo;
	public $reference;
	public $supplier;
	public $category_id;
	public $stock;
	public $stock_mini;
	public $status;
	public $created_at;

	public function __construct($dB) {
		$this->_conn = $dB;
    }

    public function findBy($key, $value, $one = true) {

		$sql = 'SELECT * FROM product WHERE '.$key.' = "'.$value.'"';

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

	public function getProducts() {

		$sql = 'SELECT * FROM product ORDER BY id ASC';

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

	public function delete($productId) {

		$sql = 'DELETE FROM product WHERE id = '.intval($productId);

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'Le produit a bien été supprimé.',
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

    public function save($product, $type = null) {

    	$updatePhoto = $cleanFilename = '';
		if (!empty($_FILES)) {
			$cleanFilename = time().'_'.Helper::cleanFilename($_FILES['photo']['name']);
			$fileUploaded = move_uploaded_file($_FILES['photo']['tmp_name'], 'medias/'.$cleanFilename);
			if ($fileUploaded)
				$updatePhoto = 'photo = "'.$cleanFilename.'",';
		}

    	$status = isset($_POST['status']) && $_POST['status'] == 1 ? 1 : 0;

    	$action = false;
    	if (isset($product['id'])) {
			$sql = 'UPDATE product SET name = "'.$product['name'].'", description = "'.$product['description'].'", '.$updatePhoto.' reference = "'.$product['reference'].'", supplier = "'.$product['supplier'].'", category_id = "'.$product['category_id'].'", stock = "'.$product['stock'].'", stock_mini = "'.$product['stock_mini'].'", status = "'.$product['status'].'" WHERE id = '.$product['id'];
    	} else {

    		$action = 'redirect';
			$sql = 'INSERT INTO product (name, description, photo, reference, category_id, stock, stock_mini, status, created_at) VALUES ("'.$product['name'].'", "'.$product['description'].'", "'.$filename.'", "'.$product['reference'].'", "'.$product['supplier'].'", "'.$product['category_id'].'", "'.$product['stock'].'", "'.$product['stock_mini'].'", '.$product['status'].', "'.time().'")';
    	}

		try {
			$res = $this->_conn->query($sql);

			$msg = 'Le produit a bien été sauvegardé.';
			switch ($type) {
				case 'inc':
				case 'dec':
					$msg = 'Le stock a bien été mis à jour.';
					break;
				
				default:
					break;
			}

			return $res ? [
						'status' => 'success',
						'msg' => $msg,
						'action' => $action,
						'id' => $action ? $this->_conn->lastInsertId() : false,
						'photo' => $cleanFilename,
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