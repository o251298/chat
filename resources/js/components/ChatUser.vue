<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="overflow-y: scroll; height: 400px">
                                <div class="friend-message" style="background: red; float: left; padding: 10px; margin-bottom: 5px" v-for="item in dataMessage">{{item}}</div>
                            </div>
                        </div>
                    </div>
<!--                    <textarea readonly class="form-control" rows="30">{{dataMessage.join('\n')}}</textarea>-->
                </div>
                <div class="input-group mb-3">
                    <input placeholder="Введите смс" type="text" class="form-control" v-model="message">
                </div>
                <button @click="sendMessage" class="btn btn-dark" v-if="!is_send">Отправить</button>
                <b-spinner v-if="is_send" type="grow" variant="primary"></b-spinner>
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
                message: "",
                is_send: false,
            }
        },
        props: [
            'friend',
            'current_user',
            'messagesjson',
        ],
        created() {
            var socket = io('http://localhost:6003');
            socket.on("news-action." + this.current_user.id + ":App\\Events\\PrivateMessage", function (data) {
                console.log(data.message.user);
                if (data.message.user === this.friend.email){
                    this.dataMessage.push(data.message.user + ': ' + data.message.message)
                } else {
                    this.$toaster.success('new message from: ' + data.message.user);
                }
            }.bind(this));
            //console.log('Component asdmounted.');
            this.getMessage(this.messagesjson, this.current_user, this.friend, this.dataMessage);
        },
        methods: {
            sendMessage: function () {
                this.is_send = true;
                let arr = ['news-action.' + this.friend.id];

                console.log(arr);
                axios({
                    method: 'get',
                    url: '/private-chat',
                    params: {message: this.message, channels: arr, user: this.current_user.email}
                }).then((response) => {
                    console.log(response);
                    this.dataMessage.push('You' + ': ' + this.message);
                    this.message = '';
                    this.is_send = false;
                });
            },
            getMessage: function(messages, user, friend, data){
                messages.forEach(function(item, i, arr){
                    if (item.sender_id == user.id){
                        data.push('You: ' + item.text);
                    } else {
                        data.push(friend.name + ': ' + item.text);
                    }
                });
            }
        }
    }
</script>
