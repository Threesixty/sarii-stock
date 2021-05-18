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

	public static function getRoleNames() {

		return static::$_roleNames;

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

	public static function getDashboardChart($histories, $db) {

		$chartHistories = [];
		if (!empty($histories)) {
			foreach ($histories as $key => $history) {
				$chartHistories[$history['operation']][strftime('%B %Y', $history['created_at'])] = isset($chartHistories[$history['operation']][strftime('%B %Y', $history['created_at'])]) ? $chartHistories[$history['operation']][strftime('%B %Y', $history['created_at'])] + $history['value'] : $history['value'];
			}
		}

		return $chartHistories;
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
		$barcode = $generator->getBarcode($reference, $generator::TYPE_CODE_39, 2, 100);

		return base64_encode($barcode);
	}

    public static function cleanFilename($string) {

		if (static::seems_utf8($string)) {
			$chars = array(
			// Decompositions for Latin-1 Supplement
			'%' => '_',
			'ª' => 'a', 'º' => 'o',
			'À' => 'A', 'Á' => 'A',
			'Â' => 'A', 'Ã' => 'A',
			'Ä' => 'A', 'Å' => 'A',
			'Æ' => 'AE','Ç' => 'C',
			'È' => 'E', 'É' => 'E',
			'Ê' => 'E', 'Ë' => 'E',
			'Ì' => 'I', 'Í' => 'I',
			'Î' => 'I', 'Ï' => 'I',
			'Ð' => 'D', 'Ñ' => 'N',
			'Ò' => 'O', 'Ó' => 'O',
			'Ô' => 'O', 'Õ' => 'O',
			'Ö' => 'O', 'Ù' => 'U',
			'Ú' => 'U', 'Û' => 'U',
			'Ü' => 'U', 'Ý' => 'Y',
			'Þ' => 'TH','ß' => 's',
			'à' => 'a', 'á' => 'a',
			'â' => 'a', 'ã' => 'a',
			'ä' => 'a', 'å' => 'a',
			'æ' => 'ae','ç' => 'c',
			'è' => 'e', 'é' => 'e',
			'ê' => 'e', 'ë' => 'e',
			'ì' => 'i', 'í' => 'i',
			'î' => 'i', 'ï' => 'i',
			'ð' => 'd', 'ñ' => 'n',
			'ò' => 'o', 'ó' => 'o',
			'ô' => 'o', 'õ' => 'o',
			'ö' => 'o', 'ø' => 'o',
			'ù' => 'u', 'ú' => 'u',
			'û' => 'u', 'ü' => 'u',
			'ý' => 'y', 'þ' => 'th',
			'ÿ' => 'y', 'Ø' => 'O',
			// Decompositions for Latin Extended-A
			'Ā' => 'A', 'ā' => 'a',
			'Ă' => 'A', 'ă' => 'a',
			'Ą' => 'A', 'ą' => 'a',
			'Ć' => 'C', 'ć' => 'c',
			'Ĉ' => 'C', 'ĉ' => 'c',
			'Ċ' => 'C', 'ċ' => 'c',
			'Č' => 'C', 'č' => 'c',
			'Ď' => 'D', 'ď' => 'd',
			'Đ' => 'D', 'đ' => 'd',
			'Ē' => 'E', 'ē' => 'e',
			'Ĕ' => 'E', 'ĕ' => 'e',
			'Ė' => 'E', 'ė' => 'e',
			'Ę' => 'E', 'ę' => 'e',
			'Ě' => 'E', 'ě' => 'e',
			'Ĝ' => 'G', 'ĝ' => 'g',
			'Ğ' => 'G', 'ğ' => 'g',
			'Ġ' => 'G', 'ġ' => 'g',
			'Ģ' => 'G', 'ģ' => 'g',
			'Ĥ' => 'H', 'ĥ' => 'h',
			'Ħ' => 'H', 'ħ' => 'h',
			'Ĩ' => 'I', 'ĩ' => 'i',
			'Ī' => 'I', 'ī' => 'i',
			'Ĭ' => 'I', 'ĭ' => 'i',
			'Į' => 'I', 'į' => 'i',
			'İ' => 'I', 'ı' => 'i',
			'Ĳ' => 'IJ','ĳ' => 'ij',
			'Ĵ' => 'J', 'ĵ' => 'j',
			'Ķ' => 'K', 'ķ' => 'k',
			'ĸ' => 'k', 'Ĺ' => 'L',
			'ĺ' => 'l', 'Ļ' => 'L',
			'ļ' => 'l', 'Ľ' => 'L',
			'ľ' => 'l', 'Ŀ' => 'L',
			'ŀ' => 'l', 'Ł' => 'L',
			'ł' => 'l', 'Ń' => 'N',
			'ń' => 'n', 'Ņ' => 'N',
			'ņ' => 'n', 'Ň' => 'N',
			'ň' => 'n', 'ŉ' => 'n',
			'Ŋ' => 'N', 'ŋ' => 'n',
			'Ō' => 'O', 'ō' => 'o',
			'Ŏ' => 'O', 'ŏ' => 'o',
			'Ő' => 'O', 'ő' => 'o',
			'Œ' => 'OE','œ' => 'oe',
			'Ŕ' => 'R','ŕ' => 'r',
			'Ŗ' => 'R','ŗ' => 'r',
			'Ř' => 'R','ř' => 'r',
			'Ś' => 'S','ś' => 's',
			'Ŝ' => 'S','ŝ' => 's',
			'Ş' => 'S','ş' => 's',
			'Š' => 'S', 'š' => 's',
			'Ţ' => 'T', 'ţ' => 't',
			'Ť' => 'T', 'ť' => 't',
			'Ŧ' => 'T', 'ŧ' => 't',
			'Ũ' => 'U', 'ũ' => 'u',
			'Ū' => 'U', 'ū' => 'u',
			'Ŭ' => 'U', 'ŭ' => 'u',
			'Ů' => 'U', 'ů' => 'u',
			'Ű' => 'U', 'ű' => 'u',
			'Ų' => 'U', 'ų' => 'u',
			'Ŵ' => 'W', 'ŵ' => 'w',
			'Ŷ' => 'Y', 'ŷ' => 'y',
			'Ÿ' => 'Y', 'Ź' => 'Z',
			'ź' => 'z', 'Ż' => 'Z',
			'ż' => 'z', 'Ž' => 'Z',
			'ž' => 'z', 'ſ' => 's',
			// Decompositions for Latin Extended-B
			'Ș' => 'S', 'ș' => 's',
			'Ț' => 'T', 'ț' => 't',
			// Euro Sign
			'€' => 'E',
			// GBP (Pound) Sign
			'£' => '',
			// Vowels with diacritic (Vietnamese)
			// unmarked
			'Ơ' => 'O', 'ơ' => 'o',
			'Ư' => 'U', 'ư' => 'u',
			// grave accent
			'Ầ' => 'A', 'ầ' => 'a',
			'Ằ' => 'A', 'ằ' => 'a',
			'Ề' => 'E', 'ề' => 'e',
			'Ồ' => 'O', 'ồ' => 'o',
			'Ờ' => 'O', 'ờ' => 'o',
			'Ừ' => 'U', 'ừ' => 'u',
			'Ỳ' => 'Y', 'ỳ' => 'y',
			// hook
			'Ả' => 'A', 'ả' => 'a',
			'Ẩ' => 'A', 'ẩ' => 'a',
			'Ẳ' => 'A', 'ẳ' => 'a',
			'Ẻ' => 'E', 'ẻ' => 'e',
			'Ể' => 'E', 'ể' => 'e',
			'Ỉ' => 'I', 'ỉ' => 'i',
			'Ỏ' => 'O', 'ỏ' => 'o',
			'Ổ' => 'O', 'ổ' => 'o',
			'Ở' => 'O', 'ở' => 'o',
			'Ủ' => 'U', 'ủ' => 'u',
			'Ử' => 'U', 'ử' => 'u',
			'Ỷ' => 'Y', 'ỷ' => 'y',
			// tilde
			'Ẫ' => 'A', 'ẫ' => 'a',
			'Ẵ' => 'A', 'ẵ' => 'a',
			'Ẽ' => 'E', 'ẽ' => 'e',
			'Ễ' => 'E', 'ễ' => 'e',
			'Ỗ' => 'O', 'ỗ' => 'o',
			'Ỡ' => 'O', 'ỡ' => 'o',
			'Ữ' => 'U', 'ữ' => 'u',
			'Ỹ' => 'Y', 'ỹ' => 'y',
			// acute accent
			'Ấ' => 'A', 'ấ' => 'a',
			'Ắ' => 'A', 'ắ' => 'a',
			'Ế' => 'E', 'ế' => 'e',
			'Ố' => 'O', 'ố' => 'o',
			'Ớ' => 'O', 'ớ' => 'o',
			'Ứ' => 'U', 'ứ' => 'u',
			// dot below
			'Ạ' => 'A', 'ạ' => 'a',
			'Ậ' => 'A', 'ậ' => 'a',
			'Ặ' => 'A', 'ặ' => 'a',
			'Ẹ' => 'E', 'ẹ' => 'e',
			'Ệ' => 'E', 'ệ' => 'e',
			'Ị' => 'I', 'ị' => 'i',
			'Ọ' => 'O', 'ọ' => 'o',
			'Ộ' => 'O', 'ộ' => 'o',
			'Ợ' => 'O', 'ợ' => 'o',
			'Ụ' => 'U', 'ụ' => 'u',
			'Ự' => 'U', 'ự' => 'u',
			'Ỵ' => 'Y', 'ỵ' => 'y',
			// Vowels with diacritic (Chinese, Hanyu Pinyin)
			'ɑ' => 'a',
			// macron
			'Ǖ' => 'U', 'ǖ' => 'u',
			// acute accent
			'Ǘ' => 'U', 'ǘ' => 'u',
			// caron
			'Ǎ' => 'A', 'ǎ' => 'a',
			'Ǐ' => 'I', 'ǐ' => 'i',
			'Ǒ' => 'O', 'ǒ' => 'o',
			'Ǔ' => 'U', 'ǔ' => 'u',
			'Ǚ' => 'U', 'ǚ' => 'u',
			// grave accent
			'Ǜ' => 'U', 'ǜ' => 'u',
			);

			// Used for locale-specific rules
			$locale = 'fr_FR';

			if ( 'de_DE' == $locale || 'de_DE_formal' == $locale || 'de_CH' == $locale || 'de_CH_informal' == $locale ) {
				$chars[ 'Ä' ] = 'Ae';
				$chars[ 'ä' ] = 'ae';
				$chars[ 'Ö' ] = 'Oe';
				$chars[ 'ö' ] = 'oe';
				$chars[ 'Ü' ] = 'Ue';
				$chars[ 'ü' ] = 'ue';
				$chars[ 'ß' ] = 'ss';
			} elseif ( 'da_DK' === $locale ) {
				$chars[ 'Æ' ] = 'Ae';
	 			$chars[ 'æ' ] = 'ae';
				$chars[ 'Ø' ] = 'Oe';
				$chars[ 'ø' ] = 'oe';
				$chars[ 'Å' ] = 'Aa';
				$chars[ 'å' ] = 'aa';
			} elseif ( 'ca' === $locale ) {
				$chars[ 'l·l' ] = 'll';
			} elseif ( 'sr_RS' === $locale || 'bs_BA' === $locale ) {
				$chars[ 'Đ' ] = 'DJ';
				$chars[ 'đ' ] = 'dj';
			}

			$string = strtr($string, $chars);
		} else {
			$chars = array();
			// Assume ISO-8859-1 if not UTF-8
			$chars['in'] = "\x80\x83\x8a\x8e\x9a\x9e"
				."\x9f\xa2\xa5\xb5\xc0\xc1\xc2"
				."\xc3\xc4\xc5\xc7\xc8\xc9\xca"
				."\xcb\xcc\xcd\xce\xcf\xd1\xd2"
				."\xd3\xd4\xd5\xd6\xd8\xd9\xda"
				."\xdb\xdc\xdd\xe0\xe1\xe2\xe3"
				."\xe4\xe5\xe7\xe8\xe9\xea\xeb"
				."\xec\xed\xee\xef\xf1\xf2\xf3"
				."\xf4\xf5\xf6\xf8\xf9\xfa\xfb"
				."\xfc\xfd\xff";

			$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

			$string = strtr($string, $chars['in'], $chars['out']);
			$double_chars = array();
			$double_chars['in'] = array("\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe");
			$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
			$string = str_replace($double_chars['in'], $double_chars['out'], $string);
		}

    	$string = str_replace(str_split(' \'\\:.;*<>|'), "-", $string);
    	$string = str_replace(str_split('"!?'), "", $string);
        return trim(strtolower(filter_var($string, FILTER_SANITIZE_URL)), '-');

	}


	public static function seems_utf8( $str ) {
		static::mbstring_binary_safe_encoding();
		$length = strlen($str);
		static::mbstring_binary_safe_encoding(true);
		for ($i=0; $i < $length; $i++) {
			$c = ord($str[$i]);
			if ($c < 0x80) $n = 0; // 0bbbbbbb
			elseif (($c & 0xE0) == 0xC0) $n=1; // 110bbbbb
			elseif (($c & 0xF0) == 0xE0) $n=2; // 1110bbbb
			elseif (($c & 0xF8) == 0xF0) $n=3; // 11110bbb
			elseif (($c & 0xFC) == 0xF8) $n=4; // 111110bb
			elseif (($c & 0xFE) == 0xFC) $n=5; // 1111110b
			else return false; // Does not match any model
			for ($j=0; $j<$n; $j++) { // n bytes matching 10bbbbbb follow ?
				if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
					return false;
			}
		}
		return true;
	}

	public static function mbstring_binary_safe_encoding( $reset = false ) {
		static $encodings = array();
		static $overloaded = null;

		if ( is_null( $overloaded ) )
			$overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

		if ( false === $overloaded )
			return;

		if ( ! $reset ) {
			$encoding = mb_internal_encoding();
			array_push( $encodings, $encoding );
			mb_internal_encoding( 'ISO-8859-1' );
		}

		if ( $reset && $encodings ) {
			$encoding = array_pop( $encodings );
			mb_internal_encoding( $encoding );
		}
	}


	/**
	Truncate fct
	*
	* Truncates text.
	*
	* Cuts a string to the length of $length and replaces the last characters
	* with the ending if the text is longer than length.
	*
	* @param string  $text String to truncate.
	* @param integer $length Length of returned string, including ellipsis.
	* @param string  $ending Ending to be appended to the trimmed string.
	* @param boolean $exact If false, $text will not be cut mid-word
	* @param boolean $considerHtml If true, HTML tags would be handled correctly
	* @return string Trimmed string.
	*/
	public static function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {

	    if ($considerHtml) {
	        // if the plain text is shorter than the maximum length, return the whole text
	        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
	            return $text;
	        }
	 
	        // splits all html-tags to scanable lines
	        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
	 
	            $total_length = strlen($ending);
	            $open_tags = array();
	            $truncate = '';
	 
	        foreach ($lines as $line_matchings) {
	            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
	            if (!empty($line_matchings[1])) {
	                // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
	                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
	                    // do nothing
	                // if tag is a closing tag (f.e. </b>)
	                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
	                    // delete tag from $open_tags list
	                    $pos = array_search($tag_matchings[1], $open_tags);
	                    if ($pos !== false) {
	                        unset($open_tags[$pos]);
	                    }
	                // if tag is an opening tag (f.e. <b>)
	                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
	                    // add tag to the beginning of $open_tags list
	                    array_unshift($open_tags, strtolower($tag_matchings[1]));
	                }
	                // add html-tag to $truncate'd text
	                $truncate .= $line_matchings[1];
	            }
	 
	            // calculate the length of the plain text part of the line; handle entities as one character
	            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
	            if ($total_length+$content_length> $length) {
	                // the number of characters which are left
	                $left = $length - $total_length;
	                $entities_length = 0;
	                // search for html entities
	                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
	                    // calculate the real length of all entities in the legal range
	                    foreach ($entities[0] as $entity) {
	                        if ($entity[1]+1-$entities_length <= $left) {
	                            $left--;
	                            $entities_length += strlen($entity[0]);
	                        } else {
	                            // no more characters left
	                            break;
	                        }
	                    }
	                }
	                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
	                // maximum lenght is reached, so get off the loop
	                break;
	            } else {
	                $truncate .= $line_matchings[2];
	                $total_length += $content_length;
	            }
	 
	            // if the maximum length is reached, get off the loop
	            if($total_length>= $length) {
	                break;
	            }
	        }
	    } else {
	        if (strlen($text) <= $length) {
	            return $text;
	        } else {
	            $truncate = substr($text, 0, $length - strlen($ending));
	        }
	    }
	 
	    // if the words shouldn't be cut in the middle...
	    if (!$exact) {
	        // ...search the last occurance of a space...
	        $spacepos = strrpos($truncate, ' ');
	        if (isset($spacepos)) {
	            // ...and cut the text in this position
	            $truncate = substr($truncate, 0, $spacepos);
	        }
	    }
	 
	    // add the defined ending to the text
	    $truncate .= $ending;
	 
	    if($considerHtml) {
	        // close all unclosed html-tags
	        foreach ($open_tags as $tag) {
	            $truncate .= '</' . $tag . '>';
	        }
	    }
	 
	    return $truncate;
	 
	}
}

?>