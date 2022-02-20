<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-header">
            <h2>Socket Pie Chat</h2>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea readonly class="form-control" rows="6">{{dataMessage.join('\n')}}</textarea>
                </div>
                <div class="input-group mb-3">
                    <input placeholder="Введите смс" type="text" class="form-control" v-model="message">
                </div>
                <button @click="sendMessage" class="btn btn-dark" v-if="!is_send">Отправить</button>
                <span class="alert-warning" v-if="is_send">Updating</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                dataMessage: [],
                message: "",
                is_send: false,
            }
        },
        mounted() {
            var socket = io('http://localhost:6001');
            socket.on("news-action:App\\Events\\NewMessage", function (data) {
                this.dataMessage.push(data.message);
            }.bind(this));
            console.log('Component mounted.');
        },
        methods: {
            sendMessage: function () {
                this.is_send = true;
                axios({
                    method: 'get',
                    url: '/lessons/socket-chat',
                    params: {message: this.message}
                }).then((response) => {
                    console.log(response);
                    this.message = '';
                });
                this.is_send = false;
            }
        }
    }
</script>
