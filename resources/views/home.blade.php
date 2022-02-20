@extends('layouts.app')
@section('content')
{{--    <laravel-component></laravel-component>--}}
{{--    <line-component></line-component>--}}
{{--    <pie-component></pie-component>--}}
{{--<socket-chart></socket-chart>--}}
<private-chat :users="{{$users}}" :user="{{\Illuminate\Support\Facades\Auth::user()}}"></private-chat>
@endsection
