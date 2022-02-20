<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-header">
            <h2>Socket Pie Chart</h2>
            </div>
            <div class="col-md-12">
                <pie-chart :chart-data="data" :height="100" :options="{responsive: true, maintainAspectRatio:true}"></pie-chart>
                <button @click="update" class="btn btn-info" v-if="!is_refresh">Обновить график</button>
                <span class="alert-warning" v-if="is_refresh">Updating</span>
            </div>
            <div class="col-md-12">

                <lable>Продукт</lable>
                <input type="text" class="form-control" v-model="label">
                <lable>Цена</lable>
                <input type="text" class="form-control" v-model="sale">
                <lable>Обновить глобально</lable>
                <input type="checkbox" v-model="realtime"> <br>
                <button @click="sendData" class="btn btn-info" v-if="!is_send">Отправть на сервер</button>
                <span class="alert-warning" v-if="is_send">Updating</span>
            </div>
        </div>
    </div>
</template>

<script>
    import PieChart from "./js/PieChart";
    export default {
        components: {
            PieChart
        },
        data: function(){
            return {
                data: [],
                is_refresh: false,
                is_send: false,
                label: "",
                sale: 500,
                realtime: false
            }
        },
        mounted() {
            var socket = io('http://localhost:6001');
            socket.on("news-action:App\\Events\\ChartEvent", function (data) {
                this.data = data.result;
            }.bind(this));
            this.update();
            console.log('Component mounted.');
        },
        methods: {
            update: function(){
                this.is_refresh = true;
                axios.get('/lessons/line-chart').then((response) => {
                    console.log(response);
                    this.data = response.data;
                    this.is_refresh = false;
                });
            },
            sendData: function () {
                this.is_send = true;
                axios({
                    method: 'get',
                    url: '/lessons/socket-chart',
                    params: {label: this.label, sale: this.sale, realtime: this.realtime}
                }).then((response) => {
                    console.log(response);
                    this.data = response.data
                });
                this.is_send = false;
            }
        }
    }
</script>
