<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">
                <button @click="appendFolder" type="button" class="btn btn-outline-success flex ai-center gab-10">
                    <span>Создать папку</span>
                </button>
                <button v-if="deleteFolders.length > 0" @click="getDeleteFolders" type="button"
                        class="btn btn-outline-danger flex ai-center gab-10">
                    <span>удалить выбранные</span>
                </button>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card w-100">

                <div class="card-body">
                    <div class="flex flex-wrap gab-20">
                        <template v-for="folder in this.storage.media.folders">
                            <div @dblclick="currentFolderClick(folder,$event)" :title="`${folder.count} файлов`"
                                 class="image-card p-3 flex-center column gab-10 cursor-pointer relative">

                                <img :src="folder.icon" :alt="folder.name">
                                <span>{{ folder.name }}</span>
                                <div class="absolute check" v-if="folder.system != 1">
                                    <input @click="checkInput(folder,$event)" type="checkbox"
                                           class="form-check-input">
                                </div>
                                <span class="fs-10">{{ folder.count }} файлов </span>
                            </div>
                        </template>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <NewFolderModal/>
</template>

<script>
import NewFolderModal from '/resources/js/src/UI/Media/components/modal/folder.vue'

export default {
    name: "folders",
    components: {
        NewFolderModal
    },
    data() {
        return {
            folders: [],
            deleteFolders: [],
        }
    },
    methods: {

        checkInput(folder, e) {
            if ($(e.target).is(':checked')) {
                $(this).parent('.check').addClass('active')
                if (!this.deleteFolders.find(item => item.id == folder.id)) {
                    this.deleteFolders.push(folder)
                }
            } else {
                if (this.deleteFolders.find(item => item.id == folder.id)) {
                    this.deleteFolders.splice(this.deleteFolders.findIndex(function (item) {
                        return item.id === folder.id
                    }), 1)
                }
                $(this).parent('.check').removeClass('active')
            }

        },
        currentFolderClick(folder, e) {

            this.deleteFolders = []
            this.storage.media.images = []
            this.storage.media.filter.folder = folder.id
            this.storage.media.route = 'files'
            console.log(this.storage.media.route)
        },
        appendFolder() {
            $('#modal-new-folder').modal('show')
        },
        async getFolders() {

            await axios.get('/api/v1/folders').then(data => {
                this.storage.media.folders = data.data.data
            }).catch((error) => {
                console.log(error)

            })

        },
        async getDeleteFolders() {

            await axios.post('/api/v1/folders/folders/delete', {
                _method: 'DELETE',
                ids: this.deleteFolders.map(item => {
                    return item.id
                })
            }).then(data => {

                this.deleteFolders = []
                this.storage.media.folders = data.data.data
            }).catch((error) => {
                console.log(error)

            })

        }
    },
    mounted() {
        this.getFolders()
        $(document).on('change', '.check input', function () {
            if ($(this).is(':checked')) {
                $(this).parent('.check').addClass('active')

            } else {
                $(this).parent('.check').removeClass('active')
            }
        })
    }
}
</script>

<style scoped lang="scss">
.image-card img {
    width: 60px;
}

.check {
    top: 0;
    right: -10px;
    display: none;

}

.active {
    display: block !important;
}

.image-card {
    &:hover .check {
        display: block;
    }
}
.fs-10{
    font-size: 10px;
}
</style>
