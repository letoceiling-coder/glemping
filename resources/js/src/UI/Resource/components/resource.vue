<template>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">
                <div class="flex ai-center gab-10 col-5">

                    <router-link
                        v-if="this.storage.resource.route == 'update' || this.storage.resource.route == 'create'"
                        :to="`/admin/resource/${this.$route.params.action}`"
                        class="btn btn-sm btn-primary flex ai-center gab-10">
                        <i class="fa-solid fa-list"></i>
                        <span>К списку </span>
                    </router-link>

                    <router-link v-if="this.storage.resource.route == 'lists'"
                                 :to="`/admin/resource/${this.$route.params.action}/create`"
                                 class="btn btn-sm btn-primary flex ai-center gab-10">
                        <i class="fa-solid fa-square-plus"></i>
                        <span>Создать </span>
                    </router-link>
                </div>
                <div class="flex-center ai-center gab-10 col-3" v-if="this.storage.resource.route == 'lists'">
                    <div class="flex ai-center gab-20">
                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-grip"></i>
                            {{
                                paginates.find(item => item.id == this.storage.media.filter.paginate)?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="paginate in paginates">
                                        <span
                                            @click="this.storage.resource.filter.paginate = paginate.id;this.getModel()"
                                            class="font-20">{{ paginate.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>


                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-filter"></i>
                            {{
                                selectSort.find(item => item.id == storage.resource.filter.sort)?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="sorts in selectSort">
                                        <span @click="this.storage.resource.filter.sort = sorts.id;this.getModel()"
                                              class="font-14">{{ sorts.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </div>
                </div>
                <div class=" form-group flex  w-100 m-0 p-0 col-3 " v-if="this.storage.resource.route == 'lists'">
                    <div class="search-container relative w-100">
                        <mc-input v-model="this.storage.resource.filter.search" class="form-control" type="text"
                                  placeholder="поиск">
                            <div class="absolute search flex gab-5">
                                <i v-if="this.storage.resource.filter.search.length > 0"
                                   @click="this.storage.resource.filter.search = '';getModel()"
                                   class="fa-solid fa-delete-left text-danger"></i>
                                <i @click="getModel()" class="fa fa-search "></i>

                            </div>

                        </mc-input>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="this.storage.resource.default && !this.$route.params.params">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Доп.настройки
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i
                        class="fas fa-minus fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body flex ">
                <div class="col-4">
                    <div class="form-group" v-for="item in this.storage.resource.default">
                        <template v-if="item.type == 'select'">
                            <label>{{ item.label }}</label>
                            <div class="flex gab-10 ai-center">
                                <mc-select :selects="item.selects" v-model="item.value" class="form-control">
                                    <button @click="changeDefault(item.relationship,item.value)"
                                            class="btn btn-sm btn-primary flex ai-center gab-10">Изменить
                                    </button>
                                </mc-select>
                            </div>

                        </template>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="col-md-12" v-if="this.storage.resource.tags && !this.$route.params.params">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Теги
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i
                        class="fas fa-minus fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body row ">
                <div class="col-6">
                    <div class="form-group">
                        <label>Категория</label>
                        <mc-select @change="setCheckCategories" v-model="this.storage.resource.form.category_id"
                                   :selects="this.storage.resource.categories" keys="category_id"
                                   class="form-control"></mc-select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Новый тег</label>
                        <div class="flex ">
                            <div class="col-9">

                                <mc-input v-model="this.storage.resource.form.name" class="form-control" keys="name">

                                </mc-input>

                            </div>
                            <div class="col-3">

                                <button @click="addTag" class="btn btn-sm btn-primary mt-1 ">Добавить</button>

                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-12 card">
                    <div class="card-body">

                        <div class="form-group">
                            <div class="row">

                                <div class="col-2" v-for="tag in this.storage.resource.tags">

                                    <div class="form-check flex ai-center">
                                        <input @change="changeTags" :value="tag.id"
                                               v-model="this.storage.resource.form.tags"
                                               class="form-check-input" type="checkbox">
                                        <label class="form-check-label">{{ tag.name }}</label>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row">

        <component :is="this.storage.resource.route"></component>
    </div>
</template>

<script>

import Lists from '/resources/js/src/UI/Resource/components/lists.vue'
import Update from '/resources/js/src/UI/Resource/components/update.vue'

export default {
    components: {

        lists: Lists,
        update: Update,
        create: Update,
    },
    name: "resource",
    // watch:{
    //     'storage.resource.form.tags':{
    //         handler: function (tags) {
    //             console.log(tags)
    //
    //         },
    //         deep: true,
    //         immediate: true
    //     }
    // },
    data() {
        return {
            tags: [],
            component: 'lists',
            load: false,
            fields: [],
            resources: [],
            selectSort: [
                {id: 'orderByDesc', name: 'Сортировать от новых'},
                {id: 'orderBy', name: 'Сортировать от старых'},
            ],
            paginates: [
                {id: '10', name: '10'},
                {id: '20', name: '20'},
                {id: '30', name: '30'},
                {id: '40', name: '40'},
                {id: '50', name: '50'},
                {id: '100', name: '100'},
            ],
        }
    },
    methods: {

        async changeTags() {
            console.log(this.storage.resource.form.tags)
            await axios.post(`/api/v1/categories/tags/sync`, {
                tags: this.storage.resource.form.tags,
                category_id: this.storage.resource.form.category_id,
            }).then(data => {

                if (data) {
                    this.getFields(true)
                }


            }).catch((error) => {
                console.log(error)

            })
        },
        setCheckCategories() {


            this.storage.resource.form.tags = []
            if (this.storage.resource.categories) {
                for (let i = 0; i < this.storage.resource.categories.length; i++) {
                    if (this.storage.resource.categories[i].id == this.storage.resource.form.category_id) {
                        this.storage.resource.form.tags = this.storage.resource.categories[i].tags.map(item => {
                            return item.id
                        })
                    }
                }
                console.log(this.storage.resource.form.tags)
            }


        },
        async getFields(action = null) {
            await axios.get(`/api/v1/${this.$route.params.action}/fields/get`, {
                params: this.storage.resource.filter
            }).then(data => {
                if (!data){
                    this.$router.push(`/admin/${this.$route.params.action}`)
                }
                console.log(data.data)
                    this.storage.resource.fields = data.data.fields ? data.data.fields : data.data
                    this.storage.resource.fields = this.storage.resource.fields.map(item => {
                        if (item.type == 'image') {
                            item.sort = 0
                        } else if (item.type == 'active') {
                            item.sort = 90
                        } else if (item.field == 'sort') {
                            item.sort = 100
                        } else {
                            item.sort = 50
                        }
                        return item
                    }).sort((a, b) => (a.sort > b.sort) ? 1 : -1)

                    this.storage.resource.fields.sort((a, b) => (a.sort > b.sort) ? 1 : -1)

                    this.storage.resource.default = data.data.default
                    this.storage.resource.tags = data.data.tags
                    this.storage.resource.categories = data.data.categories

                    this.setCheckCategories()
                    if (!action) {
                        this.getModel()
                    }




            }).catch((error) => {
                console.log(error)

            })
        },
        async tags() {

            await axios.get(`/api/v1/tags`).then(data => {

                if (data) {
                    this.tags = data.data
                }
                console.log(this.tags)

            }).catch((error) => {
                console.log(error)

            })
        },
        async addTag() {

            await axios.post(`/api/v1/tags`, {
                name: this.storage.resource.form.name,
            }).then(data => {

                if (data) {
                    this.storage.resource.form.name = ''
                    this.getFields(true)
                }


            }).catch((error) => {
                console.log(error)

            })
        },
        async getModel() {

            await axios.get(`/api/v1/${this.$route.params.action}`, {
                params: this.storage.resource.filter
            }).then(data => {
                console.log(data.data)

                this.storage.resource.resources = data.data
                this.load = true

            }).catch((error) => {
                console.log(error)

            })
        },
        async changeDefault(key_, value_) {
            console.log(this.storage.resource.default)
            await axios.post(`/api/v1/default/values/change/${key_}`, {
                value_
            }).then(data => {
                console.log(data.data)
                if (data) {
                    this.$notify(data.data)
                }

            }).catch((error) => {
                console.log(error)

            })
        },
        async deleteResource(resource) {
            await axios.post(`/api/v1/${this.$route.params.action}/${resource.id}`, {
                _method: 'DELETE'
            }).then(data => {
                this.getModel()

            }).catch((error) => {
                console.log(error)

            })
        },
        async changeActive(resource,field) {
            console.log(resource)
            console.log(field.field)
            let data = {
                _method: 'PUT',
            }
            data[field.field] = !resource[field.field]
            await axios.post(`/api/v1/${this.$route.params.action}/${resource.id}`, data).then(data => {
                this.getModel()

            }).catch((error) => {
                console.log(error)

            })
        }
    },
    mounted() {
        if (this.$route.query.page) {
            this.storage.resource.filter.page = this.$route.query.page
        }

        if (this.$route.params.params) {
            this.storage.resource.route = 'update'
        } else {
            this.storage.resource.route = 'lists'
            this.getFields()
        }



    }
}
</script>

<style scoped lang="scss">
.search-container {

    input {
        padding-right: 30px;
    }

    .search {
        position: absolute;
        right: 15px;
        top: calc(50% - 8px);
        cursor: pointer;
    }

}
</style>
