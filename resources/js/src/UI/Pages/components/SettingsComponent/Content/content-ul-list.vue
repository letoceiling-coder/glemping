<template>

    <div class="row">
        <div class="col-12" >
            <div class="card">
                <div class="card-header flex ai-center gab-10">
                    <h5>Список</h5>
                    <button @click="addSelect" type="button" class="btn btn-sm btn-primary">Добавить в список</button>
                </div>
                <div class="card-body">
                    <div class="card" v-for="(item,index) in setting.value">
                        <div class="card-header">
                            <button @click="setting.value.splice(index,1)" type="button" class="btn btn-sm btn-danger">Удалить</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group" >
                                <label></label>
                                <mc-input class="form-control" v-model="setting.value[index]"/>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</template>

<script>
export default {
    props: {
        setting: Object
    },
    methods:{
        addSelect(){
            this.setting.value.push('Какой то текст')
        }
    },
    data(){
        return{
            types:[
                {
                    id:1,
                    name:'Черный с иконкой'
                },
                {
                    id:2,
                    name:'Голубой'
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
