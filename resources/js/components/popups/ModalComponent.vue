<template>
    <div>
        <b-spinner v-if="is_send" variant="success" label="Spinning"></b-spinner>
        <b-alert v-if="success" show variant="success">Отправлено</b-alert>
        <ul v-if="result.length > 0" class="request-list m-0 p-0" id="result-search">
            <li class="d-flex align-items-center result-user" v-for="item in result">
                <div class="user-img img-fluid"><img :src="item.icon" alt="story-img" class="rounded-circle avatar-40"></div>
                <div class="media-support-info ml-3">
                    <h6><a :href="'../profile/' + item.id">{{item.name}}</a></h6>
                </div>
                <div class="d-flex align-items-center">
                    <button v-if="!is_show" type="submit" @click="sendMessage(item.id)" class="btn btn-primary btn-describe">Поделиться</button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { BSpinner, BAlert } from 'bootstrap-vue';
    export default {
        components: {
            BSpinner,
            BAlert,
        },
        name: "ModalComponent",
        props: [
            'post'
        ],
        data: function()
        {
            return {
                result: [],
                is_send: false,
                success: false,
                message: '',
                email: '',
                path_image: null,
                format: null,
                is_show: false,
            }
        },
        mounted() {
            console.log(this.post.post.id);
            this.message = 'Поделились сообщением';
            this.is_show = false;
            this.getUsers();
        },
        methods: {
            getUsers: function () {
                axios.get('/get/friends').then((response) => {
                    //console.log(response.data.data[0].email);
                    this.email = response.data.data[0].email;
                    this.result = response.data.data;
                });
            },
            sendMessage: function (e) {
                this.is_send = true;
                console.log(e);
                let arr = ['news-action.' + e];
                console.log(arr);
                this.is_show = true;
                axios({
                    method: 'get',
                    url: '/private-chat',
                    params: {message: this.message, channels: arr, user: this.email, file: this.path_image, format: this.format, post_id: this.post.post.id, post: this.post}
                }).then((response) => {
                    console.log(response);

                    this.is_send = false;
                    this.success = true;
                });

            }
        }
    }
</script>

<style scoped>

</style>
