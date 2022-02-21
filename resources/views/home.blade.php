@extends('layouts.app')
@section('content')
    <div class="container">
        <ul>
            @foreach($users as $user)
                <li><a href="{{route('room', [$user])}}">{{$user->name}}</a></li>
            @endforeach
        </ul>
    </div>
{{--    <laravel-component></laravel-component>--}}
{{--    <line-component></line-component>--}}
{{--    <pie-component></pie-component>--}}
{{--<socket-chart></socket-chart>--}}
{{--<private-chat :users="{{$users}}" :user="{{\Illuminate\Support\Facades\Auth::user()}}"  ></private-chat>--}}
@endsection
