<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Настройки
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>

        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <div class="form-group">

                        <div class="row flex ai-center">

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Наименование</label>
                                    <mc-input v-model="form.name" class="form-control" keys="property"></mc-input>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Тип данных</label>
                                    <mc-select v-model="form.system_type_id" :selects="this.storage.offers.types"
                                               class="form-control"
                                               keys="types"></mc-select>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Компонент</label>

                                    <mc-select v-model="form.component" :selects="components"
                                               class="form-control"
                                               keys="component">
                                        <template #option>
                                        <option value="0">По умолчанию</option>
                                        </template>
                                    </mc-select>
                                </div>

                            </div>
                            <div class="col-3 flex gab-10">
                                <button @click="updateProperty" class="btn btn-sm btn-primary flex ai-center gab-10">
                                    <i class="fa-solid fa-square-plus"></i>
                                    <span>{{ redactorProperty ? 'Редактировать' : 'Создать' }} </span>
                                </button>
                                <button v-if="redactorProperty" @click="resetForm"
                                        class="btn btn-sm btn-danger flex ai-center gab-10">
                                    <i class="fa-solid fa-square-plus"></i>
                                    <span>Отмена </span>
                                </button>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-header">
                                Подключенные харктеристики
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div @update="onUpdate" class="row"
                                         v-sortable="{disabled: false, options: {handle: '.handle-characteristics', animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }">
                                        <div class="col-2 mt-2 lists-characteristics"
                                             v-for="(property,indexProperty) in this.storage.offers.properties"
                                             :data-index="indexProperty">

                                            <div class="form-check ">
                                                <input @change="changeProperty(property)" :value="property.id"
                                                       v-model="this.storage.offers.typesOn" class="form-check-input"
                                                       type="checkbox">
                                                <label @click="updatedProperty(property)"
                                                       class="form-check-label cursor-pointer"
                                                       title="Редактировать"><i
                                                    class="handle-characteristics fa-solid fa-arrows-up-down-left-right"></i>
                                                    {{ property.name }}</label>
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
</template>

<script>
import VRC from "/resources/js/src/Views/components";
export default {
    name: "root",
    data() {
        return {
            form: {
                id: null,
                system_type_id: 0,
                name: '',
                component:null,
            },
            components:null,
            redactorProperty: false,
            // properties: [],
            // types: [],
            // typesOn: [],
        }
    },
    mounted() {
        this.components = new VRC().registerComponents.map(item => {
            return{
                id:item.component,
                name:`${item.component} ( ${item.name} )`  ,
            }
        })

    },
    methods: {
        onUpdate() {

            let properties = this.storage.offers.properties
            $('.lists-characteristics').each(function (item, value) {
                properties[$(value).attr('data-index')].sort = item
            })
            this.updateProperties()


        },
        resetForm() {
            this.redactorProperty = false
            this.form.id = null
            this.form.system_type_id = 0
            this.form.name = ''
            this.form.component = -1
        },
        updatedProperty(property) {

            this.redactorProperty = true
            this.form.id = property.id
            this.form.system_type_id = property.type.id
            this.form.name = property.name
            this.form.component = property.component
        },
        async changeProperty(property) {

            await axios.post(`/api/v1/properties/${property.id}`, {
                active: !property.active,
                _method: 'PUT'
            }).then(data => {
                this.storage.offers.properties = data.data

                this.storage.offers.typesOn = this.storage.offers.properties.filter(item => item.active == true).map(item => {
                    return item.id
                })

            }).catch((error) => {
                console.log(error)

            })

        },
        async updateProperties() {

            await axios.post('/api/v1/properties/sort/update', {
                ids: this.storage.offers.properties.map(item => {
                    return {
                        id: item.id,
                        sort: item.sort,
                    }
                }),
                _method: 'PUT'
            }).then(data => {
                console.log(data.data)
                this.storage.offers.properties = data.data

            }).catch((error) => {
                console.log(error)

            })

        },
        async updateProperty() {
            let url = '/api/v1/properties'
            if (this.redactorProperty) {
                this.form._method = 'PUT'
                url += `/${this.form.id}`
            }
            await axios.post(url, this.form).then(data => {
                this.storage.offers.properties = data.data
                this.storage.offers.typesOn = this.storage.offers.properties.filter(item => item.active == true).map(item => {
                    return item.id
                })

                this.resetForm()
            }).catch((error) => {
                console.log(error)

            })

        },
    }
}
</script>

<style scoped>

</style>
