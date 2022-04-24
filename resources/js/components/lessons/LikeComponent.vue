<template>
    <div class="d-flex justify-content-between align-items-center">
        <div class="like-block position-relative d-flex align-items-center">
            <div class="d-flex align-items-center">
                <div class="like-data">
                    <div class="dropdown">
                        <form action="#" method="post">
                            <button class="dropdown-toggle" @click="likes()" style="background: none; border: none; border-radius: 50%" type="button">
                                <img src="/template/images/icon/01.png" class="img-fluid" alt="">
                            </button>
                        </form>
                    </div>
                </div>
                <div class="total-like-block ml-2 mr-3">
                    <div class="dropdown">
                        <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                            {{like}}
                        </span>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Max Emum</a>
                            <a class="dropdown-item" href="#">Bill Yerds</a>
                            <a class="dropdown-item" href="#">Hap E. Birthday</a>
                            <a class="dropdown-item" href="#">Tara Misu</a>
                            <a class="dropdown-item" href="#">Midge Itz</a>
                            <a class="dropdown-item" href="#">Sal Vidge</a>
                            <a class="dropdown-item" href="#">Other</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="total-comment-block">
                <div class="dropdown">
                                             <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                             like
                                             </span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Max Emum</a>
                        <a class="dropdown-item" href="#">Bill Yerds</a>
                        <a class="dropdown-item" href="#">Hap E. Birthday</a>
                        <a class="dropdown-item" href="#">Tara Misu</a>
                        <a class="dropdown-item" href="#">Midge Itz</a>
                        <a class="dropdown-item" href="#">Sal Vidge</a>
                        <a class="dropdown-item" href="#">Other</a>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="share-block d-flex align-items-center feather-icon mr-3">-->
<!--            <a href="javascript:void();"><i class="ri-share-line"></i>-->
<!--                <span class="ml-1">99 Share</span></a>-->
<!--        </div>-->
    </div>
</template>

<script>
    export default {
        name: "LikeComponent",
        props : [
            'post'
        ],
        data: function () {
            return {
                like: 0,
                id: null
            }
        },
        mounted() {
            this.like = this.post.likes;
            this.id = this.post.id;
        },
        created() {
            this.like = this.post.likes;
            this.id = this.post.id;
            },
        methods: {
            likes: function () {
                axios.get('/post/mark/' + this.id).then((response) => {
                  //  console.log(response);
                    this.like = response.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
