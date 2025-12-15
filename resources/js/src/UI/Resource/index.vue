<template>
    <div class="content-header" v-if="!this.storage.media.active">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ресурсы
                        <span v-if="this.$route.params.action"> - {{ namesComponent.find(item => item.name == this.$route.params.action)?.text }}</span>

                    </h1>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <component :is="this.$route.params.template"></component>
        </div>

    </section>
</template>

<script>
import Resource from './components/resource.vue'

export default {
    name: "index",
    components: {
        resource: Resource
    },
    data(){
        return{
            namesComponent:[
                {
                    name:'users',
                    text:'Пользователи'
                },

            ]
        }
    },
}
</script>

<style scoped>

</style>
