<template>
    <section class="content" v-if="load">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body flex gab-20">
                        <div class="flex ai-center gab-10 col-5">
                            <router-link to="/admin/forms" class="btn btn-sm btn-primary flex ai-center gab-10">
                                <i class="fa-solid fa-list"></i>
                                <span >К списку </span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="flex gab-20 ai-center">
                                <h3 class="card-title">Форма</h3>

                            </div>


                            <div class="card-tools">
                                <button type="button" class="btn btn-tool float-right" data-card-widget="collapse"
                                        title="Collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">

                                <div class="card-body">

                                    <div class=" row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Наименование</label>
                                                <mc-input class="form-control" v-model="this.storage.form.name"
                                                          keys="name"/>
                                            </div>
                                        </div>
                                        <div class="col-2" v-if="this.storage.form.popup">
                                            <div class="form-group">
                                                <label>Метод вызова</label>
                                                <mc-input class="form-control" v-model="this.storage.form.method"
                                                          keys="method"/>
                                            </div>
                                        </div>
                                        <div class="col-2" v-if="this.storage.form.popup">
                                            <div class="form-group">
                                                <label>Размер</label>

                                                <mc-select class="form-control" :selects="sizes"
                                                           v-model="this.storage.form.size"></mc-select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group text-center">
                                                <label>PopUp</label>
                                                <mc-on-off v-model="this.storage.form.popup" keys="popup"></mc-on-off>

                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group text-center">
                                                <label>Логотип</label>
                                                <mc-on-off v-model="this.storage.form.logo" keys="logo"></mc-on-off>

                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Отправлять данные в bitrix</label>
                                                <mc-on-off v-model="this.storage.form.bitrix" keys="bitrix"></mc-on-off>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Сохранять данные </label>
                                                <mc-on-off v-model="this.storage.form.save" keys="save"></mc-on-off>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Согласие на обработу персональных данных </label>
                                                <mc-on-off v-model="this.storage.form.statement" keys="statement"></mc-on-off>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" row" v-if="this.storage.form.statement">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Текст Согласие на обработу персональных данных</label>
                                                <mc-html v-model="this.storage.form.statement_text" keys="statement_text"></mc-html>

                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <button @click="createFormRow" type="button" class="btn btn-sm btn-primary">
                                    <span class="flex ai-center gab-10">
                                    <i class="fa-solid fa-list"></i>
                                    <span>Создать ряд</span>
                                </span>
                                    </button>
                                </div>
                                <div class="card-body">

                                    <div class="card" v-for="(row , indexRow) in this.storage.form.data">
                                        <div class="card-header flex ai-center gab-20">
                                            <h4>Ряд: {{ indexRow + 1 }}</h4>
                                            <div class="form-group flex gab-20 ai-center m-0">
                                                <label> Колонок</label>
                                                <mc-input class="form-control"
                                                          v-model="this.storage.form.data[indexRow].col" max="3"
                                                          type="number" min="1"></mc-input>

                                            </div>
                                            <button @click="this.storage.form.data.splice(indexRow,1)" type="button"
                                                    class="btn btn-sm btn-danger" role="button">Удалить ряд
                                            </button>

                                        </div>
                                        <div class="card-body">
                                            <div class="row ">
                                                <div
                                                    v-for="col in Number(this.storage.form.data[indexRow].col)"
                                                    :class="`col-${12 / this.storage.form.data[indexRow].col}`"
                                                    class="flex  column ai-center">

                                                    <span>
                                                        <button
                                                            v-if="!this.storage.form.data[indexRow].cols.find(it => it.id == col)"
                                                            @click="openSideBar(indexRow,col)" type="button"
                                                            class="btn btn-sm btn-primary"
                                                            role="button">Добавить поле
                                                    </button>
                                                   </span>
                                                    <span class="flex gab-20">
                                                        <span>
                                                            <button
                                                                v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col)"
                                                                @click="deleteForm(indexRow,col)" type="button"
                                                                class="btn btn-sm btn-danger"
                                                                role="button">Удалить поле
                                                    </button>
                                                        </span>

                                                           <mc-on-off data-label-text="Обязательное?"
                                                                      v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col)"
                                                                      v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).required"
                                                                      keys="check"></mc-on-off>



                                                    </span>

                                                    <div :id="`TabContent-${indexRow}-${col}`" class="w-100">
                                                        <div
                                                            v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col)"
                                                            class="col-12" v-auto-animate>

                                                            <div class="form-group mt-3" >
                                                                <label>Уникальный ключ </label>
                                                                <mc-input class="form-control"
                                                                          v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).keys" :keys="`data.${indexRow}.cols.${col - 1}`"></mc-input>

                                                            </div>

                                                            <div class="form-group mt-3" v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.min != undefined">
                                                                <label title="при пустом значение параметры не учитываются (default)">Минимальное число (?)</label>
                                                                <mc-input class="form-control" placeholder="при пустом значение параметры не учитываются"
                                                                          v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.min"></mc-input>
                                                            </div>
                                                            <div class="form-group mt-3" v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.max != undefined">
                                                                <label title="при пустом значение параметры не учитываются (default)">Максимальное число (?)</label>
                                                                <mc-input class="form-control" placeholder="при пустом значение параметры не учитываются"
                                                                          v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.max"></mc-input>
                                                            </div>
                                                            <div class="form-group mt-3" v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.rows != undefined">
                                                                <label title="при пустом значение параметры не учитываются (default)">Количество рядов (?)</label>
                                                                <mc-input class="form-control" placeholder="при пустом значение параметры не учитываются"
                                                                          v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.rows"></mc-input>
                                                            </div>
                                                            <div class="form-group mt-3" v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.cols != undefined">
                                                                <label title="при пустом значение параметры не учитываются (default)">Количество колонок (?)</label>
                                                                <mc-input class="form-control" placeholder="при пустом значение параметры не учитываются"
                                                                          v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.cols"></mc-input>
                                                            </div>

                                                            <div class="form-group mt-3" v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.options != undefined">
                                                                <label title="">Опции (?)</label>
                                                                <div class="row">
                                                                    <div class="col"  v-for="day in days">
                                                                        <div class="flex column jc-center">
                                                                            <label class="flex-center">{{day.name}}</label>
                                                                            <label class="flex-center ml-2">
                                                                                <input type="checkbox" class="form-check-input" :value="day.id" v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.options.disabledWeekDays">
                                                                            </label>

                                                                        </div>
                                                                     </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <label> исключить плюс n дней </label>
                                                                    <mc-input type="number" class="form-control" v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.options.addDays"></mc-input>
                                                                </div>

                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label>{{
                                                                        this.storage.form.data[indexRow].cols.find(it => it.id == col).label
                                                                    }}</label>
                                                                <label>Наименование поля LABEL</label>
                                                                <mc-input
                                                                    v-model="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.label"
                                                                    class="form-control" :keys="`data.${indexRow}.cols.${col - 1}.data.label`"></mc-input>

                                                                <div class="row mt-3"
                                                                     v-if="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.selects">

                                                                    <div class="col-12 flex gab-20 ai-center mt-3">

                                                                        <mc-select v-model="valueSelect"
                                                                                   class="form-control"
                                                                                   :selects="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.selects">
                                                                            <button v-if="valueSelect"
                                                                                    @click="this.storage.form.data[indexRow].cols.find(it => it.id == col).data.selects.splice(this.storage.form.data[indexRow].cols.find(it => it.id == col).data.selects.findIndex(t => t.name == valueSelect),1);valueSelect = 0"
                                                                                    style="width: 200px;" type="button"
                                                                                    class="btn btn-sm btn-danger">
                                                                                Удалить из списка
                                                                            </button>

                                                                        </mc-select>
                                                                    </div>
                                                                    <div class="col-12 flex gab-20 mt-3">

                                                                        <mc-input class="form-control"
                                                                                  v-model="nameSelect">
                                                                            <button
                                                                                @click="nameSelect != '' ? this.storage.form.data[indexRow].cols.find(it => it.id == col).data.selects.push({name:nameSelect}) : '';nameSelect =''"
                                                                                style="width: 200px;" type="button"
                                                                                class="btn btn-sm btn-primary">Добавить
                                                                                в список
                                                                            </button>
                                                                        </mc-input>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

    mounted() {
        if (this.$route.params.params) {
            this.getForm()
        } else {
            this.load = true
        }
    },
    data() {
        return {
            valueSelect: 0,
            nameSelect: '',
            load: false,
            concants:[
                {name:'category'},
                {name:'offer'},
            ],
            days:[
                {id:0,name:'Вс'},
                {id:1,name:'Пн'},
                {id:2,name:'Вт'},
                {id:3,name:'Ср'},
                {id:4,name:'Чт'},
                {id:5,name:'Пт'},
                {id:6,name:'Сб'},
            ],
            sizes: [
                {
                    id: 'modal-sm', name: '300px'
                },
                {
                    id: '', name: '500px'
                },
                {
                    id: 'modal-lg', name: '800px'
                },
                {
                    id: 'modal-xl', name: '1140px'
                },
            ],
            currentRow: 0,
        }

    },
    methods: {
        async getForm() {

            await axios.get(`/api/v1/forms/${this.$route.params.params}`).then(data => {
                this.storage.form = data.data
                if (data) {
                    this.load = true
                }

            }).catch((error) => {
                console.log(error)

            })

        },
        deleteForm(indexRow, col) {

            this.storage.form.data[indexRow].cols.splice(this.storage.form.data[indexRow].cols.findIndex(item => item.id == col), 1)
        },
        openSideBar(indexRow, col) {
            this.storage.form.currentRow = indexRow
            this.storage.form.currentCol = col
            this.storage.aside = 'form'
            $(".control-sidebar").ControlSidebar('toggle');
        },
        createFormRow() {
            this.storage.form.data.push({
                id: this.storage.form.data.length,
                col: 1,
                cols: []
            })
            this.storage.form.currentRow = this.storage.form.data.length - 1


        }
    }
}
</script>

<style scoped>

</style>
