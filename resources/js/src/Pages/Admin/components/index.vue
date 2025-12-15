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
                                <div class="form-group">



                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
<!--                            <button @click="save" type="button" class="btn btn-outline-dark float-sm-right">-->
<!--                                <span class="send">Сохранить</span>-->
<!--                                <span class="spinner-container">-->
<!--                                    <span class="spinner-border spinner-border-sm"></span>-->
<!--                                </span>-->
<!--                            </button>-->
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

        console.log(this.Helper.checkAccess(this.$route.params.template))
    },
    data(){
        return{
            access:false
        }
    },
    methods:{
        async checkMenu() {

            await axios.post(`/api/v1/admin/menu/${this.$route.params.template}`).then(data => {
                if (this.Helper.isAccess(data.data.role)){

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
