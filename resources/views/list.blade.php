@extends('layout')

@section('content')

<h1>Bienvenue sur notre messagerie top secrète</h1>

<h2>Tous les messages :</h2>

@foreach($messages as $message)
<div class="ui segment">
{{$message->content}}	
</div>
@endforeach

@endsection