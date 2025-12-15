<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">

                <div class="flex gab-20 col-5">
                    <button @click="this.storage.media.route = 'files'"
                            class="btn btn-outline-dark flex ai-center gab-10">
                        <span>назад</span>
                    </button>
                    <button @click="this.storage.media.route = 'folders'"
                            class="btn btn-outline-success flex ai-center gab-10">
                        <span>Папки</span>
                    </button>


                </div>


            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12 flex-center column card" v-if="changeFileMessage.length > 0">
            <h4>Файл для редактирование недоступен, можно создать новый</h4>
            <ul class="flex column ">
                <li class="text-danger" v-for="message in changeFileMessage">{{ message }}</li>
            </ul>
        </div>
        <div class="col-12  flex gab-20 ai-center jc-center w-100">


            <div class="form-group ">
                <label>Ширина</label>
                <input @keyup="changeRatio" @change="changeRatio" v-model="ratioWidth" type="number"
                       class="form-control" style="width: 100px">
            </div>
            <div class="form-group ">
                <label>Высота</label>
                <input @keyup="changeRatio" @change="changeRatio" v-model="ratioHeight" type="number"
                       class="form-control" style="width: 100px">
            </div>
            <div class="flex gab-10 mt-3 buttons">
                <button @click="crops($event)" type="button" class="btn btn-outline-dark float-sm-right "> n/n</button>
                <button @click="this.crop = false;changeRatio(16/9,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right active"> 16/9
                </button>
                <button @click="this.crop = false;changeRatio(9/16,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 9/16
                </button>
                <button @click="this.crop = false;changeRatio(5/4,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 5/4
                </button>
                <button @click="this.crop = false;changeRatio(4/5,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 4/5
                </button>
                <button @click="this.crop = false;changeRatio(5/3,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 5/3
                </button>
                <button @click="this.crop = false;changeRatio(3/5,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 3/5
                </button>
                <button @click="this.crop = false;changeRatio(4/3,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 4/3
                </button>
                <button @click="this.crop = false;changeRatio(3/4,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 3/4
                </button>
                <button @click="this.crop = false;changeRatio(3/2,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 3/2
                </button>
                <button @click="this.crop = false;changeRatio(2/3,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 2/3
                </button>
                <button @click="this.crop = false;changeRatio(2,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 2/1
                </button>
                <button @click="this.crop = false;changeRatio(1/2,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 1/2
                </button>
                <button @click="this.crop = false;changeRatio(1,$event)" type="button"
                        class="btn btn-outline-dark float-sm-right"> 1/1
                </button>
            </div>
        </div>
    </div>
    <div class="row pb-5" v-if="this.storage.media.current">

        <div class="col-9 ">
            <cropper ref="cropper" v-if="crop"
                     class="cropper"
                     :src="this.storage.media.current.src"

                     :default-position="defaultPosition"
                     :default-size="defaultSize"
                     @change="change"
            ></cropper>
            <cropper ref="cropper" v-if="!crop"
                     class="cropper"
                     :src="this.storage.media.current.src"
                     :stencil-props="this.storage.crop.ratio"

                     @change="change"
            ></cropper>

        </div>
        <div class="col-3 ">
            <div class="flex gab-10 ai-center jc-center">
                <button title="Полный захват в соотношении сторон" type="button"
                        class="btn btn-outline-dark  flex-center" @click="full" style="width:30px">
                    <i class="fa-solid fa-expand"></i>
                </button>
                <button title="Повернуть вправо" type="button" class="btn btn-outline-dark  flex-center"
                        @click="rotate(90)" style="width:30px">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
                <button title="Повернуть влево" type="button" class="btn btn-outline-dark  flex-center"
                        @click="rotate(-90)" style="width:30px">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
                <button title="Перевернуть по горизонтали" type="button" class="btn btn-outline-dark  flex-center"
                        @click="flip(true,false)" style="width:30px">
                    <i class="fa-solid fa-arrows-left-right"></i>
                </button>
                <button title="Развернуть по вертикали" type="button" class="btn btn-outline-dark  flex-center"
                        @click="flip(false,true)" style="width:30px">
                    <i class="fa-solid fa-arrows-up-down"></i>
                </button>
            </div>
            <div class="form-group flex column mt-3">
                <label>Имя файла : {{ this.storage.media.current?.name }}</label>
                <label>Тип файла : {{ this.storage.media.current?.extension }}</label>
                <label>Ширина : {{ this.storage.media.current?.width }}</label>
                <label>Высота : {{ this.storage.media.current?.height }}</label>
            </div>
            <div class="form-group mt-3">
                <label> Качество фото (%)</label>

                <div class="input-group mb-3" style="width:120px">
                    <input v-model="fileQuality" type="number" min="50" max="100" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label>Наименование файла</label>
                <mc-input class="form-control" v-model="fileName" name="fileName" keys="name" type="text"
                          placeholder="Логическое наименование"></mc-input>

            </div>

            <button type="button" class="btn btn-outline-dark btn-block active" @click="newFile"> Сохранить
            </button>
            <button :disabled="!changeFile" type="button" class="btn btn-outline-dark btn-block active"
                    @click="updateFile"> Изменить текущее фото
            </button>

        </div>
    </div>
