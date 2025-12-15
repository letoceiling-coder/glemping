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
                                <label>Расположение текста</label>
                                <mc-select :selects="positions" class="form-control" v-model="item.positionText"/>
                            </div>
                            <div class="form-group" >
                                <label>Текст</label>
                                <mc-html v-model="item.text"/>
                            </div>
                            <div class="form-group" >
                                <div class="row">
                                    <div class="col">
                                        <label>Фото</label>
                                        <mc-btn-image v-model="item.image" keys="image" format="webp.src.id.name"></mc-btn-image>
                                    </div>
                                    <div class="col">
                                        <img :src="item.image.webp" :alt="item.image.name" style="width: 150px;">
                                    </div>
                                </div>

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
            this.setting.value.push({
                image:{
                    id:'',
                    name:'',
                    src:'',
                    webp:'',
                },
                text:'Какойто текст',
                positionText:'top'
            })
        }
    },
    data(){
        return{
            positions:[
                {id:'top',name:'Сверху'},
                {id:'center',name:'По центру'},
                {id:'bottom',name:'Снизу'},
            ]
        }
    }
}
</script>

<style scoped>

</style>
