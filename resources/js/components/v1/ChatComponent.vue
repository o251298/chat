<template>
    <div class="col-lg-9 chat-data p-0 chat-data-right">
        <div class="tab-content">
            <div class="tab-pane fade active show">
                <div class="chat-head">
                    <header class="d-flex justify-content-between align-items-center bg-white pt-3  pl-3 pr-3 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-toggle">
                                <i class="ri-menu-3-line"></i>
                            </div>
                            <div class="avatar chat-user-profile m-0 mr-3">
                                <img :src="this.friend_icon.friend_icon" style="border-radius: 50%" class="avatar-50 ">
                                <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill text-success"></i></span>
                            </div>
                            <h5 class="mb-0">{{this.friend.name}}</h5>
                        </div>
                        <div class="chat-user-detail-popup scroller" >
                            <div class="user-profile text-center">
                                <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                                <div class="user mb-4">
                                    <a class="avatar m-0">
                                        <img src="images/user/06.jpg" alt="avatar">

                                    </a>
                                    <div class="user-name mt-4">
                                        <h4>Mark Jordan</h4>
                                    </div>
                                    <div class="user-desc">
                                        <p>Atlanta, USA</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="chatuser-detail text-left mt-4">
                                    <div class="row">
                                        <div class="col-6 col-md-6 title">Bni Name:</div>
                                        <div class="col-6 col-md-6 text-right">Mark</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-6 title">Tel:</div>
                                        <div class="col-6 col-md-6 text-right">072 143 9920</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-6 title">Date Of Birth:</div>
                                        <div class="col-6 col-md-6 text-right">July 12, 1989</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-6 title">Gender:</div>
                                        <div class="col-6 col-md-6 text-right">Female</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-6 title">Language:</div>
                                        <div class="col-6 col-md-6 text-right">Engliah</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-header-icons d-flex">
                            <a href="javascript:void();" class="chat-icon-phone">
                                <i class="ri-phone-line"></i>
                            </a>
                            <a href="javascript:void();" class="chat-icon-video">
                                <i class="ri-vidicon-line"></i>
                            </a>
                            <a href="javascript:void();" @click="deleteChat" class="chat-icon-delete">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                            <span class="dropdown">
                                                   <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></i>
                                                   <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton01">
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Pin to top</a>
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete chat</a>
                                                   <a class="dropdown-item" href="JavaScript:void(0);"><i class="fa fa-ban" aria-hidden="true"></i> Block</a>
                                                   </span>
                                                   </span>
                        </div>
                    </header>
                </div>
                <div class="chat-content scroller" @scroll="handleScroll">
                    <div style="overflow-y: scroll;" @scroll="handleScroll">
                        <div v-for="item in dataMessage">

                            <div class="chat" v-if="item.user === current_user.name">
                                <div class="chat-user"><a class="avatar m-0"><img :src="item.icon" style="border-radius: 50%" alt="avatar" class="avatar-35 "></a><span class="chat-time mt-1" :title="item.dateTitle">{{item.date}}</span></div>
                                <div class="chat-detail"><div class="chat-message">
                                    <p>{{item.message}}</p>
                                    <div v-if="item.post">
                                        <post-component :dataMessage="[item.post]"></post-component>
                                    </div>
                                    <p v-if="item.file_path">
                                        <img v-if="item.format == 'image'" :src="item.file_path" style="width: 100%;" alt="">
                                        <video v-if="item.format == 'video'" width="100%" height="100%" controls>
                                            <source :src="item.file_path" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </p>
                                    <p v-if="item.file_path" style="width: 250px">
                                        <figure v-if="item.format == 'audio'">
                                            <audio style="width: 100%"
                                                   controls
                                                   :src="item.file_path">
                                                Your browser does not support the
                                                <code>audio</code> element.
                                            </audio>
                                        </figure>
                                    </p>

                                </div></div>
                            </div>
                            <div class="chat chat-left" v-if="item.user === friend.name">
                                <div class="chat-user">
                                    <a class="avatar m-0">
                                        <img :src="item.icon" style="border-radius: 50%" class="avatar-35 ">
                                    </a>
                                    <span :title="item.dateTitle" class="chat-time mt-1">{{item.date}}</span>
                                </div>
                                <div class="chat-detail">
                                    <div class="chat-message">
                                        <p>{{item.message}}</p>
                                        <div v-if="item.post">
                                            <post-component :dataMessage="[item.post]"></post-component>
                                        </div>
                                        <p v-if="item.file_path">
                                            <img v-if="item.format == 'image'" :src="item.file_path" style="width: 100%;" alt="">
                                            <video v-if="item.format == 'video'" width="100%" height="100%" controls>
                                                <source :src="item.file_path" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </p>
                                        <p v-if="item.file_path" style="width: 250px">
                                            <figure v-if="item.format == 'audio'">
                                                <audio style="width: 100%"
                                                       controls
                                                       :src="item.file_path">
                                                    Your browser does not support the
                                                    <code>audio</code> element.
                                                </audio>
                                            </figure>
                                        </p>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div v-if="imagepreview">
                        <img :src="imagepreview" style="height: 50%; width: 50%; position: absolute" alt="">
                    </div>
                </div>
                <div class="chat-footer p-3 bg-white">
                    <form class="d-flex align-items-center"  action="javascript:void(0);" enctype="multipart/form-data">
                        <div class="chat-attagement d-flex">
                            <a href="javascript:void();"><i @click="emoji" class="fa fa-smile-o pr-3" aria-hidden="true"></i></a>
                            <a href="javascript:void();">
                                <label for="file-upload">
                                    <i class="fa fa-paperclip pr-3" aria-hidden="true"></i>
                                </label>
                                <input type="file" style="display: none" @change="imageSelected" id="file-upload">
                            </a>
                        </div>
                        <input type="text" v-model="message" class="form-control mr-3" placeholder="Type your message">

                        <button v-if="!is_send" @click="sendMessage" type="submit" class="btn btn-primary d-flex align-items-center p-2"><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Send</span></button>
                        <b-spinner v-if="is_send" type="grow" variant="primary"></b-spinner>
                    </form>

                </div>
                <div v-if="emoji_active" class="category-list" style="position: absolute">
                    <ul v-for="item in emojiArr">
                        <li @click="selectEmoji(item.value)" class="emoji-item" style="list-style: none; margin-bottom: -5px">{{item.value}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>







<script>
    import { BSpinner } from 'bootstrap-vue';
    export default {
        components: {
          BSpinner,
        },
        data: function(){
            return {
                dataMessage: [],
                dateNow: new Date(),
                message: "",
                image: null,
                imagepreview: null,
                tests: 0,
                url: 'http://localhost',
                port: '6003',
                is_send: false,
                path_image: null,
                is_read: 0,
                emoji_active: false,
                format: false,
                post: null,
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
            'friend',
            'friend_icon',
            'current_user',
            'current_user_icon',
            'messagesjson',
        ],
        mounted() {
          this.readMessage();
            console.log(this.dataMessage);
        },
        created() {
            var socket = io(this.url + ':' + this.port);
            socket.on("news-action." + this.current_user.id + ":App\\Events\\PrivateMessage", function (data) {
                //console.log(data.message.user);
                //
                ///storage/folder/audio/t-rex-roar.mp3
                ///storage/folder/audio/notify.mp3
                let audio = new Audio('../storage/folder/audio/notify.mp3');
                if(audio)
                {
                    audio.play();
                }

                console.log(data);
                if(data.message.post){
                    this.post = JSON.parse(data.message.post);
                } else {
                    this.post = null;
                }
                if (data.message.user === this.friend.email){
                    this.dataMessage.push({user: this.friend.name, message: data.message.message, icon: this.url + this.friend_icon.friend_icon, date: this.dateNow.toString().split(" ")[4], dateTitle: "today", file_path: data.message.file, format: data.message.format, post: this.post});
                    this.readMessage();
                }
            }.bind(this));
            console.log(this.messagesjson);
            this.getMessage(this.messagesjson, this.current_user, this.friend, this.dataMessage, this.current_user_icon, this.friend_icon, this.url);

        },
        methods: {
            sendMessage: function () {
                if (this.message == "" && this.path_image == null)
                {

                    this.$toaster.warning('Вы не ввели сообщение');
                    return false;
                }
                this.is_send = true;
                let arr = ['news-action.' + this.friend.id];

                console.log(arr);
                axios({
                    method: 'get',
                    url: '/private-chat',
                    params: {message: this.message, channels: arr, user: this.current_user.email, file: this.path_image, format: this.format}
                }).then((response) => {
                    console.log(response);
                    //this.dataMessage.push('You' + ': ' + this.message);
                    this.dataMessage.push({user: this.current_user.name, message: this.message, icon: this.current_user_icon.current_user_icon, date: this.dateNow.toString().split(" ")[4], dateTitle: "today", file_path: this.path_image, format: this.format});
                    this.message = '';
                    this.is_send = false;
                    this.imagepreview = null;
                    this.image = null;
                    this.path_image = null;
                    this.format = false;
                });
            },
            getMessage: function(messages, user, friend, data, userIcon, friendIcon, url){
                messages.forEach(function(item, i, arr){
                    if (item.sender_id == user.id){
                        data.push({user: user.name, message: item.text, icon: url + userIcon.current_user_icon, date: item.created_at.substr(item.created_at.indexOf(' '), item.created_at.length - 2), dateTitle: item.created_at, file_path:item.file, format: item.format, post: item.post});
                    } else {
                        data.push({user: friend.name, message: item.text, icon: url + friendIcon.friend_icon, date: item.created_at.substr(item.created_at.indexOf(' '), item.created_at.length - 2), dateTitle: item.created_at, file_path: item.file, format: item.format, post: item.post});
                    }
                });
            },
            handleScroll: function(e) {
                var currentScrollPosition = e.srcElement.scrollTop;
                this.is_read += 1;
                if (currentScrollPosition > this.scrollPosition) {
                    if (currentScrollPosition > 1 && this.is_read == 2)
                    {
                        this.readMessage();
                    }
                }
                this.scrollPosition = currentScrollPosition;
            },
            readMessage: function () {
                console.log('read all');
                axios({
                    method: 'post',
                    url: '/message/read',
                    params: {receiver_id: this.friend.id, sender_id: this.current_user.id}
                }).then((response) => {
                    console.log(response);
                });
            },
            emoji: function(event)
            {
                if (this.emoji_active){
                    this.emoji_active = false;
                    return;
                }
                this.emoji_active = true;
            },
            selectEmoji: function(event)
            {
                this.message = this.message + event;
            },
            imageSelected: function (e) {
                this.image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.image);
                reader.onload = e => {
                    this.imagepreview = e.target.result;
                };
                let data = new FormData;
                data.append('image', this.image);
                axios.post('/message/image', data).then((response) => {
                    console.log(response);
                    if (response.data.success)
                    {
                        this.path_image = response.data.success.path;
                        this.format = response.data.success.format;
                    } else {
                        alert(response.data.error);
                    }
                });
            },
            deleteChat: function () {
                axios({
                    method: 'post',
                    url: '/message/delete',
                    params: {friend: this.friend.id}
                }).then((response) => {
                    console.log(response);

                    if (response.data.success)
                    {
                        this.dataMessage = [];

                    } else {
                        alert(response.data.error);
                    }
                });
            }
        }
    }
</script>
<style>
    .oldMessage {
        color: #dcdcdc;
    }
    .user-avatar {
        border-radius: 50%;
    }
</style>
