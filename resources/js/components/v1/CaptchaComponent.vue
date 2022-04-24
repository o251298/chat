<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CAPTCHA</div>

                    <div class="card-body">
                        <p>{{question}}</p>
                        <input type="text" v-model="answer">
                        <button @click="showCaptcha">Check</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                question: "3 + 4",
                answer: ''
            }
        },
        methods: {
            showCaptcha: function () {
                if(this.answer == 7)
                {
                    console.log('success');
                } else {
                    console.log('error');
                }
                console.log(this.answer);
            }
        }
    }
</script>
