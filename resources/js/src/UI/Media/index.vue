<template>
    <div class="content-header" v-if="!this.storage.media.active" >
        <div class="container-fluid">
{{this.storage.media.folder}}
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Медиа менеджер
                        <span > - {{namesComponent.find(item => item.name == this.storage.media.route)?.text}}</span>

                    </h1>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <component :is="this.storage.media.route"></component>
        </div>

    </section>
</template>

<script>

export default {
name: "index",


    data(){
    return{
        namesComponent:[
            {
                name:'folders',
                text:'Список папок'
            },
            {
                name:'files',
                text:'Список файлов'
            },
            {
                name:'upload',
                text:'Загрузка файлов'
            },
            {
                name:'crop',
                text:'Редактирование фото'
            },
            {
                name:'video-download',
                text:'Загрузка видео'
            },
        ]
    }
    },
    methods:{
        nameComponent(){

        }
    }
}
</script>

<style scoped>

</style>
