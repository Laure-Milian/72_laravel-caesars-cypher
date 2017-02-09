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
		$encrypted_message = $this->crypt($message, $offset, true);
		$this->saveMessage($encrypted_message, $offset);
		$messages = Message::all();
		return view('list', ['messages' => $messages]);
	}

	public function saveMessage($encrypted_message, $offset) {
		$entry = new Message;
		$entry->content = $encrypted_message;
		$entry->offseting = $offset;
		$entry->save();
	}


	public function getShow($id) {
		$message = Message::find($id);
		return view('show', ['message' => $message]);
	}

	public function postShow(Request $request, $id, $offset) {
		$message = Message::find($id)->content;
		//$offset = $request->offset;
		$decrypted_message = $this->crypt($message, $offset, false);
		return $decrypted_message;
	}

	private function crypt($message, $offset, $encrypt) {
		$letters_array = str_split($message);
		($encrypt) ? $values = [25, 0, +1] : $values = [0, 25, -1];
		foreach ($letters_array as $letter) {
			if (!in_array($letter, $this->_alphabet)) {
				$new_array[] = $letter;
			} else {	
				$position = array_search($letter, $this->_alphabet);
				for ($i = 0; $i < $offset ; $i++) {
					if ($position === $values[0]) {
						$position = $values[1];
					} else {
						$position = $position + $values[2];
					}
				} 
				$new_array[] = $this->_alphabet[$position];
			}
		}
		return implode("", $new_array);
	}

}


