<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{

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
		if (!mb_detect_encoding($encrypted_message, 'ASCII')) {
			$request->session()->flash('fail', 'Offset incorrect, merci de choisir une autre valeur');
			return back();
		} else {
			$this->saveMessage($encrypted_message, $offset);
			$request->session()->flash('success', 'Votre message a bien été sauvegardé');
			return redirect('/');
		}
	}

	private function saveMessage($encrypted_message, $offset) {
		$entry = new Message;
		$entry->content = $encrypted_message;
		$entry->offseting = $offset;
		$entry->save();
	}


	public function getShow($id) {
		$message = Message::findOrFail($id);
		return view('show', ['message' => $message]);
	}

	public function postShow(Request $request, $id) {
		$message = Message::findOrFail($id);
		$message = $message->content;
		$offset = $request->offset;
		$decrypted_message = $this->crypt($message, $offset, false);
		return response()->json($decrypted_message);
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


