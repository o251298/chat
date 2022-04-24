<template>
    <div class="v-popup">
        <div class="v-popup__header">
            <span>name</span>
            <span>X</span>
        </div>
        <div class="v-popup__content">

        </div>
        <div class="v-popup__footer">
            <button>SEND</button>
            <button @click="closePopup">Close</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "v-popup",
        props: [
          "post_id"
        ],
        mounted() {
            console.log(this.post_id);
        },
        methods: {
            closePopup: function(){
                this.$emit('closePopup');
            }
        }
    }
</script>

<style lang="scss">
.v-popup{
    padding: 16px;
    position: fixed;
    top: 200px;
    left: 400px;
    right: 0px;
    width: 400px;
    background: white;
    box-shadow: 0 0 17px 0 #e7e7e7;
    z-index: 1;
    &__header, &__footer{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    &__content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>
