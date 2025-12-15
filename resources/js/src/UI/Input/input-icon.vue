<template>

    <div class="input-group">

        <div class="input-group-prepend" >
                <span class="input-group-text">

                  <vue-picker  v-model="input.icon"></vue-picker>
                </span>
        </div>

        <mc-input v-model="input.text" v-bind="$attrs"  />



    </div>


    <div ref="errors" class="error-block">
        <mc-error  :keys="keys"/>
    </div>
</template>

<script>
export default {
    name: "input-icon",
    props: {
        input: Object,
        keys: String | null,
    },
    methods:{
        removeError(){
            let keys = this.keys
            this.storage.errors.splice(this.storage.errors.findIndex(function(err) {
                return err.name === keys
            }),1)
        }
    },
    watch:{
        'input.text': {
            handler: function (text) {

                if (text && text.length > 0 && this.storage.errors.find(item => item.name === this.keys)){

                    $(this.$refs.errors).slideUp()
                    setTimeout(this.removeError, 1000);


                }

            },
            deep: true,
            immediate: true
        },

    },
    created() {

        if (this.input.icon == null) {

            this.input.icon = 'fas fa-search'
        }

    }
}
</script>

<style scoped>

</style>
