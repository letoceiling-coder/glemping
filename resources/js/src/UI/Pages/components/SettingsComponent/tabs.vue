<template>

<!--    <div class="row">-->
<!--        <div class="col-12">-->
<!--            <div class="form-group">-->
<!--                <label>{{ setting.label }}</label>-->

<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="form-group"><label>Наименование</label>
                    <mc-input class="form-control" v-model="name"/>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Ссылается на шаблон</label>
                    <div class="flex gab-10">
                        <mc-select class="form-control" v-model="tab" :selects="selects"></mc-select>
                        <button  @click="createTab(setting.tabs)"type="button" class="btn btn-outline-dark float-right">Создать
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-center" @update="onUpdateTabs(setting.tabs)" v-sortable="{ handle: '.handle' ,options: {animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)'}}">

                <span v-for="(tabs,indTab) in setting.tabs" class="flex gab-10 ai-center span-tabs" :data-id="tabs.id">
                    <i class="fa-solid fa-trash-can text-danger" @click="setting.tabs.splice(indTab,1)"></i>
                    <span>{{tabs.text}}</span>
                    <i class="fa-solid fa-arrows-up-down-left-right cursor-pointer"></i>
                </span>
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
            tab:'',
            name:'',
            selects:[],
        }
    },
    methods:{
        onUpdateTabs(item){
            let tabs = item.tabs
            $('.span-tabs').each(function (item, value) {

                tabs.find(t => t.id == $(value).attr('data-id')).sort = item
            })


        },
        createTab(item){
            this.setting.tabs.push({id:this.tab,text:this.name,sort:0})
            this.tab = ''
            this.name = ''
        },
    },
    mounted() {
         this.storage.page.data.map(item => {
           return  item.setting.components.map(c => {

               this.selects.push({
                   id:c.id,
                   name:c.name,
               })
            })
        })
        console.log(this.setting.tabs)

    }
}
</script>

<style scoped>
.span-tabs{
    padding: 0 30px;
    color: #007bff;
    background: #f4f5f5;
    border-radius: 41.5px;
    height: 50px;
}
</style>
