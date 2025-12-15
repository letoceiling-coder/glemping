<template>

    <div class="row">

        <div class="col-12 card" >
            <div class="card-header">
                {{ setting.label }}
            </div>
            <div class="card-body" v-for="card in setting.data">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Заголовок</label>
                            <mc-input type="text" class="form-control" v-model="card.title"/>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>Расположение текста</label>
                            <mc-select :selects="locations" class="form-control" v-model="card.textLocation"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Подзаголовок</label>
                            <mc-input type="text" class="form-control" v-model="card.sub"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Фото</label>
                            <setting-image :setting="card"></setting-image>
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
    data(){
        return{
            locations:[
                {id:'top',name:'Сверху'},
                {id:'bottom',name:'Снизу'},

            ]
        }
    }
}
</script>

<style scoped>

</style>
