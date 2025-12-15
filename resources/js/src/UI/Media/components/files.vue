<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">

                <div class="flex gab-20 col-4">
                    <button @click="this.storage.media.filter.folder == this.storage.media.video_id ? this.storage.media.route = 'video-download' : this.storage.media.route = 'upload'"
                            class="btn btn-outline-success flex ai-center gab-10">
                        <span>Добавить файлы</span>
                    </button>
                    <button @click="this.storage.media.route = 'folders'"
                            class="btn btn-outline-success flex ai-center gab-10">
                        <span>Папки</span>
                    </button>

                    <button @click="deleteImageIds" v-if="this.storage.media.deleteImages.length > 0" type="button"
                            class="btn btn-outline-danger flex ai-center gab-10">
                        <span>{{ this.storage.media.filter.folder == 2 ? 'очистить' : 'удалить' }}</span>
                    </button>
                </div>


                <div class="flex-center ai-center gab-10 col-4" >
                    <div class="flex ai-center gab-20">
                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-grip"></i>
                            {{
                                paginates.find(item => item.id == this.storage.media.filter.paginate)?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="paginate in paginates">
                                        <span @click="this.storage.media.filter.paginate = paginate.id;this.getImage()" class="font-20">{{ paginate.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                        <el-dropdown>

                        <span>
                           <i class="fa-solid fa-filter"></i>
                            {{
                                selectSort.find(item => item.id == storage.media.filter.selectSort)?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="sorts in selectSort">
                                        <span @click="this.storage.media.filter.selectSort = sorts.id;this.getImage()" class="font-14">{{ sorts.name }}</span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                        <el-dropdown v-if="this.storage.media.folders.length > 0">

                        <span>
                            <i class="fa-solid fa-folder-open"></i>
                            {{
                                this.storage.media.folders.find(item => item.id == (this.storage.media.filter.folder ?? 1))?.name
                            }}
                        </span>
                            <template #dropdown>
                                <el-dropdown-menu>

                                    <el-dropdown-item v-for="folder in this.storage.media.folders.filter(item => item.id != this.storage.media.filter.folder)">
                        <span @click="this.storage.media.folderthis.storage.media.filter.folder = folder.id;this.getImage()"
                              class="cursor-pointer flex gab-5 ai-center text-black mb-3 ">
                                 <i v-if="folder.id != 3" class="fa-solid " :class="folder.id == 2 ? 'fa-trash-can' : 'fa-folder-open'"></i>
                                <i v-else class="fa-solid fa-photo-film"></i>
                                <span class="font-14">{{ folder.name }}</span>
                         </span>
                                    </el-dropdown-item>


                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </div>

                </div>


                <div class=" form-group flex  w-100 m-0 p-0 col-3 ">
                    <div class="search-container relative w-100">
                        <mc-input v-model="this.storage.media.filter.search" class="form-control" type="text"
                                  placeholder="поиск">
                            <div class="absolute search flex gab-5">
                                <i v-if="this.storage.media.filter.search.length > 0" @click="this.storage.media.filter.search = ''"
                                   class="fa-solid fa-delete-left text-danger"></i>
                                <i @click="getImage" class="fa fa-search "></i>

                            </div>

                        </mc-input>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card w-100">

                        <div class="card-body">
                            <div class="flex flex-wrap gab-20">

                                <div class="image-card p-3 flex column "
                                     v-for="image in this.storage.media.images.data">
                                    <Card :image="image"/>
                                </div>

                            </div>

                            <div class="card-footer mt-3 flex ai-center jc-end">
                                <div class="clearfix flex">
                                    <Paginate :paginate="this.storage.media.images"></Paginate>
                                </div>
                                <button v-if="this.storage.media.active" @click="returnFiles" type="button" class="btn btn-dark flex ai-center gab-10">
                                    <span>Выбрать</span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ImageInfo/>
            <ExportImage/>
            <ImageModal/>


        </div>
    </section>
</template>

<script>
import Card from '/resources/js/src/UI/Media/components/card.vue'
import ImageInfo from '/resources/js/src/UI/Media/components/modal/image-info.vue'
import ExportImage from '/resources/js/src/UI/Media/components/modal/export-image.vue'
import ImageModal from '/resources/js/src/UI/Media/components/modal/image-modal.vue'
import Paginate from '/resources/js/src/UI/Paginate/media.vue'

export default {
    name: "files",
    watch: {
        'storage.media.filter.search': {
            handler: function (search) {
                if (search == '') {
                    this.getImage()
                }

            },
            deep: true,
            immediate: true
        },

    },
    components: {
        Card, ImageInfo, ExportImage, ImageModal,Paginate
    },
    data() {
        return {
            selectSort: [
                {id: 'orderByDesc', name: 'Сортировать от новых'},
                {id: 'orderBy', name: 'Сортировать от старых'},
            ],
            paginates: [
                {id: '10', name: '10'},
                {id: '20', name: '20'},
                {id: '30', name: '30'},
                {id: '40', name: '40'},
                {id: '50', name: '50'},
                {id: '100', name: '100'},
            ],
        }
    },
    methods: {
        returnFiles(){
            if(this.storage.media.filter.folder == 3){
                this.eventBus.emit('updateVideo', this.storage.media.selected)
            }else {
                this.eventBus.emit('updateImage', this.storage.media.selected)
            }

            this.storage.media.selected = []
        },
        async getImage() {
            // this.storage.media.images = []


            await axios.get('/api/v1/images', {
                params: this.storage.media.filter
            }).then(data => {

                this.storage.media.images = data.data
            }).catch((error) => {
                console.log(error)

            })

        },
        async getFolders() {

            await axios.get('/api/v1/folders').then(data => {
                this.storage.media.folders = data.data.data


            }).catch((error) => {
                console.log(error)

            })

        },
        async deleteImageIds() {
            if (this.storage.media.deleteImages.length > 0) {
                let ids = this.storage.media.deleteImages.map(item => {
                    return item.id
                })
                await axios.post('/api/v1/images/delete/ids', {
                    ids: ids,
                    folder: this.storage.media.filter.folder,
                    _method: "DELETE"
                }).then(data => {
                    this.storage.media.deleteImages = []
                    this.getImage()


                }).catch((error) => {
                    console.log(error)


                })
            }


        },
        async recoverImage(image) {

            await axios.post(`/api/v1/images/${image.id}`, {
                _method: 'PUT'
            }).then(data => {
                this.getImage()
            }).catch((error) => {
                console.log(error)

            })

        },
        async deleteImage(image) {

            await axios.post(`/api/v1/images/${image.id}`, {
                _method: 'DELETE'
            }).then(data => {
                this.getImage()
            }).catch((error) => {
                console.log(error)

            })

        },
        async imageToBasket(image = null) {
            if (image) {
                this.storage.media.current = image
            }
            await axios.post('/api/v1/images/folder/to', {
                id: this.storage.media.current.id,
                folder: this.storage.media.basket_id,
            }).then(data => {

                if (data) {

                    $('.modal').modal('hide')
                    this.storage.media.current = null

                    this.getImage()

                }

            }).catch((error) => {
                console.log(error)

            })

        },
        getImageInfo(image) {
            $('#modal-image-info').modal('toggle')
            this.storage.media.current = image
        },
        exportToFolder(image) {
            this.storage.media.copy = image
            $('#modal-exportImage').modal('show')
        },
        showImage(image) {
            $('#modal-image').modal('toggle')
            this.storage.media.current = image
        },

    },
    mounted() {


        if (this.storage.media.folders.length == 0) {
            this.getFolders()
        }

        this.getImage()
    }
}
</script>
<style>
.el-tooltip__trigger{
    outline: none!important;
}
</style>
<style scoped lang="scss">

.el-dropdown {
    border: transparent !important;

    &:active {
        border: transparent !important;
    }

    &:hover {
        border: transparent !important;
    }
}

.js-show-info {
    padding: 0 10px;
}

.images {


    height: 165px;
    overflow: hidden;
    background-size: cover;
    background-position: center;

    background-repeat: no-repeat;

    img {
        width: 100%;
    }
}


.info-card {
    display: none;
    top: 8px;
    right: -8px;
    height: 200px;
    width: 220px;
    background: #ffffff;
    border-radius: 15px;
    padding: 20px 0;
    margin-top: 15px;
    //-webkit-box-shadow: 0 1px 10px 0 rgba(69, 90, 100, .2);
    //box-shadow: 0 1px 10px 0 rgba(69, 90, 100, .2);
    border: none;
}

.image-card-active {
    border: 1px solid red !important;
}
</style>
<style scoped lang="scss">
.clearfix {
    flex: 1 1 auto;
}

.border-choose {
    transition: .6s ease-in;

    &:hover {
        border: 1px solid red !important;
    }
}

.image-card {
    width: calc(20% - 16px);
    border: 1px solid silver;
}

.search-container {
    input {
        padding-right: 30px;
    }

    .search {
        position: absolute;
        right: 15px;
        top: calc(50% - 8px);
        cursor: pointer;
    }
}

.card-body {


}

.btn-outline-dark-active {
    color: #ffffff;
    border-color: #343a40 !important;
    background: #343a40;
}

.card {

    box-shadow: none;
}
.font-20{
    font-size: 20px;
}
</style>
