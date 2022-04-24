<template>
    <div class="container vue" style="margin-top: 100px">
        <div v-if="commentIndex < posts.length" v-for="commentIndex in postToShow">
            <div>{{posts[commentIndex].text}}</div>
            <div>{{posts[commentIndex].created_by.name}}</div>
            <hr/>
        </div>
        <div v-if="postToShow < posts.length || posts.length > postToShow">
            <button @click="showMore">show more reviews</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                posts: [
                    {text: '365'},
                    {text: '756'},
                    {text: '679'},
                    {text: '90-9-wersdfs'},
                    {text: 'xcv'},
                    {text: 'xcv'},
                    {text: 'xcv'},
                ],
                postToShow: 20,
                totalPosts: 0,
            }
        },
        mounted() {
            this.totalPosts = this.posts.length;
            console.log('Component mounted.')
            axios({
                method: 'get',
                url: '/news/more/',
            }).then((response) => {
                this.posts = response.data.data;
                console.log(this.posts);
            });
        },
        methods: {
            showMore: function () {
                this.postToShow = this.postToShow + 10;
            }
        }
    }
</script>
