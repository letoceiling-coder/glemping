<template>
    <div class="col-4">
        <mc-select v-model="data.value" :selects="categories" class="form-control"></mc-select>
    </div>

</template>

<script>
export default {
name: "categories",
    props: {
        data: Object
    },
    data(){
    return{
        categories:[],
    }
    },
    mounted() {
        this.getCategories()
    },
    created() {
        if (!this.data.value) {
            this.data.value = 0
        }
    },
    methods:{
        async getCategories() {

            await axios.get('/api/v1/categories').then(data => {
                console.log(data.data.data)
                this.categories = data.data.data
            }).catch((error) => {
                console.log(error)

            })

        },
    }
}
</script>

<style scoped>

</style>
