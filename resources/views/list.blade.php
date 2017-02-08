@extends('layout')

@section('content')

<h1>Bienvenue sur notre messagerie top secrète</h1>

<h2>Tous les messages :</h2>

@foreach($messages as $message)
<div class="ui segment">
{{$message->content}}
<a href="/show/{{$message->id}}">Essayer de décripter ce message</a>
</div>
@endforeach

<a class="ui fluid blue button" href="/create">Envoyer un message</a>

@endsection