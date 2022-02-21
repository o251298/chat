@extends('layouts.app')
@section('content')
    <div class="container">
        AUTH: {{$currentUser->name}}
        <h2>Room with {{$friend->name}}</h2>
    </div>
    <chat-user :friend="{{$friend}}" :current_user="{{$currentUser}}" :messagesjson="{{json_encode($messages)}}"></chat-user>
@endsection
