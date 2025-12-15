<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">
                            <button type="button" class="btn btn-sm mr-3 "
                                    @click="this.storage.page.active = !this.storage.page.active"
                                    :class="this.storage.page.active ? 'btn-primary' : 'btn-secondary'">
                                {{this.storage.page.active ? 'Деактивность' : 'Активировать'}}
                            </button>
                            <button type="button" class="btn btn-danger btn-sm mr-3">Удалить</button>
                            <button @click="slideUpContainer" type="button" class="btn btn-warning btn-sm float-right">Свернуть все</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "panel",
    props:{
        pageData:Object,
    },
    methods:{
        slideUpContainer(){
            $('.fa-minus').trigger('click')
        }
    }
}
</script>

<style scoped>

</style>
