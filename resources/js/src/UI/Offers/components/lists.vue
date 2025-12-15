<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">
                <div class="flex ai-center gab-10 col-5">

                    <router-link :to="`/admin/offers/create`" class="btn btn-sm btn-primary flex ai-center gab-10">
                        <i class="fa-solid fa-square-plus"></i>
                        <span>Создать </span>
                    </router-link>
                </div>
                <div class="flex-center ai-center gab-10 col-3">
                    <div class="flex ai-center gab-20">
                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-grip"></i>
                            {{
                                paginates.find(item => item.id == form.paginate)?.name
                            }}
                        </span>

                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="paginate in paginates">
                                        <span
                                            @click="form.paginate = paginate.id;getModel()"
                                            class="font-20">{{ paginate.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>


                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-filter"></i>
                            {{
                                selectSort.find(item => item.id == form.sorter)?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="sort in selectSort">
                                        <span @click="form.sorter = sort.id;getModel()"
                                              class="font-14">{{ sort.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </div>
                </div>
                <div class=" form-group flex  w-100 m-0 p-0 col-3 ">
                    <div class="search-container relative w-100">

                        <mc-input v-model="form.search" class="form-control" type="text"
                                  placeholder="поиск">
                            <div class="absolute search flex gab-5">
                                <i v-if="form.search.length > 0"
                                   @click="form.search = '';getModel()"
                                   class="fa-solid fa-delete-left text-danger"></i>
                                <i @click="getModel()" class="fa fa-search "></i>

                            </div>

                        </mc-input>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Список</h3></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th class="mc-string">Наименование</th>
                            <th class="mc-category">Категория</th>
                            <th class="mc-active">Активность</th>
                            <th style="width: 100px;">Действие</th>
                        </tr>
                        </thead>
                        <tbody style="position: relative;">

                        <tr v-for="offer in offers.data">
                            <th style="width: 50px;">{{offer.id}}</th>
                            <td>{{offer.name}}</td>
                            <td>{{offer.category.name}}</td>
                            <td>
                                <div class="flex-center">
                                    <button @click="inActive(offer)" title="Изменить?" type="button"
                                            class="btn btn-sm btn-block " :class="offer.active ? 'btn-success' : 'btn-danger'">{{offer.active ? 'Активный' : 'Не активный'}}
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="flex gab-5">
                                    <router-link :to="`/admin/offers/update/${offer.id}`"
                                                 class="btn btn-outline-dark bg-gradient-success btn-xs"
                                                 title="Редактировать"
                                                 type="button">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </router-link>
                                    <button @click="deleteOffer(offer.id)" title="Удалить" type="button"
                                            class="btn bg-gradient-danger btn-xs">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer mt-3 flex ai-center jc-end">
                    <div class="clearfix flex">
                        <Paginate :paginate="offers" ></Paginate>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete-offer">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление предложения id-{{this.storage.currentId}}</h4>
                    <button type="button" class="close" @click="this.modalClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="this.modalClose">Отмена</button>
                    <button type="button" class="btn btn-primary" @click="deleteOffer(true)" >
                        <span class="send">Удалить</span>
                        <span class="spinner-container">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </span></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
import Paginate from '/resources/js/src/UI/Paginate/default-pagination.vue'
export default {
    components:{
        Paginate
    },
    name: "lists",
    data() {
        return {
            offers: [],
            form: {
                page:0,
                paginate: 20,
                sorter: 'orderByDesc',
                search: '',
            },
            selectSort: [
                {id: 'orderByDesc', name: 'Сортировать от новых'},
                {id: 'orderBy', name: 'Сортировать от старых'},
            ],
            paginates: [
                {id: '1', name: '1'},
                {id: '10', name: '10'},
                {id: '20', name: '20'},
                {id: '30', name: '30'},
                {id: '40', name: '40'},
                {id: '50', name: '50'},
                {id: '100', name: '100'},
            ],
        }
    },

    mounted() {
        if (this.$route.query.page){
            this.form.page = this.$route.query.page
        }else {
            this.form.page = 0
        }
        this.getModel()


    },
    methods: {
        async deleteOffer(id){
            if (id === true){
                $('#modal-delete-offer').modal('hide')

                //удаление
                await axios.post(`/api/v1/offers/${this.storage.currentId}`, {
                    _method: 'DELETE'
                }).then(data => {
                    this.getModel()
                    this.storage.currentId = null
                }).catch((error) => {
                    console.log(error)

                })

            }else{
                this.storage.currentId = id
                $('#modal-delete-offer').modal('show')
            }
        },
        async getModel() {

            await axios.get('/api/v1/offers', {
                params: this.form
            }).then(data => {
                this.offers = data.data
                console.log(data.data)
            }).catch((error) => {
                console.log(error)

            })

        },
        async inActive(offer) {

            await axios.post('/api/v1/offers/'+offer.id, {
                _method: "PUT",
                active:!offer.active
            }).then(data => {
                offer.active = !offer.active
                console.log(data.data)
            }).catch((error) => {
                console.log(error)

            })

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



.mc-category {
    width: 150px;

}
.mc-active {
    width: 125px;
    text-align: center;
}

.mc-image, .mc-image-upload {
    width: 150px;

}

td:has(img) {
    display: flex;
    justify-content: center;
}

td {

    img {

        max-height: 80px;
    }
}

.mc-integer {
    width: 100px;
    text-align: center;
}

.mc-color {
    width: 60px;
}
</style>
