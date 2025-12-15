<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">
                <div class="flex ai-center gab-10 col-5">
                    <router-link to="/admin/offers"
                       class="btn btn-sm btn-primary flex ai-center gab-10">
                        <i class="fa-solid fa-list"></i>
                        <span>К списку </span>
                    </router-link>
                </div>

            </div>
        </div>
    </div>
    <div v-if="load" class="card">
        <div class="card-header">
            <h3 class="card-title">
                Данные
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>

        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <div class="form-group">
                        <label>Наименование</label>
                        <mc-input v-model="offer.name" keys="name" class="form-control"></mc-input>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Категория</label>
                                <mc-select :selects="this.storage.categories" v-model="offer.category_id"
                                           class="form-control" keys="category_id"></mc-select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Стоимость</label>
                                <mc-input v-model="offer.price" keys="price" type="number"
                                          class="form-control"></mc-input>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Стоимость co скидкой</label>
                                <mc-input v-model="offer.price_old" keys="price_old" type="number"
                                          class="form-control"></mc-input>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div v-if="load" class="card"
         v-for="property in this.storage.offers.properties.filter(item => item.active == true)">
        <div class="card-header">
            <h3 class="card-title">
                {{ property.name }}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>

        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div class="card-body">

                        <component :is="`offer-${property.type.name}`"
                                   :data="property"></component>


                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
import String from '/resources/js/src/UI/Offers/Settings/string.vue'
import Html from '/resources/js/src/UI/Offers/Settings/html.vue'
import Gallery from '/resources/js/src/UI/Offers/Settings/gallery.vue'
import Location from '/resources/js/src/UI/Offers/Settings/location.vue'
import Category from '/resources/js/src/UI/Offers/Settings/category.vue'
import Price from '/resources/js/src/UI/Offers/Settings/price.vue'
import InfoBlock from '/resources/js/src/UI/Offers/Settings/info-block.vue'
import Tags from '/resources/js/src/UI/Offers/Settings/tags.vue'

export default {
    components: {
        'offer-string': String,
        'offer-html': Html,
        'offer-gallery': Gallery,
        'offer-location': Location,
        'offer-category': Category,
        'offer-price': Price,
        'offer-info-block': InfoBlock,
        'offer-tags': Tags,
    },
    name: "update",
    data() {
        return {
            offer: {
                category_id: 0,
                name: '',
                price: null,
                price_old: null,
                properties: this.storage.offers.properties.map(item => {

                    item.value = null
                    return item
                }),
            },
            load: false,

        }
    },
    mounted() {
        this.getCategories()
        if (this.$route.params.action == 'update') {
            this.getOffer()
        } else {
            this.storage.offers.offer = this.offer


            this.load = true

        }
    },
    methods: {
        async getCategories() {
            if (this.storage.categories.length == 0) {
                await axios.get('/api/v1/categories').then(data => {

                    this.storage.categories = data.data.data
                }).catch((error) => {
                    console.log(error)

                })
            }


        },
        async getOffer() {

            await axios.get(`/api/v1/offers/${this.$route.params.params}`)
                .then(data => {
                    console.log(data.data.data.properties)
                    this.offer = data.data.data
                    this.storage.offers.offer = data.data.data
                    let properties = this.offer.properties
                    console.log(properties)
                    this.storage.offers.properties = this.storage.offers.properties.map(item => {
                        if (properties.find(t => t.name == item.name)) {
                            item.value = properties.find(t => t.name == item.name).value
                            console.log(item)

                        }

                        return item
                    })
                    console.log(this.offer.properties)
                    console.log(this.storage.offers.properties)
                    this.load = true
                }).catch((error) => {
                    console.log(error)

                })

        }
    }
}
</script>

<style scoped>

</style>
