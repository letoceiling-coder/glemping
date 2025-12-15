<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">

                        <h4>{{ setting.label }}</h4>


                    </div>
                    <div class="form-group">

                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>ресурс:</strong>
                            </div>
                            <div class="col-4" v-if="setting.resource.route == 'menus'">
                                <router-link :to="`/admin/${setting.resource.route}`"> {{ setting.resource.name }}
                                </router-link>
                            </div>
                            <div class="col-4" v-if="setting.resource.route != 'menus'">
                                <router-link :to="`/admin/resource/${setting.resource.route}`"> {{ setting.resource.name }}
                                </router-link>
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>сортировать:</strong>
                            </div>
                            <div class="col-4">

                                <mc-select :selects="filters.sort" v-model="setting.resource.filters.sort"
                                           class="form-control"></mc-select>
                            </div>
                        </div>


                    </div>

                    <div class="form-group" v-if="setting.resource.filters.category_id != undefined">
                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>По категории:</strong>
                            </div>
                            <div class="col-4">

                                <mc-select :selects="categories" v-model="setting.resource.filters.category_id"
                                           class="form-control"></mc-select>
                            </div>
                        </div>


                    </div>
                    <div class="form-group" v-if="setting.resource.filters.video_id != undefined">
                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>Сортировать по типу:</strong>
                            </div>
                            <div class="col-4">

                                <mc-select :selects="videos" v-model="setting.resource.filters.video_id"
                                           class="form-control"></mc-select>
                            </div>
                        </div>


                    </div>
                    <div class="form-group" v-if="setting.resource.filters.sort != 'ids'">
                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>Выбрать:</strong>
                            </div>
                            <div class="col-4">

                                <mc-input v-model="setting.resource.filters.paginate" type="number" class="form-control">

                                </mc-input>
                            </div>
                            <div class="col-6">
                                PS: Если 0 то будут выбраны все модели из ресурса
                            </div>
                        </div>

                    </div>

                    <div class="form-group" v-if="setting.resource.filters.sort == 'ids'">
                        <div class="row flex ai-center">
                            <div class="col-2">
                                <strong>Выбрать:</strong>
                            </div>
                            <div class="col-4">
                                <mc-select-too v-model="setting.resource.filters.ids" :selects="ids" keys="select_two"
                                               class="form-control">

                                </mc-select-too>

                            </div>
                            <div class="col-6">
                                PS: Если 0 то будут выбраны все модели из ресурса
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
import VRC from "/resources/js/src/Views/components";

export default {
    components:{

    },
    name: "index",
    props: {
        setting: Object
    },
    data() {
        return {
            VRC:new VRC(),
            filters: new VRC().getFilter(),
            categories:[],
            videos:[
                {id:0,name:'Все отзывы'},
                {id:1,name:'Видео отзывы'},
                {id:2,name:'Текстовые отзывы'},
            ],
            ids:[],
        }
    },
    methods:{

        async getCategory() {

            if(this.storage.categories.length == 0){
                await axios.get('/api/v1/categories').then(data => {
                    console.log(data.data)
                    this.categories = data.data.data
                    this.storage.categories = this.categories
                }).catch((error) => {
                    console.log(error)

                })
            }else {
                this.categories = this.storage.categories
            }


        },
        async getIds(route) {
            let url = `/api/v1/${route}`
            await axios.get(url).then(data => {
                console.log(data.data)
                this.ids = data.data.data.map(item => {
                    return {
                        name:item.id
                    }
                })

            }).catch((error) => {
                console.log(error)

            })


        },
    },
    mounted() {

        this.getIds(this.setting.resource.route)
        console.log(this.setting)
    }
}
</script>

<style scoped>

</style>
