<template>
    <div class="row">
        <div class="col-12" >

            <div class="card col-12">
                <div class="card-header flex ai-center gab-20">
                    <h5>{{ setting.label }}</h5>
                    <button type="button" class="btn btn-sm btn-primary" @click="addFaq">Добавить  </button>
                </div>
                <div class="card-body" v-for="(item,index) in setting.data">
                   <div class="card">
                       <div class="card-header flex ai-center gab-20">

                           <button type="button" class="btn btn-sm btn-danger" @click="setting.data.splice(index,1)">Удалить  </button>
                       </div>
                       <div class="card-body">
                           <div class="form-group">
                               <label>Вопрос</label>
                               <mc-input class="form-control" v-model="item.question"></mc-input>
                           </div>
                           <div class="form-group">
                               <label>Ответ</label>
                               <mc-textarea class="form-control" v-model="item.answer"></mc-textarea>
                           </div>
                           <div class="form-group">
                               <label>Открытый?</label>
                               <mc-on-off v-model="item.active" keys="check"></mc-on-off>
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
    mounted() {

    },
    methods:{
        addFaq(){
            this.setting.data.push(
                {
                    question:'Вопрос?',
                    answer:'Ответ ',

                }
            )
        }
    }

}
</script>

<style scoped>

</style>
