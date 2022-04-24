<template>
    <div class="iq-search-bar">
        <form class="searchbox">
            <input type="text" class="text search-input" v-model="text_search" placeholder="Введите имя для поиска...">
            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
        </form>
            <ul v-if="result.length > 0" class="request-list m-0 p-0" id="result-search">
                <li class="d-flex align-items-center result-user" v-for="item in result">
                    <div class="user-img img-fluid"><img :src="item.icon" alt="story-img" class="rounded-circle avatar-40"></div>
                    <div class="media-support-info ml-3">
                        <h6><a :href="'../profile/' + item.id">{{item.name}}</a></h6>
                    </div>
                </li>
            </ul>
    </div>
</template>

<script>
    export default {
        name: "SearchComponent",
        data : function()
        {
            return {
                text_search: '',
                result: [
                ]
            }
        },
        methods: {

        },
        watch: {
            text_search: function()
            {
                let str = this.text_search.trim();
                if (str != ''){
                    console.log(str);
                    axios.get('/search/user/' + str).then((response) => {
                        console.log(response);
                        this.result = response.data.data;
                    });
                } else {
                    this.result = [];
                }
            }
        }
    }
</script>

<style scoped>
#result-search {
    position: absolute;
    width: 460px;
    background: white;
    border-left: 1px solid #F8F8FF;
    border-right: 1px solid #F8F8FF;
    border-bottom: 1px solid #F8F8FF;
    box-shadow: 1px 1px 5px #D3D3D3;
    border-radius: 4px;
}
.result-user {
    padding: 10px;
    height: 50px;
}
</style>
