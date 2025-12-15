<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Предложения</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> admin</li>
                        <li class="breadcrumb-item ">{{ this.$route.params.template }}</li>
                        <li v-if="this.$route.params.action" class="breadcrumb-item ">{{ this.$route.params.action }}
                        </li>
                        <li v-if="this.$route.params.params" class="breadcrumb-item ">{{ this.$route.params.params }}
                        </li>


                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

<!--            <Root v-if="this.storage.settings.user.role.id >= 999 && route == 'lists'"/>-->
            <div class="card">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card-body">
                            <component :is="route"></component>
                        </div>
                        <div class="card-footer">
                            <button  @click="save" type="button" class="btn btn-primary float-right mb-2 mt-2">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Root from './components/root.vue'
import Lists from './components/lists.vue'
import Update from './components/update.vue'

export default {
    name: "index",
    components: {
        Root,
        'lists': Lists,
        'update': Update
    },
    data() {
        return {
            route: null,
        }
    },
    mounted() {
        if (this.$route.params.action == '') {
            this.route = 'lists'
        } else {
            this.route = 'update'
        }

        this.getProperties()
        this.getTypes()
    },
    methods:{
        updateProperties(){

            this.storage.offers.offer.properties = this.storage.offers.properties.map(item => {

                return {
                    id:item.id,
                    name:item.name,
                    type:item.type.name,
                    type_id:item.type.id,
                    component:item.component,
                    value:typeof item.value == 'string' ? item.value : Object.assign({},item.value),
                }
            })

            return this.storage.offers.offer
        },
        async save() {


            let url = '/api/v1/offers'
            if(this.storage.offers.offer.id){
                this.storage.offers.offer._method = 'PUT'
                url += `/${this.storage.offers.offer.id}`
            }
            console.log(this.updateProperties())
            await axios.post(url,this.updateProperties()).then(data => {
                if(data){
                    this.$router.push('/admin/offers')
                }

                console.log(this.storage.offers.offer)
            }).catch((error) => {
                console.log(error)

            })

        },
        async getProperties() {

            await axios.get('/api/v1/properties',{

            }).then(data => {
                this.storage.offers.properties = data.data
                this.storage.offers.typesOn = this.storage.offers.properties.filter(item => item.active == true).map(item => {
                    return item.id
                })
                if(this.storage.offers.properties.find(item => item.id == 13)){
                    this.storage.offers.properties = this.storage.offers.properties.map(item => {
                        if(item.id == 13){
                            item.value = `<h4>Как можно <br> оплатить <br> экскурсию?</h4><strong>Моментальное бронирование </strong><strong>Без ожидания ответа гида</strong>
        <hr>
        <span> Для предоплаты доступен полный возврат средств при отмене за 48 часов </span>`
                        }
                        return item;
                    })
                    console.log(this.storage.offers.properties)
                }
            }).catch((error) => {
                console.log(error)

            })

        },
        async getTypes() {

            await axios.get('/api/v1/system_types').then(data => {
                this.storage.offers.types = data.data.map(item => {
                    item.name = `${item.name} ( ${item.description} )`
                    return item
                })
                console.log(data.data)
            }).catch((error) => {
                console.log(error)

            })

        }
    }
}
</script>

<style scoped>

</style>
