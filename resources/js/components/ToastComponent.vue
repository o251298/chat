<template>
    <div>
        <b-button @click="makeToast()">Show Toast</b-button>
        <b-button @click="makeToast(true)">Show Toast (appended)</b-button>
    </div>
</template>

<script>
    import {BButton} from 'bootstrap-vue'
    export default {
        data() {
            return {
                toastCount: 0
            }
        },
        components: {
            BButton
        },
        methods: {
            makeToast(append = false) {
                this.toastCount++
                this.$bvToast.toast(`This is toast number ${this.toastCount}`, {
                    title: 'BootstrapVue Toast',
                    autoHideDelay: 5000,
                    appendToast: append
                })
            }
        }
    }
</script>
