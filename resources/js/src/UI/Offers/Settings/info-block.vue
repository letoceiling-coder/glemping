<template>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Наименование</label>
                <div class="col-6">
                    <div class="form-group flex ai-center gab-20">
                        <mc-input v-model="name" class="form-control"></mc-input>
                        <button @click="addGroup" type="button" class="btn btn-outline-dark flex-center m-0">Создать</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div  @update="onUpdate"
          v-sortable="{disabled: false, options: {handle: '.handle-component', animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }">
        <div class="col-12" v-for="(info,indexInfo) in this.data.value">
            <div class="card lists-form-info" :data-index="indexInfo">
                <div class="card-header ">
                    <h3 class="card-title">
                        <div class="flex ai-center gab-20">
                            <i class="handle-component fa-solid fa-arrows-up-down-left-right"></i>
                            <span>{{
                                    info.name
                                }}</span>
                            <button @click="this.data.value.splice(index,1)" type="button" class="btn btn-danger btn-sm">Удалить</button>
                        </div>
                    </h3>
                    <div class="card-tools  ">
                        <button type="button" class="btn btn-tool float-right"
                                data-card-widget="collapse"
                                title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="col-12">
                        <div class="form-group">
                            <mc-input-icon :input="info" keys="inputicon.text" class="form-control"/>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "info-block",
    props: {
        data: Object
    },
    data() {
        return {
            name: '',
            groups:[
                {
                    name:'Место встречи',
                    icon:'fas fa-map-marker-alt',
                    text:'ул. Миклухо-Маклая, 6, Москва, 117198',
                    sort:0,
                },
                {
                    name:'Продолжительность',
                    icon:'far fa-clock',
                    text:'2 часа',
                    sort:1,
                },
                {
                    name:'Группа',
                    icon:'fas fa-user-friends',
                    text:'от 10 человек',
                    sort:2,
                },
                {
                    name:'О вузе',
                    icon:'fas fa-info-circle',
                    text:'РУДН — университет мира: студенты из 160 стран, десятки направлений и уникальная атмосфера глобального кампуса.',
                    sort:3,
                },
            ]
        }
    },
    mounted() {

    },
    created() {
        if (!this.data.value) {
            this.data.value = this.groups
        }
    },
    methods:{
        onUpdate(){

            let info = this.data.value

            $('.lists-form-info').each(function (item, value) {
                info[$(value).attr('data-index')].sort = item
            })
            console.log(this.data.value)

        },
        addGroup(){
            if (!this.name) {
                this.$notify({
                    title: "Уведомление:",
                    text: "Незаполнено поле наименование ",
                    type: 'error',
                })
            } else if (this.data.value.find(item => item.name == this.name)) {
                this.$notify({
                    title: "Уведомление:",
                    text: "Такое наименование существует",
                    type: 'error',
                })
            } else {
                this.data.value.push({
                    name: this.name,
                    icon: '',
                    input: '',
                    sort: this.data.value.length,
                })
                this.name = ''
            }
        }
    }
}
</script>

<style scoped>

</style>
