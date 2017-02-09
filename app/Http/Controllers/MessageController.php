<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
	private $_alphabet; 

	public function __construct() {
		$letters = range('A', 'Z');
		$this->_alphabet = $letters;
	}

	public function getList() {
		$messages = Message::all();
		return view('list', ['messages' => $messages]);
	}

	public function getCreate() {
		return view('create');
	}

	public function postCreate(Request $request) {
		$message = strtoupper($request->message);
		$offset = $request->offset;
		$encrypted_message = $this->encryption($message, $offset);
		$entry = new Message;
		$entry->content = $encrypted_message;
		$entry->offseting = $offset;
		$entry->save();
	}

	private function encryption($message, $offset) {
		$letters_array = str_split($message);
		foreach ($letters_array as $letter) {
			if (!in_array($letter, $this->_alphabet)) {
				$new_array[] = $letter;
			} else {	
				$position = array_search($letter, $this->_alphabet);
				$new_position = $position + $offset;
				if ($new_position > 25) {
					$diff = $new_position % 26;
					$new_position = 0 + $diff;
				} 
				$new_array[] = $this->_alphabet[$new_position];
			}
		}
		$msg_encrypted = implode("", $new_array);
		return $msg_encrypted;
	}

	public function getShow($id) {
		$message = Message::find($id);
		return view('show', ['message' => $message]);
	}

	public function postDecrypt(Request $request, $id) {
		$message = Message::find($id);
		$offset = $request->offset;
		$letters_array = str_split($message->content);
		foreach ($letters_array as $letter) {
			if (!in_array($letter, $this->_alphabet)) {
				$new_array[] = $letter;
			} else {	
				$position = array_search($letter, $this->_alphabet);
				for ($i = 0 ; $i < $offset; $i++) {
					if ($position === 0) {
						$position = 25;
					} else {
						$position = $position -1;
					}
				}
				$new_array[] = $this->_alphabet[$position];
			}
		}
		return $new_array;
	}
}


