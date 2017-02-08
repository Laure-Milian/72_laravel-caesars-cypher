@extends('layout')

@section('content')

<h1>Ecrivez votre message et choisissez le chiffrement</h1>

<div>
	<form class="ui reply form" action="create" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="field">
			<label for="message">Votre message :</label>
			<textarea id="message" name="message"></textarea>
		</div>
		<div class="field">
			<label for="offset">Clef de chiffrement :</label>
			<input id="offset" name="offset" type="number">
		</div>
		<div>
			<button class="ui blue labeled submit icon button"><i class="icon edit"></i> Add Reply </button>
		</div>
	</form>
</div>

@endsection