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
		return redirect('/');
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
		($encrypt) ? $offset : $offset = -$offset;
		$letters_array = str_split($message);
		foreach ($letters_array as $letter) {
			$new_array[] = chr(ord($letter) + $offset);
		}
		return strval(implode("", $new_array));
	}

 
}


