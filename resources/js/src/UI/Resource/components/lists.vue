<template>
    <div  class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список</h3>
            </div>
            <div class="card-body" v-if="this.storage.resource.resources && this.storage.resource.resources.data.length > 0">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th v-for="field in this.storage.resource.fields.filter(item => item.view === true)" :class="`mc-${field.type}`">{{ field.name }}</th>

                        <th style="width: 100px;">Действие</th>
                    </tr>
                    </thead>
                    <tbody style="position: relative;">

                    <tr v-for="resource in this.storage.resource.resources.data" >

                        <th style="width: 50px;">{{ resource.id }}</th>
                        <td v-for="field in this.storage.resource.fields.filter(item => item.view === true)">

                            <!--====================STRING====================-->
                            <template v-if="field.type == 'string'" :class="`mc-${field.type}`">
                                {{ resource[field.field] }}
                            </template>
                            <!--====================STRING====================-->


                            <!--====================IMAGE====================-->

                            <template v-if="field.type == 'image'" :class="`mc-${field.type}`">

                                <img v-if="resource[field.field]" :src="resource[field.field].webp"
                                     :alt="resource[field.field].name" >
                            </template>
                            <!--====================IMAGE====================-->


                            <!--====================IMAGES====================-->

                            <template v-if="field.type == 'images'" :class="`mc-${field.type}`">

                                <img v-if="resource[field.field][0] != undefined " :src="resource[field.field][0].webp"
                                     :alt="resource[field.field][0].name" >
                            </template>
                            <!--====================IMAGES====================-->


                            <!--====================FLOAT====================-->
                            <template v-if="field.type == 'float'" :class="`mc-${field.type}`">
                                {{ resource[field.field] }}
                            </template>
                            <!--====================FLOAT====================-->

                            <!--====================INTEGER====================-->
                            <template v-if="field.type == 'integer'" :class="`mc-${field.type}`">
                                {{ resource[field.field] }}
                            </template>
                            <!--====================INTEGER====================-->

                            <!--====================COLOR====================-->
                            <template v-if="field.type == 'color'" :class="`mc-${field.type}`">

                                <div v-if="resource[field.field]" :style="`background:${resource[field.field]} ;width:50px;height:50px`" ></div>
                                <img v-if="!resource[field.field] && resource['image_id']" :src="resource['image_id'].webp" :alt="resource['image_id'].name" style="width:50px">
                            </template>
                            <!--====================COLOR====================-->


                            <!--====================SELECT====================-->
                            <template v-if="field.type == 'select'" :class="`mc-${field.type}`">

                                {{field.selects.find(item => item.id == resource[field.field])?.name}}
                            </template>
                            <!--====================SELECT====================-->


                            <!--====================ACTIVE====================-->
                            <template v-if="field.type == 'active'" :class="`mc-${field.type}`">
                                <div class="flex-center">
                                    <button @click="this.$parent.changeActive(resource,field)" title="Изменить?" type="button" class="btn  btn-sm btn-block" :class="resource[field.field] ? 'btn-success': 'btn-danger'">{{resource[field.field] ? 'Активный': 'Не активный'}}</button>
                                </div>
                            </template>
                            <!--====================ACTIVE====================-->
                        </td>


                        <td>
                            <div class="flex gab-5">
                                <router-link :to="`/admin/resource/${this.$route.params.action}/${resource.id}`"
                                             class="btn btn-outline-dark bg-gradient-success btn-xs"
                                             title="Редактировать" type="button">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </router-link>
                                <button @click="this.$parent.deleteResource(resource)" title="Удалить" type="button" class="btn bg-gradient-danger btn-xs">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="card-body" v-else>
                <h2>Нет ресурсов или измените фильтр запроса</h2>
            </div>
            <div class="card-footer mt-3 flex ai-center jc-end">
                <div class="clearfix flex">
                    <Paginate :paginate="this.storage.resource.resources" ></Paginate>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
import Paginate from '/resources/js/src/UI/Paginate/paginate.vue'
export default {
    components:{
        Paginate
    },
    methods:{
        async getModel() {

            this.$parent.getModel()

        },
    },

name: "lists"
}
</script>

<style scoped lang="scss">
.mc-active{
    width: 125px;
    text-align: center;
}
.mc-image ,.mc-image-upload{
    width: 150px;

}
td:has(img){
    display:flex;
    justify-content: center;
}
td {

    img{

        max-height: 80px;
    }
}
.mc-integer{
    width: 100px;
    text-align: center;
}
.mc-color{
    width: 60px;
}
</style>
