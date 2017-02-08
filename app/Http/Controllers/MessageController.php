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
		$letters = str_split($message);
		foreach ($letters as $letter) {
			$position = array_search($letter, $this->_alphabet);
			if ($letter !== "A" && !$position) {
				$letters_encrypted[] = $letter;
			} else {
				$new_position = $position + $offset;
				if ($new_position % 25 >= 1) {
					$difference = ($new_position % 25) - 1;
					$letters_encrypted[] = $this->_alphabet[$difference];
				} else {
					$letters_encrypted[] = $this->_alphabet[$new_position];
				}
			}
		}
		$msg_encrypted = implode("", $letters_encrypted);
		return $msg_encrypted;
	}

}
