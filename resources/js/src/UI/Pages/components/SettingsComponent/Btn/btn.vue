<template>
    <div class="row card">
        <div class="col-12">
            <div class="card-header flex gab-20">
                <h3>{{setting.label}}</h3>
                <mc-on-off v-model="setting.on" keys="check"></mc-on-off>
            </div>
            <div class="form-group">
                <div class="card-body">

                    <div class="form-group">
                        <label>Текст</label>
                        <mc-input class="form-control" type="text" v-model="setting.text"/>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Назначение кнопки</label>
                            <mc-select :selects="methods" class="form-control" v-model="setting.method"/>

                        </div>
                    </div>
                    <div class="form-group" v-if="setting.method == 'method'">
                        <label>Метод</label>
                        <mc-select class="form-control" :selects="methodsAll"
                                   v-model="setting.route">

                        </mc-select>
                    </div>

                    <div class="form-group" v-if="setting.method == 'slug'">
                        <label>Ссылка</label>
                        <input class="form-control" type="text" v-model="setting.route">
                    </div>


                    <div class="form-group">
                        <div class="form-group">
                            <label>Вид кнопки</label>
                            <mc-select :selects="btnViews" class="form-control"
                                       v-model="setting.view">

                            </mc-select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "btn",
    props: {
        setting: Object
    },
    mounted() {
        this.getForm()
    },
    methods:{
        async getForm() {

            await axios.get(`/api/v1/forms`, {
                params: {
                    active: true
                }
            }).then(data => {

                this.methodsAll = data.data.data.map(item => {
                    return{
                        name:item.method
                    }
                })



            }).catch((error) => {
                console.log(error)

            })

        },
    },
    data() {
        return {
            methods: [
                {id: 'method', name: 'Метод'},
                {id: 'slug', name: 'Ссылка'},
            ],
            methodsAll: [
                // {name: 'modal-signUp'},
                // {name: 'modal-signUpForm'},
            ],
            btnViews: [
                {id: '', name: 'Без стилей'},
                {id: 'btn-default', name: 'Голубая'},
                {id: 'btn-my-light', name: 'Светлоголубая'},
            ],
        }
    },
}
</script>

<style scoped>

</style>
