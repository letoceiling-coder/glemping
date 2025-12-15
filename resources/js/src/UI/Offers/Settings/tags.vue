<template>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
               <router-link to="/admin/resource/tags">Создать тег</router-link>


            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Выбор тегов</label>

                <mc-select-too v-model="data.value" :selects="tags" keys="select_two" class="form-control">

                </mc-select-too>
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
        tags:[],
        name:'',
        load:false,
    }
    },

    mounted() {
        this.getTags()

        // if (this.storage.offers.offer.properties.find(t => t.name == this.data.name)) {
        //     this.data.value = this.storage.offers.offer.properties.find(t => t.name == this.data.name).value
        // }
        console.log(this.data.value)

    },
    methods:{
        async getTags() {

            await axios.get('/api/v1/tags').then(data => {
                console.log(data.data.data)
                this.tags = data.data.data
                this.load = true
            }).catch((error) => {
                console.log(error)

            })

        },
        async setTag() {

            await axios.post('/api/v1/tags',{
                name:this.name
            }).then(data => {
                console.log(data.data.data)
                this.tags.push(data.data.data)
                this.name = ''
            }).catch((error) => {
                console.log(error)

            })

        },
    },
    created() {
        if (!this.data.value){
            this.data.value = []
        }
    }
}
</script>

<style scoped>

</style>
