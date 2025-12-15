<template>

    <div class="row">
        <div class="col-12" >
            <div class="form-group">
                <label>{{ setting.label }}</label>

                <mc-select class="form-control" :selects="setting.selects" v-model="setting.form"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        setting: Object
    },
    mounted() {
        this.getForms()
    },
    methods:{
        async getForms() {

            await axios.get(`/api/v1/forms`, {
                params: {
                    popup:false
                }
            }).then(data => {
                console.log(data.data)
                this.setting.selects = data.data.data


            }).catch((error) => {
                console.log(error)

            })

        },
    }
}
</script>

<style scoped>

</style>
