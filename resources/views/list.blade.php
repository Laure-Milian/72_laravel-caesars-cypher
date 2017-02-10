@extends('layout')

@section('content')

<h1>Bienvenue sur notre messagerie top secrète</h1>

<a class="ui blue button" href="/create">Créer un nouveau message secret</a>

<h2>Tous les messages :</h2>

@foreach($messages as $message)
<div class="ui segment">
{{$message->content}}
<a href="/show/{{$message->id}}">Essayer de déchiffrer ce message</a>
</div>
@endforeach

<a class="ui blue button" href="/create">Créer un nouveau message secret</a>

@endsection