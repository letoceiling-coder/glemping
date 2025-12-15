<template>
    <div class="card list-indexComponent"
         :data-index="index"
         :data-indexComponent="indexComponent" >
        <div class="card-header">
            <h3 class="card-title">
                <div class="flex ai-center gab-10">
                    <i class="handle-component fa-solid fa-arrows-up-down-left-right"></i>
                    <span>Компонент: {{ component.name }}</span>
                    <button @click="this.storage.page.data[index].setting.components.splice(indexComponent,1)" type="button" class="btn btn-danger btn-sm">Удалить</button>


                </div>
            </h3>
            <div class="card-tools">
                <button  type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"  ></i></button>
            </div>

        </div>
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-set-component-tab" data-toggle="pill" href="#pills-set-component" role="tab" aria-controls="pills-set-component" aria-selected="true">Настройки</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" :id="`pills-dop-sett-${index}-${indexComponent}-tab`" data-toggle="pill" :href="`#pills-dop-sett-${index}-${indexComponent}`" role="tab" :aria-controls="`pills-dop-sett-${index}-${indexComponent}`" aria-selected="false">Позиционирование</a>
                </li>

            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-set-component" role="tabpanel" aria-labelledby="pills-set-component-tab">
                    <div v-for="field in component.fields" :key="`${field.space}${index}${indexComponent}`">
                        {{`setting-${field.type}`}}
                        <component :is="`setting-${field.type}`" :setting="field"></component>

                    </div>
                </div>
                <div class="tab-pane fade" :id="`pills-dop-sett-${index}-${indexComponent}`" role="tabpanel" :aria-labelledby="`pills-dop-sett-${index}-${indexComponent}-tab`">
                    <div class="col-12" v-if="component.view">
                        <div class="row">

                            <div class="col-3">
                                <div class="form-group">
                                    <label> Отступ сверху </label>
                                    <mc-select v-model="component.view.marginTop" :selects="margins.top" class="form-control"></mc-select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label> Отступ снизу </label>
                                    <mc-select v-model="component.view.marginBottom" :selects="margins.bottom" class="form-control"></mc-select>
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
import VRC from "../../../Views/components";

export default {
    name: "setting-container",
    props: {
        component: Object,
        index: Number,
        indexComponent: Number|null,
    },
    data() {
        return {
            margins: {
                top: [
                    {id: 'mt-0', name: 0},
                    {id: 'mt-1', name: 1},
                    {id: 'mt-2', name: 2},
                    {id: 'mt-3', name: 3},
                    {id: 'mt-4', name: 4},
                    {id: 'mt-5', name: 5},
                ],
                bottom: [
                    {id: 'mb-0', name: 0},
                    {id: 'mb-1', name: 1},
                    {id: 'mb-2', name: 2},
                    {id: 'mb-3', name: 3},
                    {id: 'mb-4', name: 4},
                    {id: 'mb-5', name: 5},
                ],
            },
        }
    },
    methods:{
        getFields(){
            let vrc = new VRC()

            this.component.fields = vrc.checkFields(vrc.importSetting(this.component.component).fields,this.component.fields)
            this.component.view =  vrc.appendSettings(this.component.view)

            console.log(this.component.fields)
        }
    },
    mounted() {
        this.getFields()

    }
}
</script>

<style scoped>

</style>
