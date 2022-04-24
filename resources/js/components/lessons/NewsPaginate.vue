<template>
    <div class="col-lg-8 row m-0 p-0">
        <div v-if="this.current_user.id == this.user.id" class="col-sm-12">
            <div id="post-modal-data" class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Create Post</h4>
                    </div>
                </div>
                <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
                    <div class="d-flex align-items-center">
                        <div class="user-img">
                            <img :src="this.current_user.icon" alt="userimg" class="avatar-60 rounded-circle">
                        </div>
                        <div class="post-text ml-3 w-100">
                            <form @submit="send" action="javascript:void(0);" enctype="multipart/form-data">
                                <input type="text" name="text" v-model="message" id="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                                <div v-if="imagepreview">
                                    <img :src="imagepreview" style="height: 30%; width: 30%" alt="">
                                </div>
                                <label for="file-upload" class="custom-file-upload" style="font-size: 21px">
                                    <i class="ri-camera-line mr-3" style="cursor: pointer"></i>
                                    <a href="javascript:void();" style="color: black"><i @click="emoji" class="ri-user-smile-line mr-3"></i></a>
                                </label>
                                <input type="file" style="display: none;" @change="imageSelected" id="file-upload">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="emoji_active" class="category-list">
                <ul v-for="item in emojiArr">
                    <li @click="selectEmoji(item.value)" class="emoji-item" style="list-style: none; margin-bottom: -5px">{{item.value}}</li>
                </ul>
            </div>
        </div>
            <div class="col-sm-12" v-for="item in posts">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="user-post-data">
                            <div class="d-flex flex-wrap">
                                <div class="media-support-user-img mr-3">
                                    <img class="rounded-circle img-fluid" :src="item.created_by.icon" alt="">
                                </div>
                                <div class="media-support-info mt-2">
                                    <h5 class="mb-0 d-inline-block"><a href="#" class="">{{item.created_by.name}}</a></h5>
                                    <p class="mb-0 d-inline-block">Add New Post</p>
                                    <p class="mb-0 text-primary">{{item.post.created_at}}</p>
                                </div>

                                <div class="iq-card-post-toolbar">
                                    <div class="dropdown">
                                          <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                        <div class="dropdown-menu m-0 p-0">
                                            <!-- -->
                                            <div class="d-flex align-items-top">
                                                <b-button v-b-modal="'modal-' + item.post.id">
                                                    <div class="icon font-size-20"><i class="ri-save-line"></i></div>
                                                    <div class="data ml-2">
                                                        <h6>Save Post</h6>
                                                    </div>
                                                </b-button>
                                                <b-modal :id="'modal-' + item.post.id" centered hide-backdrop content-class="shadow" hide-footer title="Поделится">
                                                    <modal-component :post="item"></modal-component>
                                                </b-modal>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div v-if="item.post.file != null">
                                <img v-if="item.post.file.type == 0" :src="item.post.file.url" alt="post-image" class="img-fluid rounded w-100">

                                <video v-if="item.post.file.type == 1" width="100%" height="100%" controls>
                                    <source :src="item.post.file.url" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>


                                <figure v-if="item.post.file.type == 2">
                                    <audio style="width: 100%"
                                           controls
                                           :src="item.post.file.url">
                                        Your browser does not support the
                                        <code>audio</code> element.
                                    </audio>
                                </figure>
                            </div>
                            <p>{{item.post.text}}</p>
                        </div>
                        <div class="user-post">

                        </div>
                        <div class="comment-area mt-3">
                            <like-component :post="item.post"></like-component>
                            <hr>
                            <create-comment :post_id="item.post.id" :currentuser="current_user"></create-comment>
                            <ul class="post-comments p-0 m-0" v-if="item.comments">
                                <li class="mb-2" v-if="index < (item.comments.length + 1)" v-for="index in commentToShow">
                                    <div class="d-flex flex-wrap">
                                        <div class="user-img">
                                            <img :src="item.comments[index - 1].user_create.icon" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                        </div>
                                        <div class="comment-data-block ml-3">
                                            <h6>{{item.comments[index - 1].user_create.name}}</h6>
                                            <p class="mb-0">{{item.comments[index - 1].text}}</p>
                                            <div class="d-flex flex-wrap align-items-center comment-activity"> Share
                                                <span> 5 min </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <div v-if="commentToShow <= (item.comments.length + 1) || (item.comments.length + 1) >= commentToShow">
                                    <button @click="showMores" class="btn btn-outline-dark">show more</button>
                                </div>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        <div>
            <b-spinner v-if="load" type="grow" variant="primary"></b-spinner>
            <button v-if="btn" @click="showMore" class="btn btn-outline-dark">show more reviews</button>
        </div>
    </div>
