<?php
require_once('components/PHPMailer/src/PHPMailer.php');
require_once('components/PHPMailer/src/Exception.php');
require_once('components/PHPMailer/src/SMTP.php');

class Helper {

    public static function pp($mixed) {
    	echo '<pre class="debug"><code>';
    	var_dump($mixed);
    	echo '</code></pre>';

	}

	public static function getRoleName($roleId) {

		$roles = [
				1 => 'Approvisionnement',
				2 => 'Expédition',
				3 => 'Admin',
			];

		return $roles[$roleId];

	}

	public static function getRoute($config) {

		$route = isset($_GET['r']) ? $_GET['r'] : 'index';
		$route = isset($config['routes'][$route]) ? $route : false;

		return $route;

	}

	public static function getUrl($action, $params = false) {
		$queryString = $params ? '&'.http_build_query($params) : '';
		return '?r='.$action.$queryString;
	}

	public static function getDashboardHistory($histories, $db) {

		$cleanHistories = [];
		if (!empty($histories)) {
			foreach ($histories as $key => $history) {

				$user = new User($db);
				$history['user'] = (object) $user->findBy('id', intval($history['id_user']));

				$product = new Product($db);
				$history['product'] = (object) $product->findBy('id', intval($history['id_product']));


				$cleanHistories[strftime('%e %B %Y', $history['created_at'])][date('H:i', $history['created_at'])] = $history;
			}
		}

		return $cleanHistories;
	}

	public static function sendMail($config, $mailContent) {

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		try {
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host = $config['mail']['host'];
		    $mail->SMTPAuth = true;
		    $mail->Username = $config['mail']['username'];
		    $mail->Password = $config['mail']['password'];
		    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
		    $mail->Port = $config['mail']['port'];

		    $mail->setFrom($config['mail']['from']['email'], $config['mail']['from']['name']);
    		$mail->addAddress($mailContent['to']['email'], $mailContent['to']['name']);

			$mail->isHTML(true);
		    $mail->Subject = $mailContent['subject'];
		    $mail->Body = $mailContent['msg'];
		    $mail->AltBody = $mailContent['msg'];

			return $mail->send();

		} catch (Exception $e) {
		    return false;
		}
	}
}

?>