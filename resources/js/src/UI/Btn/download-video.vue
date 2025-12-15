<template>

    <div class="row w-100">
        <div class="card col-12 w-100">
            <div class="card-header">
                <h5>Загрузка видео</h5>
            </div>
            <div class="card-body">
                <div class="row flex ai-center">
                    <div class="col-6 flex ai-center">
                        <div class="col-4">
                            <div class="form-group">


                                <label class="input-file">
                                    <input @change="files" type="file" name="file[]" class="file_multi_video"
                                           accept="video/*" ref="input">

                                    <button @click="openForm" class="btn btn-outline-dark flex-center m-0">Выберите файл
                                    </button>

                                </label>
                            </div>
                        </div>

                        <div class="col-8">
                            <video class="w-100" controls>
                                <source src="" id="video_here">
                                Your browser does not support HTML5 video.
                            </video>


                        </div>
                    </div>

                    <div class="col-6 flex ai-center" v-show="this.form.video">
                        <div class="col-4">
                            <div class="form-group flex column jc-center text-center">

                                <label for="snap">Выбрать для превью</label>
                                <button id="snap" @click="snap" class="btn btn-outline-dark flex-center m-0">Скрин
                                </button>

                            </div>
                        </div>

                        <div class="col-8">
                            <canvas id="canvas" class="w-100"></canvas>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-footer">
                <button v-if="form.video" @click="sendFile" class="btn btn-outline-dark flex-center m-0">
                    <span>Загрузить</span>
                    <span class="spinner-container">
                                    <span class="spinner-border spinner-border-sm"></span></span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            form: {
                video: null,
                image: null,
            },
            canvas: null,
            context: null,
            video: null,
            w: null,
            h: null,
            ratio: null,
        }
    },
    mounted() {
        this.video = document.querySelector('video');
        this.canvas = document.querySelector('canvas');
        this.context = this.canvas.getContext('2d');

        let _ = this
        //add loadedmetadata which will helps to identify video attributes
        this.video.addEventListener('loadedmetadata', function () {
            _.ratio = _.video.videoWidth / _.video.videoHeight;
            _.w = _.video.videoWidth - 100;
            _.h = parseInt(_.w / _.ratio, 10);
            _.canvas.width = _.w;
            _.canvas.height = _.h;
        }, false);

    },
    props: {
        setting: Object
    },
    methods: {
        snap() {
            this.context.fillRect(0, 0, this.w, this.h);
            this.context.drawImage(this.video, 0, 0, this.w, this.h);
            console.log(this.context)
        },
        async sendFile() {


            if ($(this.$refs.input)[0].files[0]) {
                $('.spinner-container').show()
                $('.send').hide()
                let formData = new FormData();

                formData.append('file', $(this.$refs.input)[0].files[0]);
                formData.append('image', this.canvas.toDataURL());
                formData.append('folder', 3);
                await axios.post('/api/v1/images/video/download', formData).then(data => {

                    if (data) {
                        this.storage.media.folder = 3
                        this.storage.media.route = 'files'
                    }

                }).catch((error) => {
                    console.log(error)

                }).finally(() => {
                    $('.spinner-container').hide()
                    $('.send').show()
                });
            }


        },
        files(e) {
            let $source = $('#video_here');
            $source[0].src = URL.createObjectURL(e.target.files[0]);
            $source.parent()[0].load();
            this.form.video = true
            setTimeout(this.snap, 1000);
        },
        openForm() {

            $(this.$refs.input).trigger('click')
        }
    }
}
</script>

<style scoped>
.input-file {
    position: relative;
    display: inline-block;
}

.input-file input[type=file] {
    position: absolute;
    z-index: -1;
    opacity: 0;
    display: block;
    width: 0;
    height: 0;
}


</style>