</template>

<script>
    import { BSpinner, BModal, BButton, VBModal } from 'bootstrap-vue';
    export default {
        components: {
            BSpinner,
            BModal,
            BButton,
        },
        directives: {
            'b-modal': VBModal
        },
        data: function(){
            return {
                posts: [],
                currentPage: 1,
                btn: true,
                load: false,
                isInfoPopup: false,
                message: [],
                selectPost: false,
                url_load: '',
                url: 'http://localhost',
                is_refresh: false,
                image: null,
                commentToShow: 3,
                imagepreview: null,
                emoji_active: false,
                emojiArr: [
                    {
                        key: "😄", value: "😄"
                    },
                    {
                        key: "🔥🔥🔥🔥😍🔥🔥", value: "😍"
                    },
                    {
                        key: "🔥🔥🔥🔥😎", value: "😎"
                    },
                    {
                        key: "🔥🔥🔥🔥😷", value: "😷"
                    },
                    {
                        key: "🔥🔥🔥🔥😘", value: "😘"
                    },
                    {
                        key: "🔥🔥🔥🔥😈", value: "😈"
                    },
                    {
                        key: "🔥🔥🔥🔥😁", value: "😁"
                    },
                    {
                        key: "🔥🔥🔥🔥😚", value: "😚"
                    },
                    {
                        key: "🔥🔥🔥🔥😋", value: "😋"
                    },
                    {
                        key: "😏", value: "😏"
                    },
                ],
            }
        },
        props: [
            'current_user',
            'user',
            'url_request',
        ],
        mounted() {
            if ((this.current_user.id != this.user.id) || (this.url_request.url == '/news/user'))
            {
                this.url_load = this.url_request.url + '/' + this.user.id +  '?page=';
            } else {
                this.url_load = this.url_request.url + '?page=';
            }
            console.log(this.current_user);
            axios({
                method: 'get',
                url: this.url_load + this.currentPage,
            }).then((response) => {
                response.data.data.forEach((value, index) => {
                    this.posts.push(value);
                });
            });
        },
        methods: {
            showMore: function () {
                this.load = true;
                this.currentPage += 1;
                axios({
                    method: 'get',
                    url: this.url_load + this.currentPage,
                }).then((response) => {
                    if(response.data.data.length < 1) {
                        this.btn = false;
                        this.load = false;
                    }
                    response.data.data.forEach((value, index) => {
                        this.posts.push(value);
                        this.load = false;
                    });
                });
            },
            emoji: function(event){
                if (this.emoji_active){
                    this.emoji_active = false;
                    return;
                }
                this.emoji_active = true;
            },
            selectEmoji: function(event){
                this.message = this.message + event;
            },
            send: function(){
                let data = new FormData;
                data.append('image', this.image);
                data.append('message', this.message);
                axios.post('/post/create', data).then((response) => {
                    this.getNews();


                    // if(response.data.picture){
                    //     this.posts.unshift({post: {text: response.data.text, id: response.data.id,  file: {type: response.data.file_type, url: this.url + response.data.picture}}, created_by: {name: response.data.user.name, icon: this.url + response.data.user.icon} });
                    // } else {
                    //     this.posts.unshift({post: {text: response.data.text, id: response.data.id}, created_by: {name: response.data.user.name, icon: this.url + response.data.user.icon}});
                    //     //this.posts.sort();
                    // }

                });
                this.message = '';
                this.imagepreview = null;
                this.image = null;
                this.emoji_active = false;
            },
            imageSelected: function (e) {
                this.image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.image);
                reader.onload = e => {
                    this.imagepreview = e.target.result;
                };
            },
            showMores: function () {
                this.commentToShow = this.commentToShow + 3;
            },
            getNews: function () {
                this.posts = [];
                axios({
                    method: 'get',
                    url: this.url_load + this.currentPage,
                }).then((response) => {

                    if(response.data.data.length < 1) {
                        this.btn = false;
                        this.load = false;
                    }
                    response.data.data.forEach((value, index) => {
                        this.posts.push(value);
                        this.load = false;
                    });
                });
            },
            showPopupInfo: function (e) {
                console.log(e);
                this.selectPost = e;
                this.isInfoPopup = true;
            },
            closePopupInfo: function()
            {
                this.isInfoPopup = false;
            }
        }
    }
</script>
<style>
    .emoji-item {
        page-break-inside: avoid;
        break-inside: avoid;
        margin-left: -20px;
        margin-right: 25px;
    }
    .emoji-item:hover {
        cursor: pointer;
    }
    .category-list {
        list-style: none;
        column-count: 3;
        background: white;
        margin-bottom: 20px;
        margin-left: 8px;
    }
</style>
