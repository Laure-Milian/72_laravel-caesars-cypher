@extends('layout')

@section('content')

<h2>Le message à déchiffrer</h2>
<div class="ui segment">
	{{$message->content}}
</div>

<div id="id">{{$message->id}}</div>

<h2>Quelle clef utiliser ?</h2>
<!-- <form action="/show/{{$message->id}}" method="post"> -->
<form onsubmit = "return false">
	<div class="field">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label for="offset"></label>
		<input id="offset" name="offset" type="number">
	</div>
	<div>
		<input id="btnDecrypt" class="ui yellow button" type="submit">
	</div>
</form>

<h2>Tadam</h2>
<div id="decrypted_message" class="ui segment"></div>

@endsection