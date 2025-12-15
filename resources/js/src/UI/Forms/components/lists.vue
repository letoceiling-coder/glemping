<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">
                <div class="flex ai-center gab-10 col-5">

                    <router-link  @click="resetForm" :to="`/admin/forms/create`" class="btn btn-sm btn-primary flex ai-center gab-10">
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
                                            @click="form.paginate = paginate.id;getForms()"
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
                                        <span @click="form.sorter = sort.id;getForms()"
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
                                   @click="form.search = '';getForms()"
                                   class="fa-solid fa-delete-left text-danger"></i>
                                <i @click="getForms()" class="fa fa-search "></i>

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
                <div class="card-header">
                    <h3 class="card-title">Список</h3></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th class="mc-string">Наименование</th>
                            <th class="mc-string">Метод</th>
                            <th style="width: 130px;"  class="mc-active">Активность</th>
                            <th style="width: 100px;">Действие</th>
                        </tr>
                        </thead>
                        <tbody style="position: relative;">

                        <tr v-for="form in forms.data">
                            <th style="width: 50px;">{{form.id}}</th>
                            <td>{{form.name}}</td>
                            <td>{{form.method}}</td>
                            <td>
                                <div class="flex-center">
                                    <button @click="changeActive(form)" title="Изменить?" type="button"
                                            class="btn btn-sm btn-block " :class="form.active ? 'btn-success' : 'btn-danger'">
                                        {{form.active ? 'Активный': 'Не активный'}}
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="flex gab-5">
                                    <router-link :to="`/admin/forms/update/${form.id}`"
                                                 class="btn btn-outline-dark bg-gradient-success btn-xs"
                                                 title="Редактировать"
                                                 type="button">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </router-link>
                                    <button @click="deleteForm(form)" title="Удалить" type="button"
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
                        <Paginate :paginate="forms" ></Paginate>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Paginate from '/resources/js/src/UI/Paginate/default-pagination.vue'
export default {
name: "lists",
    components:{
        Paginate
    },
    data(){
    return{
        forms:[],
        form: {
            page:0,
            paginate: 2,
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
        if (this.$route.params.action){

        }else {
            this.getForms()
        }

    },
    methods:{
        resetForm(){
            this.storage.form = {
                name: '',
                method: 'default',
                size: 'modal-xl',
                active: true,
                bitrix: false,
                save: false,
                logo: true,
                sort: 0,
                popup: true,
                currentRow:0,
                currentCol:0,
                data:[],
            }
        },
        async deleteForm(form){
            await axios.post(`/api/v1/forms/${form.id}`, {
                _method: 'DELETE',

            }).then(data => {
                this.getForms()

            }).catch((error) => {
                console.log(error)

            })
        },
        async changeActive(form) {
            form.active = form.active == 1
            form.active = !form.active
            console.log(form.active)
            await axios.post(`/api/v1/forms/${form.id}`, {
                _method: 'PUT',
                active: form.active
            }).then(data => {
                form.active = data.data.active

            }).catch((error) => {
                console.log(error)

            })
        },
        async getForms() {

            await axios.get('/api/v1/forms', {
                params: this.form
            }).then(data => {
                this.forms = data.data
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
</style>
