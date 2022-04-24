<template>
    <div class="col-sm-12">
        <div v-for="item in dataMessage">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height" >
                <div class="iq-card-body">
                    <div class="user-post-data">
                        <div class="d-flex flex-wrap">
                            <div class="media-support-user-img mr-3">
                                <img class="rounded-circle img-fluid" :src="item.icon" alt="">
                                <img v-if="item.created_by" class="rounded-circle img-fluid" :src="item.created_by.icon" alt="">
                            </div>
                            <div class="media-support-info mt-2">
                                <h5 class="mb-0 d-inline-block"><a href="#" class="">{{item.user}}</a></h5>
                                <h5 v-if="item.created_by" class="mb-0 d-inline-block"><a href="#" class="">{{item.created_by.name}}</a></h5>
                                <p class="mb-0 d-inline-block">Add New Post</p>
                                <p class="mb-0 text-primary" style="font-weight: bold">Now</p>
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

                        <img v-if="item.type == 0" :src="item.picture" alt="" width="100%">
                        <div v-if="item.post">
                            <img v-if="item.post.file.type == 0" :src="item.post.file.url" alt="" width="100%">
                        </div>



                        <video v-if="item.type == 1" width="100%" height="100%" controls>
                            <source :src="item.picture" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div v-if="item.post">
                            <video v-if="item.post.file.type == 1" width="100%" height="100%" controls>
                                <source :src="item.post.file.url" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>


                        <figure v-if="item.type == 2">
                            <audio style="width: 100%"
                                   controls
                                   :src="item.picture">
                                Your browser does not support the
                                <code>audio</code> element.
                            </audio>
                        </figure>
                        <div v-if="item.post">
                            <figure v-if="item.post.file.type == 2">
                                <audio style="width: 100%"
                                       controls
                                       :src="item.post.file.url">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                            </figure>
                        </div>


                        <p style="font-weight: bold">{{item.text}}</p>
                        <p v-if="item.post" style="font-weight: bold">{{item.post.text}}</p>
                    </div>
                    <div class="comment-area mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                message: [],
                type: false
            }
        },
        props: [
            'dataMessage'
        ],
        methods: {

        },
        mounted() {
            console.log(this.dataMessage);
        },
        created() {
            console.log(this.dataMessage);
            //this.dataMessage;
        }
    }
</script>
