<template>
    <div>
        <div id="post-modal-data" class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Create Post</h4>
                        </div>
                    </div>
                    <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
                        <div class="d-flex align-items-center">
                            <div class="user-img">
                                <img :src="currentuser[1].icon" alt="userimg" class="avatar-60 rounded-circle">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                                        <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                        <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                                        <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
                                    </svg>
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
        <post-component :dataMessage="dataMessage"></post-component>
    </div>
</template>

<script>
    export default {

        data: function(){
            return {
                message: [],
                dataMessage: [],
                url: 'http://localhost',
                is_refresh: false,
                image: null,
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
          'currentuser'
        ],
        methods: {
            emoji: function(event)
            {
                if (this.emoji_active){
                    this.emoji_active = false;
                    return;
                }
                this.emoji_active = true;
                console.log(event);
            },
            selectEmoji: function(event)
            {
                this.message = this.message + event;
            },
            send: function(){
                let data = new FormData;
                data.append('image', this.image);
                data.append('message', this.message);
                axios.post('/post/create', data).then((response) => {
                    if(response.data.picture){
                        this.dataMessage.unshift({text: response.data.text, user: response.data.user.name, icon: this.url + response.data.user.icon, picture: this.url + response.data.picture});
                    } else {
                        this.dataMessage.unshift({text: response.data.text, user: response.data.user.name, icon: this.url + response.data.user.icon});
                    }
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
