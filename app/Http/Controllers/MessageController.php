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
		try {
			$message = $request->message;
			$offset = $request->offset;
			$savingResult = $this->saveMessage($message, $offset);
			$request->session()->flash('success', 'Votre message a bien été sauvegardé');
			return redirect('/');
		} catch(\Exception $e) {
			$request->session()->flash('fail', $e->getMessage());
			return back();
		} 
	}

	private function saveMessage($message, $offset) {
		$entry = new Message;
		$entry->content = $message;
		$entry->offseting = $offset;
		return $entry->save();
	}

	public function getShow($id) {
		$message = Message::findOrFail($id);
		return view('show', ['message' => $message]);
	}

	public function postShow(Request $request, $id) {
		$message = Message::findOrFail($id);
		$offset = $request->offset;
		$decrypted_message = $message->decrypt($offset);
		return response()->json($decrypted_message);
	}

}


