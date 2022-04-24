<template>
    <ul class="post-comments p-0 m-0">
        <li v-for="item in dataComment">
            <div class="d-flex flex-wrap">
                <div class="user-img">
                    <img :src="item.icon" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                </div>
                <div class="comment-data-block ml-3">
                    <h6>{{item.user}}</h6>
                    <p class="mb-0">{{item.comment}}</p>
                    <div class="d-flex flex-wrap align-items-center comment-activity">
<!--                        <a href="javascript:void();">like</a>-->
<!--                        <a href="javascript:void();">reply</a>-->
                        <a href="javascript:void();">translate</a>
                        <span> now </span>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>








<script>
    export default {
        name: "CommentComponent",
        props: [
          "dataComment"
        ],
    }
</script>

<style scoped>

</style>
