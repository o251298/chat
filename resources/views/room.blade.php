@extends('layouts.app')
@section('content')
    <div class="row" style="background: #ffffff; height: 100vh; padding: 10px; border: 1px solid mistyrose">
        <div class="col col-lg-2">
            <ul style="list-style: none; margin-left: -20px">
                @foreach($users as $user)
                    <li style="padding: 5px">
                        <span style="background: #bfd1ec; padding: 5px; border-radius: 50px">OK</span>
                        <a class="users-list" href="{{route('room', [$user])}}">{{$user->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <div>

                <h2>{{$friend->name}} <span style="font-weight: normal;background: #bfd1ec; padding: 3px; border-radius: 50%; float: right">OK</span></h2>
            </div>

            <chat-user :friend="{{$friend}}" :current_user="{{$currentUser}}" :messagesjson="{{json_encode($messages)}}"></chat-user>
        </div>
    </div>
@endsection
