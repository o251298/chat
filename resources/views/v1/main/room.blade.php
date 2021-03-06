@section('title', 'Чат с ' . $friend->name)
@extends('v1.layouts.main')
@section('content')
<div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-body chat-page p-0">
                        <div class="chat-data-block">
                            <div class="row">

                                <!-- -->
                                <div class="col-lg-3 chat-data-left scroller">
                                    <div class="chat-search pt-3 pl-3">
                                        <div class="d-flex align-items-center">
                                            <div class="chat-profile mr-3">
                                                <img src="{{$currentUser->getIcon()}}" style="border-radius: 50%" class="avatar-60 ">
                                            </div>
                                            <div class="chat-caption">
                                                <h5 class="mb-0">{{$currentUser->name}}</h5>
                                            </div>
                                            <button type="submit" class="close-btn-res p-3"><i class="ri-close-fill"></i></button>
                                        </div>
                                        <div id="user-detail-popup" class="scroller">
                                            <div class="user-profile">
                                                <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                                                <div class="user text-center mb-4">
                                                    <a class="avatar m-0">
                                                        <img src="images/user/1.jpg" alt="avatar">
                                                    </a>
                                                    <div class="user-name mt-4">
                                                        <h4>Bni Jordan</h4>
                                                    </div>
                                                    <div class="user-desc">
                                                        <p>Web Designer</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="user-detail text-left mt-4 pl-4 pr-4">
                                                    <h5 class="mt-4 mb-4">About</h5>
                                                    <p>It is long established fact that a reader will be distracted bt the reddable.</p>
                                                    <h5 class="mt-3 mb-3">Status</h5>
                                                    <ul class="user-status p-0">
                                                        <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-success pr-1"></i><span>Online</span></li>
                                                        <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-warning pr-1"></i><span>Away</span></li>
                                                        <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-danger pr-1"></i><span>Do Not Disturb</span></li>
                                                        <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-light pr-1"></i><span>Offline</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-searchbar mt-4">
                                            <div class="form-group chat-search-data m-0">
                                                <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                                <i class="ri-search-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-sidebar-channel scroller mt-4 pl-3">
                                        <h5 class="mt-3">Direct Message</h5>
                                        <ul class="iq-chat-ui nav flex-column nav-pills">
                                            <!-- users -->
                                            @foreach($users as $item)
                                                @if(\App\Models\User::isFriend($item->id))
                                                    <li>
                                                        <a  href="{{route('chat.room', [$item])}}">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar mr-2">
                                                                    <img src="{{$item->getIcon()}}" style="border-radius: 50%" class="avatar-50 ">
                                                                    <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill text-dark"></i></span>
                                                                </div>
                                                                <div class="chat-sidebar-name">
                                                                    <h6 class="mb-0">{{$item->name}}</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endif
                                        @endforeach
                                            <!-- endusers -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- -->

                                <!-- !!!!!!!!!!!! -->
                                <chat-component :friend="{{$friend}}" :friend_icon="{{json_encode(['friend_icon' => $friend->getIcon()])}}" :current_user_icon="{{json_encode(['current_user_icon' => $currentUser->getIcon()])}}" :current_user="{{$currentUser}}" :messagesjson="{{json_encode($messages)}}"></chat-component>
                                <!-- !!!!!!!!!!!! -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
