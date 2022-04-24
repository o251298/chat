@extends('layouts.app')
@section('content')
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col col-3">--}}
{{--                <ul>--}}
{{--                    @foreach($users as $user)--}}
{{--                        <li><a href="{{route('room', [$user])}}">{{$user->name}}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-md-auto">--}}
{{--                Variable width content--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--    <laravel-component></laravel-component>--}}
{{--    <line-component></line-component>--}}
{{--    <pie-component></pie-component>--}}
{{--<socket-chart></socket-chart>--}}
{{--<private-chat :users="{{$users}}" :user="{{\Illuminate\Support\Facades\Auth::user()}}"  ></private-chat>--}}
<div class="card">
    <div class="card-body">
        <div class="row" style="overflow-y: scroll; height: 400px">
            <div class="friend-message" style="background: red; float: left; padding: 10px; margin-bottom: 5px">asdas</div>
        </div>
    </div>
</div>
@endsection
