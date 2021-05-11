<?php
require_once('components/Helper.php');
require_once('components/Database.php');

class User {

	private $_conn;

	public $id;
	public $username;
	public $password;
	public $lastname;
	public $firstname;
	public $role;
	public $status;
	public $created_at;

	public function __construct($dB) {
		$this->_conn = $dB;
    }

    public function findBy($key, $value) {
		
		$sql = 'SELECT * FROM user WHERE '.$key.' = "'.$value.'"';

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

	public function getUsers() {

		$sql = 'SELECT * FROM user ORDER BY id ASC';

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

	public function delete($userId) {

		$sql = 'DELETE FROM user WHERE id = '.intval($userId);

		try {
			$res = $this->_conn->query($sql);

			return $res ? [
						'status' => 'success',
						'msg' => 'L‘utilisateur a bien été supprimé.',
					] : [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement de l‘utilisateur. Veuillez contacter l‘administrateur du site',
					];

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}

    public function save($user, $newPwd = false, $pwdToken = false, $edit = false) {

    	$password = $newPwd ? sha1($user['password']) : $user['password'];
    	$passwordToken = $pwdToken ? ', password_token = "'.$user['password_token'].'"' : '';

    	if (isset($user['id'])) {

			$sql = 'UPDATE user SET username = "'.$user['username'].'", password = "'.$password.'"'.$passwordToken.', lastname = "'.$user['lastname'].'", firstname = "'.$user['firstname'].'", email = "'.$user['email'].'", role = "'.$user['role'].'", status = "'.$user['status'].'" WHERE id = '.$user['id'];
    	} else {

			$sql = 'INSERT INTO user (username, password, lastname, firstname, email, role, status, created_at) VALUES ("'.$user['username'].'", "'.sha1($user['password']).'", "'.$user['lastname'].'", "'.$user['firstname'].'", "'.$user['email'].'", 1, 0, "'.time().'")';
    	}

		try {
			$res = $this->_conn->query($sql);

			if (!$edit && $res) {
				return [
						'status' => 'success',
						'msg' => 'Votre demande d‘accès a bien été enregistré. Veuillez attendre la validation de votre compte pour vous connecter',
						'action' => 'signin',
					];
			} elseif ($edit && $res) {
				return [
						'status' => 'success',
						'msg' => 'L‘utilisateur a bien été sauvegardé',
					];
			} else {
				return [
						'status' => 'error',
						'msg' => 'Une erreur s‘est produite lors de l‘enregistrement de l‘utilisateur. Veuillez contacter l‘administrateur du site',
					];
			}

		} catch(PDOException $e) {
			return [
					'status' => 'error',
					'msg' => $e->getMessage()
				];
		}
	}

	public function randomPwd($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    if ($max < 1) {
	        throw new Exception('$keyspace must be at least two characters long');
	    }
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }

	    return $str;
	}
}

?>