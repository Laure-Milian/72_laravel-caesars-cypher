<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	public $timestamps = false;

	public static function boot() {

		//parent::boot();

		Message::saving(function($message) {
			$letters_array = str_split($message->content);
			foreach ($letters_array as $letter) {
				$new_array[] = chr(ord($letter) + $message->offseting);
			}
			$new_content = strval(implode("", $new_array));
			if (!mb_detect_encoding($new_content, 'ASCII')) {
				return false; 
			} else {
				$message->content = $new_content;
			}
		});

	}

}
