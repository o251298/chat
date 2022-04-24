@section('title', 'Новости')
@extends('v1.layouts.main')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <news-paginate :current_user="{{$current_user}}" :user="{{$user}}" :url_request="{{$url_request}}"></news-paginate>
            </div>
        </div>
    </div>
@endsection
