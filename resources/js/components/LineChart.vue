<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <line-chart :chart-data="data" :height="100" :options="{responsive: true, maintainAspectRatio:true}"></line-chart>
                <button @click="update" class="btn btn-info" v-if="!is_refresh">Обновить график</button>
                <span class="alert-warning" v-if="is_refresh">Updating</span>
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from "./js/LineChart";
    export default {
        components: {
            LineChart
        },
        data: function(){
            return {
                data: [],
                is_refresh: false,
            }
        },
        mounted() {
            this.update();
            console.log('Component mounted.');
        },
        methods: {
            update: function(){
                this.is_refresh = true;
                axios.get('/line-chart').then((response) => {
                    console.log(response);
                    this.data = response.data;
                    this.is_refresh = false;
                });
            }
        }
    }
</script>
