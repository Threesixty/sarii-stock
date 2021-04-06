<?php
//PHPMailer
require_once('components/PHPMailer/src/PHPMailer.php');
require_once('components/PHPMailer/src/Exception.php');
require_once('components/PHPMailer/src/SMTP.php');
// Barecode generator
require_once('components/Barecode/src/Barcode.php');
require_once('components/Barecode/src/BarcodeBar.php');
require_once('components/Barecode/src/BarcodeGenerator.php');
require_once('components/Barecode/src/BarcodeGeneratorPNG.php');
require_once('components/Barecode/src/Types/TypeInterface.php');
require_once('components/Barecode/src/Types/TypeCode39.php');
require_once('components/Barecode/src/Exceptions/BarcodeException.php');
require_once('components/Barecode/src/Exceptions/InvalidCharacterException.php');


class Helper {

	public static $_bonjour = ['Bonjour', 'Assalam Aleykom', 'Buongiorno', 'Hola', 'Nĭ hăo', 'Bom dia', 'Hi', 'Chào'];
	public static $_roleNames = [
			1 => [
				'name' => 'Approvisionnement',
				'color' => 'primary'
			],
			2 => [
				'name' => 'Expédition',
				'color' => 'warning'
			],
			3 => [
				'name' => 'Admin',
				'color' => 'info'
			],
		];

    public static function pp($mixed) {
    	echo '<pre class="debug"><code>';
    	var_dump($mixed);
    	echo '</code></pre>';

	}

	public static function bonjour() {

		return static::$_bonjour[array_rand(static::$_bonjour)];

	}

	public static function getRoleName($roleId, $color = false) {

		return $color ? static::$_roleNames[$roleId]['color'] :  static::$_roleNames[$roleId]['name'];

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

	public static function getBarcodeImg($reference) {

		$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
		return base64_encode($generator->getBarcode($reference, $generator::TYPE_CODE_39, 2, 100));
	}
}

?>