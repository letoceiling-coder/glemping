<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" v-if="forms.length > 0 "
         v-for="form in forms"

         aria-hidden="true" :id="form.method">

        <div class="modal-dialog " :class="form.size">

            <div class="modal-content relative">

                <div class="modal-header">

                    <button type="button" class="close" @click="this.modalClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="flex-center column mt-2 mb-5 w-70">
                        <div class="logo w-100 flex-center" v-if="form.logo">
                            <img :src="'/img/povuzam-logo.png'"
                                 alt="logo" class="w-100">
                        </div>

                        <h2 class="pb-4" v-if="form.name">{{ transStr(form.name) }}</h2>

                        <div class="row w-100" v-for="(row,indexRow) in form.data">
                            <div v-for="col in Number(row.col)"
                                 :class="`col-lg-${12 / row.col}`"
                                 class="form-group col-sm-12">
                                <!--                                <pre>{{row.cols.find(it => it.id == col)}}</pre>-->

                                <template
                                    v-if="row.cols.find(it => it.id == col) && !row.cols.find(it => it.id == col).data.selects">
                                    <label>{{ row.cols.find(it => it.id == col).data.label }}</label>
                                    <component
                                        :is="row.cols.find(it => it.id == col).data.id" class="form-control"
                                        v-model="row.cols.find(it => it.id == col).data.value"
                                        :type="row.cols.find(it => it.id == col).data.type"
                                        :keys="row.cols.find(it => it.id == col).keys"
                                        :min="row.cols.find(it => it.id == col).data.min"
                                        :max="row.cols.find(it => it.id == col).data.max"
                                        :rows="row.cols.find(it => it.id == col).data.rows"
                                        :cols="row.cols.find(it => it.id == col).data.cols"
                                        :options="row.cols.find(it => it.id == col).data.options"
                                    ></component>
                                </template>
                                <template
                                    v-if="row.cols.find(it => it.id == col) && row.cols.find(it => it.id == col).data.selects">
                                    <label>{{ row.cols.find(it => it.id == col).data.label }}</label>
                                    <component
                                        :is="row.cols.find(it => it.id == col).data.id" class="form-control"
                                        v-model="row.cols.find(it => it.id == col).data.value"
                                        :selects="row.cols.find(it => it.id == col).data.selects"
                                        :keys="row.cols.find(it => it.id == col).keys"
                                    ></component>
                                </template>


                            </div>
                        </div>
                        <div class="row w-100" v-if="form.statement">
                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <mc-checkbox v-model="form.statement_check" keys="statement_text">
                                        <span class="ml-2" v-html="form.statement_text"> </span>
                                    </mc-checkbox>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12 flex-center">
                            <Btn @click="send(form)">Оставить заявку</Btn>
                        </div>
                        <div class="col-lg-12 col-xs-12 mt-3 pb-5">

                            <span class="text-grey " :class="this.storage.width > 767 ? 'flex-center m-column' :''"> Продолжая использовать сервис, я принимаю
                                <router-link to="/offer" class="ml-2" @click="this.modalClose"> условия оферты </router-link>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "modals",
    data() {
        return {
            forms: [],

        }
    },
    mounted() {
        this.getForms()

    },
    methods: {
        transStr(str) {
            if (str.includes("{category}")) {
                str = str.replace('{category}', this.storage.category.name)

            }

            return str
        },

        async getForms() {

            await axios.get('/api/v1/forms', {
                params: this.form
            }).then(data => {
                this.forms = data.data.data
                console.log(this.forms)

            }).catch((error) => {
                console.log(error)

            })

        },

        async send(form) {
            if (this.storage.sendLoading == 0){
                this.storage.sendLoading = 1;
                if (this.storage.offer) {
                    form.offer_id = this.storage.offer
                }
                if (this.storage.user) {
                    form.user = this.storage.user.id
                }

                console.log(form)
                await axios.post('/api/v1/email/send', form).then(data => {
                    if (data){

                        $('.modal').modal('hide')
                        $('#modal-Thank').modal('show')
                    }


                }).catch((error) => {
                    console.log(error)

                })
            }


        }
    }
}
</script>

<style scoped>

</style>
