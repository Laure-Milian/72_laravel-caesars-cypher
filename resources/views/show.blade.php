@extends('layout')

@section('content')

<h2>Le message à décrypter</h2>
<div class="ui segment">
	{{$message->content}}
</div>

<h2>Quelle clef utiliser ?</h2>
<form action="">
	<div class="field">
	<label for="offset"></label>
	<input id="offset" name="offset" type="number">
	</div>
	<div>
		<input class="ui yellow button" type="submit">
	</div>
</form>
@endsection