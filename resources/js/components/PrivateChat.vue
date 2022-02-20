<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-header">
            <h2>Приватный чат со всеми пользователями</h2>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <select multiple class="form-control" v-model="usersSelect">
                        <option v-for="item in users" :value="'news-action.' + item.id">{{item.name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea readonly class="form-control" rows="6">
                        {{dataMessage.join('\n')}}
                    </textarea>
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
          BSpinner
        },
        data: function(){
            return {
                dataMessage: [],
                message: "",
                is_send: false,
                usersSelect: [],
            }
        },
        props: [
            'users',
            'user'
        ],
        created() {
            var socket = io('http://localhost:6001');
            socket.on("news-action." + this.user.id + ":App\\Events\\PrivateMessage", function (data) {
                this.dataMessage.push(data.message.user + ': ' + data.message.message)
            }.bind(this));
            console.log('Component mounted.');
        },
        methods: {
            sendMessage: function () {
                this.is_send = true;
                axios({
                    method: 'get',
                    url: '/lessons/private-chat',
                    params: {message: this.message, channels: this.usersSelect, user: this.user.email}
                }).then((response) => {
                    console.log(response);
                    this.dataMessage.push(this.user.name + ': ' + this.message);
                    this.message = '';
                    this.is_send = false;
                });
            }
        }
    }
</script>
