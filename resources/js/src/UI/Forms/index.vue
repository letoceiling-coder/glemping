<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Формы</h1>
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


            <div class="card">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card-body">
                            <component :is="route"></component>
                        </div>
                        <div class="card-footer">
                            <button @click="save" type="button" class="btn btn-primary float-right mb-2 mt-2">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Lists from './components/lists.vue'
import Form from './components/form.vue'
export default {
    name: "index",
    components:{
        lists:Lists,
        update:Form
    },
    mounted() {
        if (this.$route.params.action == '') {
            this.route = 'lists'
        } else {
            this.route = 'update'
        }
    },
    data() {
        return {
            route: 'lists'
        }
    },
    methods: {
        async save() {
            let url = '/api/v1/forms'

            if (this.$route.params.action == 'update'){
                url += `/${this.$route.params.params}`
                this.storage.form._method = 'PUT'
            }
            await axios.post(url, this.storage.form).then(data => {
                if (data) {
                    console.log(data.data)
                    this.$router.push(`/admin/forms`)
                }

            }).catch((error) => {
                console.log(error)

            })
        }
    }
}
</script>

<style scoped>

</style>
