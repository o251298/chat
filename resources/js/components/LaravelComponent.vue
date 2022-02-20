<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel1</div>
                    <div class="card-body">
                        <button @click="update" v-if="!is_refresh" class="btn btn-light"> Обновить... {{id}}</button>
                        <span v-if="is_refresh"> Обновляется </span>
                    </div>
                    <div>
                        <table>
                            <thead>
                            <tr>
                                <th>lesson</th>
                                <th>subject</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in urldata">
                                <td>{{item.lesson}}</td>
                                <td>{{item.subject}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                urldata: [],
                is_refresh: false,
                id: 0
            }
        },
        mounted() {
            this.update();
            console.log('Component mounted.');
        },
        methods: {
            update: function(){
                this.is_refresh = true;
                axios.get('/lessons/ajax').then((response) => {
                    console.log(response);
                    this.urldata = response.data;
                    this.id++;
                    this.is_refresh = false;
                });
            }
        }
    }
</script>
