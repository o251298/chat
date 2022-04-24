<template>
<div>
    <form class="comment-text d-flex align-items-center mt-3" @submit="send" action="javascript:void(0);">
        <input type="text" class="form-control rounded" v-model="comment" placeholder="Enter comment ...">
        <div class="comment-attagement d-flex">
            <a href="javascript:void();"><i @click="emoji" class="ri-user-smile-line mr-3"></i></a>
        </div>

    </form>
    <comment-component :dataComment="dataComment"></comment-component>
    <div v-if="emoji_active" class="category-list" style="position: absolute">
        <ul v-for="item in emojiArr">
            <li @click="selectEmoji(item.value)" class="emoji-item" style="list-style: none; margin-bottom: -5px">{{item.value}}</li>
        </ul>
    </div>
</div>
</template>

<script>
    export default {
        name: "CreateComment",
        data: function () {
            return {
                comment : [],
                url: 'http://localhost',
                port: '6003',
                dataComment : [],
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
            "post_id",
            "currentuser"
        ],
        mounted() {
            console.log(this.currentuser);
        },
        created() {
            console.log(this.post_id);
            console.log(this.currentuser.name);
            var sockets = io(this.url + ':' + this.port);
            sockets.on("news-comment." + this.post_id + ":App\\Events\\NewComment", function (data) {
                this.dataComment.unshift({user: data.message.user_name, icon: data.message.user_icon, comment: data.message.text});
            }.bind(this));
            console.log('Component mounted.');
        },

        methods: {
            send: function () {

                //this.dataComment.unshift({user: this.currentuser[0].user.name, icon: this.currentuser[1].icon, comment: this.comment});
                let data = new FormData;
                let arr = ['news-comment.' + this.post_id];
                data.append('post_id', this.post_id);
                data.append('text', this.comment);
                data.append('user_name', this.currentuser.name);
                data.append('user_icon', this.currentuser.icon);
                data.append('user_id', this.currentuser.id);
                data.append('channel', arr);
                axios.post('/comment/store', data).then((response) => {
                });
                this.comment = '';
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
                this.comment = this.comment + event;
            },
        }
    }
</script>

<style scoped>

</style>
