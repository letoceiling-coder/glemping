<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Категории</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> admin</li>
                        <li class="breadcrumb-item active">menus</li>


                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info ">
                        <div class="mb-3 flex gab-5 ai-center">
                            <button @click="resetForm();this.modalShow('#modal-slug')" id="fa-plus"
                                    class="btn btn-xs btn-default bg-gradient-black">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <label class="m-0" for="fa-plus">Создать раздел</label>

                        </div>
                        <div class="row flex column">
                            <ul @end="end"
                                v-sortable="{disabled: false, options: { multiDrag: true,group: 'shared',animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }"
                                class="lists" data-parent="0"
                            >
                                <Children v-for="menu in menus" :key="menu.id" :menu="menu"
                                          :dataId="menu.id"
                                          :form="form"></Children>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-slug">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{
                            actions.find(item => item.id == this.storage.menu.action).name
                        }}</h4>
                    <button @click="this.modalClose" type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Наименование</label>
                        <mc-input v-model="form.name" keys="name" type="text" class="form-control"/>

                    </div>
                    <div class="form-group">
                        <label>Ссылка</label>
                        <mc-input v-model="form.slug" keys="slug" type="text" class="form-control"/>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-8">

                                <label>Фото</label>
                                <div class="flex gab-10 ai-center">
                                    <download-file v-model="form.image_id" keys="image_id">
                                        <label class="m-0">Загрузить файл</label>
                                    </download-file>

                                    <mc-btn-image v-model="form.image_id" keys="image_id" format="webp.src.id.name">
                                        <label class="m-0">Mедиа-менеджер</label>
                                    </mc-btn-image>
                                </div>

                            </div>

                            <div class="col-3 relative trash-hover" v-if="form.image_id?.webp">
                                <img :src="form.image_id.webp" :alt="form.image_id.name" class="w-100 ">
                                <div @click="deleteImage(form.image_id)" class="absolute trash flex-center p-3"><i
                                    class="fa-solid fa-trash text-danger"></i></div>
                            </div>

                        </div>


                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label">Активность</label>
                        <mc-on-off v-model="form.active" keys="active"/>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="this.modalClose">Отмена</button>
                    <button type="button" class="btn btn-primary " @click="send()">
                        <span class="send">Сохранить</span>
                        <span class="spinner-container">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{
                            actions.find(item => item.id == this.storage.menu.action).name
                        }}</h4>
                    <button type="button" class="close" @click="this.modalClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="this.modalClose">Отмена</button>
                    <button type="button" class="btn btn-primary" @click="send" data-dismiss="modal" aria-label="Close">
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
import Children from './components/children.vue'

export default {
    name: "index",

    components: {
        Children
    },
    mounted() {
        this.getMenus()

    },
    data() {
        return {
            menus: [],

            actions: [
                {id: 'create', name: 'Новое меню'},
                {id: 'edit', name: 'Редактирование меню'},
                {id: 'delete', name: 'Удалить?'},
            ],
            form: {
                id: null,
                name: '',
                slug: '',
                image_id: {},
                active: true,
                parent: 0
            }
        }
    },
    methods: {
        resetForm() {
            this.form = {
                id: null,
                name: '',
                slug: '',
                image_id: {},
                active: true,
                parent: 0
            }
        },
        async deleteImage(image) {
            image.webp = null
            console.log(image)
            await axios.post(`/api/v1/images/${image.id}`, {
                _method: 'DELETE'
            }).then(data => {

                if (data) {
                    image.id = null
                    image.name = null
                    image.src = null
                    image.webp = null
                }
                console.log(data)


            }).catch((error) => {
                console.log(error)

            })

        },
        sortsCategory() {
            this.menus = this.menus.sort((a, b) => (a.sort > b.sort) ? 1 : -1);
            this.menus = this.menus.map(item => {
                item.items = item.items.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                return item
            })
        },
        async getMenus() {

            await axios.get('/api/v1/menus').then(data => {

                this.menus = data.data.data

            })


        },
        async updateSort(ids) {

            await axios.post('/api/v1/menus/update-sort',
                {
                    ids: ids,
                }
            ).then(data => {
                console.log(data)
            }).catch((error) => {

                console.log(error)

            })

        },
        end(el) {
            let ids;
            ids = [];

            $('.lists .parent').each(function (item, value) {


                if (ids.find(it => it.parent == $(value).parent('ul').attr('data-parent'))) {
                    ids.find(it => it.parent == $(value).parent('ul').attr('data-parent')).children.push({
                        id: $(value).attr('data-id'),
                        sort: item
                    })
                } else {
                    ids.push({
                        parent: $(value).parent('ul').attr('data-parent'),
                        children: [{id: $(value).attr('data-id'), sort: item}]
                    })
                }

            });
            this.updateSort(ids)

        },
        async send() {

            let url = '/api/v1/menus'
            if (this.storage.menu.action == 'edit' || this.storage.menu.action == 'delete') {
                url += `/${this.form.id}`
            }
            console.log(url)
            console.log(this.form)
            await axios.post(url, this.form).then(data => {
                if (data) {
                    $('#modal-slug').modal('hide')
                    this.menus = data.data.data
                    console.log(this.menus)
                    this.form = {
                        id: null,
                        name: '',
                        slug: '',
                        image_id: {},
                        active: true,
                        parent: 0
                    }
                }

            })


        },

    }
}
</script>

<style lang="scss">
ul, li {
    list-style: none;
}

.menu-row {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px 5px;


}

.menu-items {
    display: none;
}

.bg-gradient-black {
    width: 24px;
}

.card-info {
    padding: 20px;
}

.menu-container {
    .btn-container {
        .btn {
            width: 24px;
        }
    }

    li {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 10px 5px;
        min-width: 90%;
        list-style: none;
    }

    .border-none {
        border: none;
    }
}

.js-arrow {
    transition: transform 0.6s ease;
    border: 1px solid #000;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 12px;
}

.arrow-active {
    transition: transform 0.6s ease;
    transform: rotate(180deg);

}

.trash-hover:hover {
    .trash {
        opacity: .9 !important;
    }
}

.trash {
    transition: opacity 0.3s ease;
    top: 10px;
    right: 10px;
    opacity: 0;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    cursor: pointer;
    background: #fff;

}
</style>
