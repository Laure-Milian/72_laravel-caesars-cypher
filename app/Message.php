<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	public $timestamps = false;

	public static function boot() {

		parent::boot();

		Message::saving(function ($message) {
			$message->content = self::encrypt($message->content, $message->offseting);
			if (!$message->content) {
				return false;
			}
		});

	}

	public static function encrypt($message, $offset) {
			$letters_array = str_split($message);
			foreach ($letters_array as $letter) {
				$new_array[] = chr(ord($letter) + $offset);
			}
			$new_content = strval(implode("", $new_array));
			if (!mb_detect_encoding($new_content, 'ASCII')) {
				throw new \Exception("Offset incorrect", 1);	
			} else {
				return $new_content;
			}
	}

	public function decrypt($offset) {
		return self::encrypt($this->content, $offset * -1);
	}

	// public static function decrypt($content, $offset) {
	// 	return "bla";
	// 	// $letters_array = str_split($content);
		// foreach ($letters_array as $letter) {
		// 	$new_array[] = chr(ord($letter) - $offset);
		// }
		// return strval(implode("", $new_array));
	// }
}
