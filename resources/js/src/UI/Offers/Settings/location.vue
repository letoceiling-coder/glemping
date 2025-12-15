<template>

    <div class="card" v-if="data.value">
        <div class="card-body ">
            <div class="row">
                <div class="col-3" v-if="regions.length > 0">
                    <div class="form-group">
                        <label>Регион</label>
                        <mc-select v-model="data.value.region_id" :selects="regions" keys="region_id"
                                   class="form-control">

                        </mc-select>
                    </div>
                </div>
                <div class="col-3" v-if="cities.length > 0">
                    <div class="form-group">
                        <label>Город</label>
                        <mc-select v-model="data.value.city_id" :selects="cities" keys="city_id" class="form-control">

                        </mc-select>
                    </div>
                </div>
                <div class="col-3" v-if="metro.length > 0">
                    <div class="form-group">
                        <label>Метро</label>
                        <mc-select v-model="data.value.metro_id" :selects="metro" keys="metro_id" class="form-control">

                        </mc-select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Адрес:</label>
                        <mc-input v-model="data.value.address" keys="address" class="form-control"></mc-input>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Доп.информация</label>
                        <mc-html v-model="data.value.html" keys="html"></mc-html>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    watch: {
        'data.value': {
            handler: function (value) {
                if (!value) {
                    this.data.value = {
                        region_id: 0,
                        city_id: 0,
                        address: '',
                        html: '',
                    }
                }

            },
            deep: true,
            immediate: true
        },
        'data.value.region_id': {
            handler: function (region_id) {
                if (region_id) {
                    this.metro = []
                    this.getCities(region_id)
                }

            },
            deep: true,
            immediate: true
        },
        'data.value.city_id': {
            handler: function (city_id) {
                if (city_id) {

                    this.getMetro(city_id)
                }

            },
            deep: true,
            immediate: true
        },
    },
    name: "location",
    props: {
        data: Object | null
    },
    data() {
        return {
            regions: [],
            cities: [],
            metro: [],
            load: false,

        }
    },
    methods: {

        async getRegions() {

            await axios.get('/api/v1/geo/regions', {
                params: {
                    filter: ['id', 'name']
                }
            }, {
                data: this.data
            }).then(data => {
                console.log(data.data)
                this.regions = data.data

            }).catch((error) => {
                console.log(error)

            })

        },
        async getCities(region_id) {
            console.log(region_id)
            await axios.get('/api/v1/geo/cities', {
                params: {
                    filter: ['id', 'name'],
                    region_id: region_id,
                }
            }, {
                data: this.data
            }).then(data => {
                console.log(data.data)
                this.cities = data.data
            }).catch((error) => {
                console.log(error)

            })

        },
        async getMetro(city_id) {
            console.log(city_id)
            await axios.get('/api/v1/geo/metro', {
                params: {
                    filter: ['id', 'name'],
                    city_id: city_id
                }
            }, {
                data: this.data
            }).then(data => {
                console.log(data.data)
                this.metro = data.data
            }).catch((error) => {
                console.log(error)

            })

        }

    },
    mounted() {
        if (!this.data.value) {
            this.data.value = {
                region_id: 0,
                city_id: 0,
                address: '',
                html: '',
            }
        }
        this.getRegions()
    },
    created() {
        if (!this.data.value && !this.data.value?.region_id) {
            this.data.value = {
                region_id: 0,
                city_id: 0,
                address: '',
                html: '',
            }
        }
    }
}
</script>

<style scoped>

</style>
