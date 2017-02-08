<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getIndex() {
    	return 'coucou';
    }

    public function getCreate() {
    	return view('create');
    }
}
