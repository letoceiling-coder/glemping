<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Настройка контента

            </h3>
            <div class="card-tools">
                <button @click="createContainer" type="button" class="btn btn-sm btn-primary"><span
                    class="flex ai-center gab-10"><i
                    class="fa-solid fa-list"></i><span>Создать контейнер</span></span></button>
            </div>
        </div>
        <div class="card-body" @update="onUpdate"
             v-sortable="{disabled: false, options: {handle: '.handle', animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }"
             >
            <div v-for="(container,index) in this.storage.page.data" class="card list-component"  :class="container.isOpen ? 'collapsed-card' : ''" :data-index="index">

                <div class="card-header">
                    <h3 class="card-title">
                        <div class="flex ai-center gab-10">
                            <i class="handle fa-solid fa-arrows-up-down-left-right"></i>
                            <span>Контейнер</span>

                            <button @click="this.storage.page.data.splice(index,1)" type="button" class="btn btn-danger btn-sm">Удалить</button>
                            <button @click="this.storage.page.currentContainer = index" type="button" class="btn btn-sm btn-primary"
                                    data-widget="control-sidebar"
                                    data-slide="true" role="button">Добавить компонент
                            </button>

                            <div class="name-components">
                                Компоненты:(<span v-for="nameComponents in container.setting.components" class="ml-3"> {{nameComponents.name}}</span>)
                            </div>

                        </div>
                    </h3>
                    <div class="card-tools">
                        <button  type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus" :class="container.isOpen ? 'fa-plus' :'fa-minus'" ></i></button>
                    </div>

                </div>
                <div class="card-body" :id="`TabContent-${index}`">
                    <Container :item="container"></Container>
                    <div  v-for="(component , indexComponent) in container.setting.components" >

                        <div  @update="onUpdate"
                             v-sortable="{disabled: false, options: {handle: '.handle-component', animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }">

                            <SettingComponent  :index="index" :component="component" :indexComponent="indexComponent" :key="index+indexComponent"/>

                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!--        <div class="card-body">-->
        <!--            <div class="card" v-for="container in this.storage.page.data">-->
        <!--                <Container :item="container"></Container>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>

<script>
import Container from './setting-container.vue'
import SettingComponent from './setting-component.vue'

export default {
    name: "content",
    components: {
        Container,SettingComponent
    },
    methods: {
        createContainer() {
            this.storage.page.data.push({
                setting: {
                    id: this.storage.page.data.length + 1,
                    isOpen: true,
                    container: 'container',
                    marginTop: 'mt-3',
                    marginBottom: 'mb-0',
                    components: [],

                }
            })
        },
        onUpdate(){
            this.$parent.sorters()
        }

    }
}
</script>

<style scoped>

</style>
