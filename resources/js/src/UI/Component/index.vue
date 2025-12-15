<template>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Настройки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> admin</li>
                        <li class="breadcrumb-item active">components</li>



                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body">
                            <div class="col-12">
<!--                                <div class="form-group">-->


<!--                                    <mc-input v-model="form.input" keys="input" class="form-control"/>-->
<!--                                    <mc-input v-model="form.inputs" keys="inputs" class="form-control"/>-->
<!--                                    <mc-input-icon :input="form.inputicon" keys="inputicon.text" class="form-control"/>-->


<!--                                    <mc-btn-icon-picker v-model="form.icon" :btn="true"></mc-btn-icon-picker>-->

<!--                                    <mc-textarea  v-model="form.textarea" keys="textarea" class="form-control"></mc-textarea>-->

<!--                                    <mc-select v-model="form.select" :selects="selects" keys="select" class="form-control">-->
<!--                                        <template #option>-->
<!--                                            <mc-option/>-->
<!--                                        </template>-->
<!--                                    </mc-select>-->

<!--                                    <mc-select-one v-model="form.select_one" :selects="selects" keys="select_one" class="form-control">-->
<!--                                        <template #option>-->
<!--                                            <mc-option/>-->
<!--                                        </template>-->
<!--                                    </mc-select-one>-->

<!--                                    <mc-select-too v-model="form.select_two" :selects="selects" keys="select_two" class="form-control">-->

<!--                                    </mc-select-too>-->
<!--                                    <mc-on-off v-model="form.check" keys="check"></mc-on-off>-->
<!--                                    <mc-phone v-model="form.phone" keys="phone"></mc-phone>-->
<!--                                    <mc-data-picker v-model="form.date" keys="date"></mc-data-picker>-->
<!--                                    <mc-data-picker-range v-model="form.daterange" keys="daterange"></mc-data-picker-range>-->
<!--                                    <mc-html v-model="form.html" keys="html"></mc-html>-->
<!--                                    <mc-btn-image v-model="form.image" keys="image" format="webp.src.id.name"></mc-btn-image>-->
<!--                                    <mc-btn-image v-model="form.image2" keys="image2" :countFile="2" ></mc-btn-image>-->
<!--                                    <div class="col-2"> <img :src="form.image?.src" class="w-100"></div>-->
<!--                                    <div class="col-2" v-for="im in form.image2"> <img :src="im.src" class="w-100"></div>-->
<!--                                    {{ form.image }}-->
<!--                                    <br>-->
<!--                                    {{ form.image2 }}-->
<!--                                </div>-->
                            </div>

                        </div>
                        <div class="card-footer">
                            <button @click="test" type="button" class="btn btn-outline-dark float-sm-right">
                                <span class="send">Сохранить</span>
                                <span class="spinner-container">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {
    name: "index",
    mounted() {
        this.getSettings()


    },
    data() {
        return {
            selects:[
                {name:'One'},
                {name:'Two'},
            ],
            settings: [],
            form: {
                image2: null,
                image: null,
                html: '',
                daterange: '',
                date: '',
                phone: '',
                input: '',
                inputs: '',
                inputicon: {
                    icon: '',
                    text: ''
                },
                icon: '',
                textarea: '',
                select: 0,
                select_one: 0,
                select_two: 0,
                check: true,
            },

        }
    },
    methods: {
        async getSettings() {

            await axios.get(`/api/v1/settings`).then(data => {
                this.settings = data.data;
                console.log(data)

            }).catch((error) => {
                console.log(error)

            })

        },
        async test() {

            await axios.get(`/api/v1/test`, {
                params: this.form
            }).then(data => {

                console.log(data)

            }).catch((error) => {
                console.log(error)

            })

        }
    }
}
</script>

<style scoped>

</style>

