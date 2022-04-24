@section('title', 'Новости')
@extends('v1.layouts.main')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container">
            <captcha-component></captcha-component>
            <div class="row">
                    <create-post :currentuser="{{json_encode([['user' => $currentUser], ['icon' =>  'http://localhost' . $currentUser->getIcon()]])}}"></create-post>
                <div class="col-lg-8 row m-0 p-0">
                    @foreach($posts as $item)
                        <div class="col-sm-12">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                                <div class="iq-card-body">
                                    <div class="user-post-data">
                                        <div class="d-flex flex-wrap">
                                            <div class="media-support-user-img mr-3">
                                                <img class="rounded-circle img-fluid" src="{{$item->user()->first()->getIcon()}}" alt="">
                                            </div>
                                            <div class="media-support-info mt-2">
                                                <h5 class="mb-0 d-inline-block"><a href="#" class="">{{$item->user()->first()['name']}}</a></h5>
                                                <p class="mb-0 d-inline-block">Add New Post</p>
                                                <p class="mb-0 text-primary">{{$item->created_at}}</p>
                                            </div>
                                            <div class="iq-card-post-toolbar">
                                                <div class="dropdown">
                                          <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                                    <div class="dropdown-menu m-0 p-0">
                                                        <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                                <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                                <div class="data ml-2">
                                                                    <h6>Save Post</h6>
                                                                    <p class="mb-0">Add this to your saved items</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                                <div class="icon font-size-20"><i class="ri-close-circle-line"></i></div>
                                                                <div class="data ml-2">
                                                                    <h6>Hide Post</h6>
                                                                    <p class="mb-0">See fewer posts like this.</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                                <div class="icon font-size-20"><i class="ri-user-unfollow-line"></i></div>
                                                                <div class="data ml-2">
                                                                    <h6>Unfollow User</h6>
                                                                    <p class="mb-0">Stop seeing posts but stay friends.</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item p-3" href="#">
                                                            <div class="d-flex align-items-top">
                                                                <div class="icon font-size-20"><i class="ri-notification-line"></i></div>
                                                                <div class="data ml-2">
                                                                    <h6>Notifications</h6>
                                                                    <p class="mb-0">Turn on notifications for this post</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @if($item->picture()->first())
                                            @if(($item->picture()->first()->getType() == 'image'))
                                                <img src="{{$item->picture()->first()['url']}}" style="width: 100%" alt="">
                                            @endif
                                                @if(($item->picture()->first()->getType() == 'video'))
                                                    <video width="100%" height="100%" controls>
                                                        <source src="{{$item->picture()->first()['url']}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                                @if(($item->picture()->first()->getType() == 'audio'))
                                                    <figure>
                                                        <audio style="width: 100%"
                                                            controls
                                                            src="{{$item->picture()->first()['url']}}">
                                                            Your browser does not support the
                                                            <code>audio</code> element.
                                                        </audio>
                                                    </figure>
                                                @endif
                                        @endif
                                        <p>{{$item->text}}</p>
                                    </div>
                                    <div class="comment-area mt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="like-data">
                                                        <div class="dropdown">
                                                            <form action="#" method="post">
                                                                <button class="dropdown-toggle btn_post" style="background: none; border: none; border-radius: 50%" type="button" value="{{$item->id}}">
                                                                    <img src="/template/images/icon/01.png" class="img-fluid" alt="">
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="total-like-block ml-2 mr-3">
                                                        <div class="dropdown">
                                                <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" id="mark_{{$item->id}}">
                                                    {{$item->countLike()}} Likes
                                                </span>
{{--                                                            <div class="dropdown-menu">--}}
{{--                                                                <a class="dropdown-item" href="#">Max Emum</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Bill Yerds</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Hap E. Birthday</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Tara Misu</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Midge Itz</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Sal Vidge</a>--}}
{{--                                                                <a class="dropdown-item" href="#">Other</a>--}}
{{--                                                            </div>--}}
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="total-comment-block">--}}
{{--                                                    <div class="dropdown">--}}
{{--                                             <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">--}}
{{--                                             20 Comment--}}
{{--                                             </span>--}}
{{--                                                        <div class="dropdown-menu">--}}
{{--                                                            <a class="dropdown-item" href="#">Max Emum</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Bill Yerds</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Hap E. Birthday</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Tara Misu</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Midge Itz</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Sal Vidge</a>--}}
{{--                                                            <a class="dropdown-item" href="#">Other</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
{{--                                            <div class="share-block d-flex align-items-center feather-icon mr-3">--}}
{{--                                                <a href="javascript:void();"><i class="ri-share-line"></i>--}}
{{--                                                    <span class="ml-1">99 Share</span></a>--}}
{{--                                            </div>--}}
                                        </div>
                                        <create-comment :post_id="{{$item->id}}" :currentuser="{{json_encode([['user' => $currentUser], ['icon' =>  'http://localhost' . $currentUser->getIcon()]])}}"></create-comment>
                                        <ul class="post-comments p-0 m-0">
                                            @if(count($item->comments()->get()) > 0)
                                                @foreach($item->comments()->get() as $comment)
                                            <li>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-img">
                                                        <img src="{{$comment->user()->first()->getIcon()}}" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                                    </div>
                                                    <div class="comment-data-block ml-3">
                                                        <h6>{{$comment->user()->first()['name']}}</h6>
                                                        <p class="mb-0">{{$comment->text}}</p>
                                                        <div class="d-flex flex-wrap align-items-center comment-activity">
{{--                                                            <a href="javascript:void();">like</a>--}}
{{--                                                            <a href="javascript:void();">reply</a>--}}
                                                            <a href="javascript:void();">translate</a>
                                                            <span>{{$comment->created_at}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                                @endforeach
                                                @endif
                                        </ul>
{{--                                        <form class="comment-text d-flex align-items-center mt-3" action="javascript:void(0);">--}}
{{--                                            <input type="text" class="form-control rounded">--}}
{{--                                            <div class="comment-attagement d-flex">--}}
{{--                                                <a href="javascript:void();"><i class="ri-link mr-3"></i></a>--}}
{{--                                                <a href="javascript:void();"><i class="ri-user-smile-line mr-3"></i></a>--}}
{{--                                                <a href="javascript:void();"><i class="ri-camera-line mr-3"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        {{$posts->links()}}
                </div>


                </div>
                <div class="col-lg-4">
{{--                    <div class="iq-card">--}}
{{--                        <div class="iq-card-header d-flex justify-content-between">--}}
{{--                            <div class="iq-header-title">--}}
{{--                                <h4 class="card-title">Stories</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="iq-card-body">--}}
{{--                            <ul class="media-story m-0 p-0">--}}
{{--                                <li class="d-flex mb-4 align-items-center">--}}
{{--                                    <i class="ri-add-line font-size-18"></i>--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Creat Your Story</h5>--}}
{{--                                        <p class="mb-0">time to story</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="d-flex mb-4 align-items-center active">--}}
{{--                                    <img src="images/page-img/s2.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Anna Mull</h5>--}}
{{--                                        <p class="mb-0">1 hour ago</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="d-flex mb-4 align-items-center">--}}
{{--                                    <img src="images/page-img/s3.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Ira Membrit</h5>--}}
{{--                                        <p class="mb-0">4 hour ago</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="d-flex align-items-center">--}}
{{--                                    <img src="images/page-img/s1.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Bob Frapples</h5>--}}
{{--                                        <p class="mb-0">9 hour ago</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a href="#" class="btn btn-primary d-block mt-3">See All</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="iq-card">--}}
{{--                        <div class="iq-card-header d-flex justify-content-between">--}}
{{--                            <div class="iq-header-title">--}}
{{--                                <h4 class="card-title">Events</h4>--}}
{{--                            </div>--}}
{{--                            <div class="iq-card-header-toolbar d-flex align-items-center">--}}
{{--                                <div class="dropdown">--}}
{{--                                 <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" role="button">--}}
{{--                                 <i class="ri-more-fill"></i>--}}
{{--                                 </span>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="iq-card-body">--}}
{{--                            <ul class="media-story m-0 p-0">--}}
{{--                                <li class="d-flex mb-4 align-items-center ">--}}
{{--                                    <img src="images/page-img/s4.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Web Workshop</h5>--}}
{{--                                        <p class="mb-0">1 hour ago</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="d-flex align-items-center">--}}
{{--                                    <img src="images/page-img/s5.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Fun Events and Festivals</h5>--}}
{{--                                        <p class="mb-0">1 hour ago</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="iq-card">--}}
{{--                        <div class="iq-card-header d-flex justify-content-between">--}}
{{--                            <div class="iq-header-title">--}}
{{--                                <h4 class="card-title">Upcoming Birthday</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="iq-card-body">--}}
{{--                            <ul class="media-story m-0 p-0">--}}
{{--                                <li class="d-flex mb-4 align-items-center">--}}
{{--                                    <img src="images/user/01.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Anna Sthesia</h5>--}}
{{--                                        <p class="mb-0">Today</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="d-flex align-items-center">--}}
{{--                                    <img src="images/user/02.jpg" alt="story-img" class="rounded-circle img-fluid">--}}
{{--                                    <div class="stories-data ml-3">--}}
{{--                                        <h5>Paul Molive</h5>--}}
{{--                                        <p class="mb-0">Tomorrow</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="iq-card">--}}
{{--                        <div class="iq-card-header d-flex justify-content-between">--}}
{{--                            <div class="iq-header-title">--}}
{{--                                <h4 class="card-title">Suggested Pages</h4>--}}
{{--                            </div>--}}
{{--                            <div class="iq-card-header-toolbar d-flex align-items-center">--}}
{{--                                <div class="dropdown">--}}
{{--                                 <span class="dropdown-toggle" id="dropdownMenuButton01" data-toggle="dropdown" aria-expanded="false" role="button">--}}
{{--                                 <i class="ri-more-fill"></i>--}}
{{--                                 </span>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01" style="">--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>--}}
{{--                                        <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="iq-card-body">--}}
{{--                            <ul class="suggested-page-story m-0 p-0 list-inline">--}}
{{--                                <li class="mb-3">--}}
{{--                                    <div class="d-flex align-items-center mb-3">--}}
{{--                                        <img src="images/page-img/42.png" alt="story-img" class="rounded-circle img-fluid avatar-50">--}}
{{--                                        <div class="stories-data ml-3">--}}
{{--                                            <h5>Iqonic Studio</h5>--}}
{{--                                            <p class="mb-0">Lorem Ipsum</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <img src="images/small/img-1.jpg" class="img-fluid rounded" alt="Responsive image">--}}
{{--                                    <div class="mt-3"><a href="#" class="btn d-block"><i class="ri-thumb-up-line mr-2"></i> Like Page</a></div>--}}
{{--                                </li>--}}
{{--                                <li class="">--}}
{{--                                    <div class="d-flex align-items-center mb-3">--}}
{{--                                        <img src="images/page-img/42.png" alt="story-img" class="rounded-circle img-fluid avatar-50">--}}
{{--                                        <div class="stories-data ml-3">--}}
{{--                                            <h5>Cakes & Bakes </h5>--}}
{{--                                            <p class="mb-0">Lorem Ipsum</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <img src="images/small/img-2.jpg" class="img-fluid rounded" alt="Responsive image">--}}
{{--                                    <div class="mt-3"><a href="#" class="btn d-block"><i class="ri-thumb-up-line mr-2"></i> Like Page</a></div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col-sm-12 text-center">

                </div>
            </div>
        </div>
    </div>
@endsection
