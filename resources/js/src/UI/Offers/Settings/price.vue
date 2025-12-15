<template>
    <div class="form-group">
        <div class="row">
            <div class="col-4">
                <label>Стоимость</label>
                <mc-input v-model="data.value.price" keys="price" class="form-control"></mc-input>
            </div>
            <div class="col-4">
                <label>Валюта</label>
                <mc-select v-model="data.value.currency_id" :selects="currencies" keys="currency_id" class="form-control"></mc-select>
            </div>
        </div>

    </div>

</template>

<script>
export default {
name: "price",
    props: {
        data: Object
    },
    data(){
    return{
        currencies:[],
    }
    },
    mounted() {
        this.getCurrencies()

    },
    methods:{
        async getCurrencies() {

            await axios.get('/api/v1/currencies',{
                params:{
                    active:true,
                }
            }).then(data => {
                console.log(data.data.data)
                this.currencies = data.data.data
            }).catch((error) => {
                console.log(error)

            })

        },
    },
    created() {
        if(!this.data.value){
            this.data.value = {}
        }
    }
}
</script>

<style scoped>

</style>
