@extends('layout')

@section('content')

<h2>Le message à décrypter</h2>
<div class="ui segment">
	{{$message->content}}
</div>

<h2>Quelle clef utiliser ?</h2>
<form action="/decrypt/{{$message->id}}" method="post">
	<div class="field">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label for="offset"></label>
		<input id="offset" name="offset" type="number">
	</div>
	<div>
		<input id="btnDecrypt" class="ui yellow button" type="submit">
	</div>
</form>

<h2>Le message à déchiffrer</h2>
<div id="decrypted_message" class="ui segment"></div>

@endsection