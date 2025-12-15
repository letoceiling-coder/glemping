<template>
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Страницы</h1>
                </div>

            </div>
        </div>
    </div>
    <Panel/>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                               aria-controls="seo" aria-selected="true">Данные страницы</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pages-tab" data-toggle="tab" href="#pages" role="tab"
                               aria-controls="pages" aria-selected="false">Контент</a>
                        </li>

                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                            <Seo/>
                        </div>
                        <div class="tab-pane fade" id="pages" role="tabpanel" aria-labelledby="pages-tab">
                            <Contents/>
                        </div>

                    </div>
                </div>
                <div class="card-footer">

                    <button @click="send" type="button" class="btn btn-primary float-right ">
                        <span class="send">Сохранить</span>
                        <span class="spinner-container">
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>
                    </button>
                </div>
            </div>

        </div>

    </section>
</template>

<script>
import Panel from './components/panel.vue'
import Seo from './components/seo.vue'
import Contents from './components/content.vue'

export default {
    name: "index",
    components: {
        Seo, Panel, Contents
    },
    data() {
        return {
            form: this.storage.page
        }
    },
    mounted() {

        if (this.$route.params.action) {
            this.form.id = this.$route.params.action
            this.getPage()
        }else {
            this.resetPage()

        }


    },
    methods: {
        resetPage(){
            this.storage.page = {
                currentContainer:0,
                title: '',
                description: '',
                head: '',
                name: '',
                slug: '',
                active: true,
                publish: false,
                data: [],
            }
        },
        sorters() {
            let _ = this
            $('.list-component').each(function (item, value) {

                _.storage.page.data[$(value).attr('data-index')].sort = item

            });
            $('.list-indexComponent').each(function (item, value) {

                _.storage.page.data[$(value).attr('data-index')].setting.components[$(value).attr('data-indexComponent')].sort = item

            });

        },
        async getPage() {


            await axios.get(`/api/v1/pages/${this.$route.params.action}`).then(data => {
                console.log(data.data)

                this.storage.page.active = data.data.active
                this.storage.page.data = data.data.data.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                this.storage.page.data = data.data.data.map(item => {
                    item.setting.components.sort((a, b) => (a.sort > b.sort) ? 1 : -1)
                    return item
                })
                this.storage.page.description = data.data.description
                this.storage.page.head = data.data.head
                this.storage.page.name = data.data.name
                this.storage.page.publish = data.data.publish
                this.storage.page.slug = data.data.slug
                this.storage.page.title = data.data.title

            }).catch((error) => {
                console.log(error)

            })
        },
        async send() {

            this.sorters()
            let url = '/api/v1/pages'
            this.storage.page._method = 'POST'
            if (this.storage.page.id) {
                url += '/' + this.storage.page.id;
                this.storage.page._method = 'PUT';
            }

            await axios.post(url, this.storage.page).then(data => {
                console.log(data.data)
                this.resetPage()
                this.$router.push(`/admin/pages/${data.data.id}`)
            }).catch((error) => {
                console.log(error)

            })
        },

    }
}
</script>

<style scoped>

</style>
