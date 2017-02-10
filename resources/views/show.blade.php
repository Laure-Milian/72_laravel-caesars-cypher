@extends('layout')

@section('content')

<h2>Le message à déchiffrer (id = <span id="id">{{$message->id}}</span>)</h2>
<div class="ui segment">
	{{$message->content}}
</div>

<form id="form" action="/show/{{$message->id}}" method="post">
 	<div class="field">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label for="offset">Quelle clef utiliser ?</label>
		<input id="offset" name="offset" type="number">
	</div>
	<div>
		<input id="btnDecrypt" class="ui yellow button" type="submit">
	</div>
</form>

<h2>Tadam</h2>
<div id="decrypted_message" class="ui segment"></div>

@endsection