</template>

<script>
import {Cropper} from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';


export default {
    name: "crop",
    components: {
        Cropper,

    },
    data() {
        return {
            defaultWidth: 1920,
            ratio: this.storage.crop.ratio,
            ratioWidth: 1920,
            ratioHeight: 1080,
            fileName: '',
            fileQuality: 100,
            errors: [],
            crop: false,
            position: {
                width: 0,
                height: 0,
                left: 0,
                top: 0,
            },
            image: {},
            changeFile: false,
            changeFileMessage: [],

        }
    },
    methods: {
        defaultPosition() {
            return {
                left: 100,
                top: 100,
            };

        },
        defaultSize() {
            return {
                width: 400,
                height: 400,
            };
        },
        crops(e) {
            $('.buttons button').removeClass('active')
            $(e.target).addClass('active')
            this.crop = true
            this.$refs.cropper.refresh();
        },
        ///////////////////////////////////////
        flip(x, y) {
            this.$refs.cropper.flip(x, y);
        },
        rotate(angle) {
            this.$refs.cropper.rotate(angle);
        },
        resize(width, height, left, top) {
            this.$refs.cropper.setCoordinates({
                width: width,
                height: height,
                left: left,
                top: top
            })
        },
        full() {
            this.resize(this.image.width, this.image.height, 0, 0)
        },
        ////////////////////////////////////////


        async newFile() {
            let data = {
                image: this.storage.crop.cropImageChange,
                name: this.fileName,
                folder: this.storage.media.filter.folder,

            }
            console.log(data)
            await axios.post('/api/v1/images/crop/image', data).then(data => {
                console.log(data)

                if (data) {
                    this.$router.go(-1)
                }


            })
        },
        changeRatio(ratio = null, e) {

            if (ratio) {
                $('.buttons button').removeClass('active')
                this.storage.crop.ratio = {
                    aspectRatio: ratio
                }
                $(e?.target).addClass('active')

                this.resize(this.ratioWidth, this.ratioHeight, this.position.left, this.position.top)
            } else {

                this.storage.crop.ratio = {
                    aspectRatio: this.getAspectRatio(this.ratioWidth, this.ratioHeight)
                }


            }

        },
        getAspectRatio(w, h) {
            var rem;
            var newW = w;
            var newH = h;

            while (h != 0) {
                rem = w % h;
                w = h;
                h = rem;
            }

            newH = newH / w;
            newW = newW / w;
            return newW / newH

        },
        change({image, coordinates, canvas, imageTransforms, visibleArea}) {
            console.log(image)
            console.log(coordinates)
            console.log(canvas)
            console.log(imageTransforms)
            console.log(visibleArea)
            this.position = coordinates
            this.image = image

            this.storage.crop.cropImageChange = canvas.toDataURL();
            this.ratioWidth = coordinates.width
            this.ratioHeight = coordinates.height

        },
    }
}
</script>

<style scoped>

</style>
