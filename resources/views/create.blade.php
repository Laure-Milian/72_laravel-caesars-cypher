@extends('layout')

@section('content')

<h1>Ecrivez votre message et choisissez le chiffrement</h1>

<div>
	<form class="ui reply form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="field">
			<label for="message">Votre message :</label>
			<textarea id="message" name="message"></textarea>
		</div>
		<div class="field">
			<label for="message">Clef de chiffrement :</label>
			<input type="number">
		</div>
		<div class="ui blue labeled submit icon button">
			<i class="icon edit"></i> Add Reply
		</div>
	</form>
</div>

@endsection