<template>


    <div class="flex pb-2 relative ai-center jc-end ">
        <div v-if="!this.storage.media.active" class="absolute check" :class="this.storage.media.deleteImages.find(item => item.id == image.id) ? 'active-image': ''">
            <input @click="checkImage(image,$event)" type="checkbox" :checked="this.storage.media.deleteImages.find(item => item.id == image.id)"
                   class="form-check-input">
        </div>
        <el-dropdown v-if="this.storage.media.filter.folder != this.storage.media.basket_id && !this.storage.media.active">
            <i class="fa fa-ellipsis-v js-show-info "></i>
            <template #dropdown>
                <el-dropdown-menu>
                    <el-dropdown-item @click="$parent.getImageInfo(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                                <i class="fa fa-info-circle ltr:me-2 rtl:ms-2"></i>
                                <span class="font-14">Подробности Информация</span>
                         </span>
                    </el-dropdown-item>
                    <el-dropdown-item @click.prevent="this.downloadItem(image.src,image.name)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                            <i class="fa fa-download ltr:me-2 rtl:ms-2"></i>
                            <span class="font-14">Скачать</span>
                        </span>
                    </el-dropdown-item>
                    <el-dropdown-item @click="$parent.notyCopyLink(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                            <i class="fa fa-copy ltr:me-2 rtl:ms-2"></i>
                            <span class="font-14">Копировать ссылку</span>
                        </span>
                    </el-dropdown-item>
                    <el-dropdown-item v-if="!image.video"
                                      @click="$parent.exportToFolder(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                           <i class="fa-solid fa-file-export"></i>
                            <span class="font-14">Экспорт</span>
                        </span>
                    </el-dropdown-item>
                    <el-dropdown-item  v-if="!image.video"
                                       @click="$parent.showImage(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                              <i class="fa fa-image ltr:me-2 rtl:ms-2"></i>
                                <span class="font-14">Фото</span>
                         </span>
                    </el-dropdown-item>
                    <el-dropdown-item v-if="!image.video"
                        @click="this.storage.media.current = image;this.storage.media.route = 'crop'">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                                 <i class="fa-regular fa-clone"></i>
                                <span class="font-14">Редактировать</span>
                         </span>
                    </el-dropdown-item>
                    <el-dropdown-item @click="$parent.imageToBasket(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                                <i class="fa fa-trash ltr:me-2 rtl:ms-2"></i>
                                <span class="font-14">Удалить</span>
                         </span>
                    </el-dropdown-item>

                </el-dropdown-menu>
            </template>
        </el-dropdown>
        <el-dropdown v-if="this.storage.media.filter.folder == this.storage.media.basket_id">
            <i class="fa fa-ellipsis-v js-show-info "></i>
            <template #dropdown>
                <el-dropdown-menu>

                    <el-dropdown-item>
                        <span @click="$parent.recoverImage(image)"
                              class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                                 <i class="fa-solid fa-trash-can-arrow-up"></i>
                                <span class="font-14">Восстановить</span>
                         </span>
                    </el-dropdown-item>
                    <el-dropdown-item @click="$parent.deleteImage(image)">
                        <span class="cursor-pointer flex gab-5 ai-center text-black mb-3 js-show-info-closed">
                                <i class="fa fa-trash ltr:me-2 rtl:ms-2"></i>
                                <span class="font-14">Удалить</span>
                         </span>
                    </el-dropdown-item>

                </el-dropdown-menu>
            </template>
        </el-dropdown>

    </div>
    <div class="images pb-2 flex-center" v-if="image.video">
        <video class="w-100" controls>
            <source :src="image.video" >
            Your browser does not support HTML5 video.
        </video>
        <div class="flex-center show-btn absolute" v-if="this.storage.media.active" :class="this.storage.media.selected.find(item => item.id == image.id) ? 'active-image': ''">
            <button @click="addImage(image,$event)" type="button" class="btn   flex-center " :class="this.storage.media.selected.find(item => item.id == image.id) ? 'btn-danger' : 'btn-success'"> {{this.storage.media.selected.find(item => item.id == image.id) ? 'Отменить': 'Выбрать'}} </button>
        </div>
    </div>
    <div class="images pb-2 flex-center" v-else
         :style="`background-image: url(${image.webp});`">

        <div class="flex-center show-btn" v-if="this.storage.media.active" :class="this.storage.media.selected.find(item => item.id == image.id) ? 'active-image': ''">
            <button @click="addImage(image,$event)" type="button" class="btn   flex-center " :class="this.storage.media.selected.find(item => item.id == image.id) ? 'btn-danger' : 'btn-success'"> {{this.storage.media.selected.find(item => item.id == image.id) ? 'Отменить': 'Выбрать'}} </button>
        </div>
    </div>
    <div class="flex column overflow-hidden">
        <span title="новый лого.png">{{ image.name }}</span>
        <span :title="image.path">{{ image.path }}</span>
    </div>
</template>

<script>
export default {
    name: "card",
    props: {
        image: Object
    },
    methods: {
        addImage(image, e){
            console.log(this.storage.media.selected)
                if (!this.storage.media.selected.find(item => item.id == image.id)) {
                    if (this.storage.media.selected.length >= this.storage.media.countFile){
                        if (this.storage.media.countFile == 1){
                            this.storage.media.selected = []
                            this.storage.media.selected.push(image)
                        }else {
                            this.$notify({
                                title: "Уведомление:",
                                text: `Можно выбрать не более ${this.storage.media.countFile} файла` ,

                            })
                            return false
                        }


                    }else {
                        this.storage.media.selected.push(image)
                    }


                }else {
                    if (this.storage.media.selected.find(item => item.id == image.id)) {
                        this.storage.media.selected.splice(this.storage.media.selected.findIndex(function (item) {
                            return item.id === image.id
                        }), 1)
                    }
                }

            if (this.storage.media.countFile == 1 && this.storage.media.selected.length == 1){
                this.$parent.returnFiles()

            }


        },
        checkImage(image, e) {
            if ($(e.target).is(':checked')) {
                $(e.target).parent('.check').addClass('active-image')
                if (!this.storage.media.deleteImages.find(item => item.id == image.id)) {
                    this.storage.media.deleteImages.push(image)
                }
            } else {
                if (this.storage.media.deleteImages.find(item => item.id == image.id)) {
                    this.storage.media.deleteImages.splice(this.storage.media.deleteImages.findIndex(function (item) {
                        return item.id === image.id
                    }), 1)
                }
                $(e.target).parent('.check').removeClass('active-image')
            }


        },
    }
}
</script>

<style lang="scss">
.images{

}
.image-card {


    &:hover .check {
        display: block;
    }
    .active-image{
        display: block!important;
    }
}
</style>
<style scoped lang="scss">
.check {
    left: 20px;
    top: -4px;
    display: none;
}

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
    background-size: contain;
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
