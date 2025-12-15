<template>

    <div class="row">
        <div class="col-12">
            <div class="card col-12">
                <div class="card-header flex gab-10 ai-center">
                    <h5>{{ setting.label }}</h5>
                    <button @click="addRow" type="button" class="btn btn-primary btn-sm">Добавить</button>

                </div>
                <div class="card-body">
                    <div class="card col-12" v-for="(item, index) in setting.value">
                        <div class="card-header flex gab-10 ai-center">
                            <button @click="setting.value.splice(index,1)" type="button" class="btn btn-danger btn-sm">Удалить</button>
                            <label class="flex gab-10 ai-center">Открыт: <mc-on-off v-model="item.active" keys="check"></mc-on-off></label>
                        </div>
                        <div class="card-header">
                            <div class="form-group" >
                                <div class="row">
                                    <label>Вопрос</label>
                                    <mc-textarea v-model="item.question" class="form-control" />

                                </div>
                                <div class="row">
                                    <label>Ответ</label>
                                    <mc-html v-model="item.answer"  />

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
    name: "price",
    props: {
        setting: Object
    },
    methods:{
        addRow(){
            this.setting.value.push({
                question:"Вопрос",
                answer:"Ответ",
                active:false,
            })
        }
    }
}
</script>

<style scoped>

</style>
