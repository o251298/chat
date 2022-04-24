<template>
    <li class="nav-item dropdown" v-if="notification">
        <a href="#" class="search-toggle iq-waves-effect">
            <div id="lottie-mail"></div>
            <span class="bg-primary count-mail"></span>
        </a>
        <div class="iq-sub-dropdown">
            <div class="iq-card shadow-none m-0">
                <div class="iq-card-body p-0 ">
                    <div class="bg-primary p-3">
                        <h5 class="mb-0 text-white" >New message<small class="badge  badge-light float-right pt-1">{{counter}}</small></h5>
                    </div>
<!--                    <a href="#" class="iq-sub-card" v-for="item in messages">-->
<!--                        <div class="media align-items-center">-->
<!--&lt;!&ndash;                            <div class="">&ndash;&gt;-->
<!--&lt;!&ndash;                                <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--                            <div class="media-body ml-3">-->
<!--                                <h6 class="mb-0 ">{{item.user}}</h6>-->
<!--&lt;!&ndash;                                <small class="float-left font-size-12">13 Jun</small>&ndash;&gt;-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </a>-->
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data: function(){
            return {
                url: 'http://localhost',
                port: '6003',
                notification: false,
                messages: [],
                counter: this.count_message,
            }
        },
        props: [
            "current_user",
            "count_message"
        ],
        mounted() {
            if (this.count_message > 0)
            {
                this.notification = true;
            }
            setTimeout(() =>{
                this.track()
            }, 20000)
        },
        created() {
            this.track();
        },
        methods: {
            track: function () {
                var socket = io(this.url + ':' + this.port);
                socket.on("news-action." + this.current_user.id + ":App\\Events\\PrivateMessage", function (data) {

                    this.$toaster.info('Новое сообщение от: ' + data.message.user);
                    this.messages.push({user: data.message.user, user_icon : this.url});
                    this.counter += 1;
                    this.notification = true;
                }.bind(this));
            }
        }
    }
</script>

<style scoped>

</style>
