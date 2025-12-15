<template>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Настройки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> admin</li>
                        <li class="breadcrumb-item active">dashboard</li>


                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card" >
                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body" >
                            <div class="col-12">
                                <div class="form-group" v-for="item in this.storage.settings.const">

                                    <component :is="`setting-${item.type}`" :setting="item"></component>

                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button @click="send" type="button" class="btn btn-outline-dark float-sm-right">
                                <span class="send">Сохранить</span>
                                <span class="spinner-container">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {
    name: "index",
    mounted() {


    },
    data(){
        return{

        }
    },
    methods:{
        async send() {
            $('.spinner-container').show()
            $('.send').hide()
            console.log(this.storage.settings.const)

            await axios.post('/api/v1/settings',this.storage.settings.const).then(data => {
                console.log(data.data)
                this.storage.settings.const = data.data
            }).catch((error) => {
                console.log(error)

            }).finally(() => {
                $('.spinner-container').hide()
                $('.send').show()
            });
        },
    }
}
</script>

<style scoped>

</style>
