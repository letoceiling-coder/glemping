<template>

    <div class="row">
        <div class="col-12" >
            <div class="card">
                <div class="card-header">Фото основное</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <mc-btn-image v-model="setting.value.image" keys="image" format="webp.src.id.name"></mc-btn-image>

                            </div>
                        </div>
                        <div class="col">
                            <img :src="setting.value.image.src" :alt="setting.value.image.name" style="width: 150px;">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">Лейблы</div>
                <div class="card-body">
                    <div class="row">
                        <div class="card col-12" v-for="card in setting.value.cards">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Тип информера</label>
                                    <mc-select :selects="types" v-model="card.type" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <mc-input  v-model="card.text" class="form-control"/>
                                </div>
                                <div class="form-group" v-if="card.type == 1">
                                    <label>Иконка</label><br>
                                    <mc-btn-icon-picker v-model="card.icon" :btn="true"></mc-btn-icon-picker>
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
