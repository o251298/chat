<template>
    <div>
        <button @click="send">SEND message</button>
    </div>
</template>

<script>
    export default {
        name: "smsclub",
        methods: {
            send: function () {
                var data = {
                    "phones": ["380508047845"],
                    "text" : "test message 1234",
                    "originator" : "Shop Zakaz"
                }
                axios({
                    method: 'post',
                    url: 'https://api.acemountmedia.com/sms-v2/send',
                    headers: {'Authorization': 'Bearer ' + 'EevnBT8XkJe2spKz9QTb1suUlrjcDytT'},
                    params: {data}
                }).then((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>

<style scoped>

</style>
