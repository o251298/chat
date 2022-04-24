@section('title', 'Друзі')
@extends('v1.layouts.main')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Друзі</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="request-list m-0 p-0">
                                @foreach($users as $item)
                                    <li class="d-flex align-items-center">
                                        <div class="user-img img-fluid"><img src="{{$item->getIcon()}}" alt="story-img" class="rounded-circle avatar-40"></div>
                                        <div class="media-support-info ml-3">
                                            <h6><a href="{{route('profile', [$item->id])}}">{{$item->name}}</a></h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            @if($item->checkSubscribers())
                                                <button type="submit" value="{{$item->id}}" id="btn_d_{{$item->id}}" class="btn btn-primary btn-describe">UnFollowing</button>
                                            @else
                                                <button type="submit" value="{{$item->id}}" id="btn_s_{{$item->id}}" class="btn btn-primary btn-subscribe"><i class="ri-user-add-line"></i>Following</button>
                                                <button type="submit" value="{{$item->id}}" style="display: none" id="btn_d_{{$item->id}}" class="btn btn-primary btn-describe">UnFollowing</button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
