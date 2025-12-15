<template>
    <div class="card card-default container mt-3">
        <div class="card-header">


            <h3 class="card-title">Загрузка Фото до {{ dropZone.maxFiles }} шт. до {{ dropZone.maxFilesize }} Мб</h3>
        </div>
        <div class="card-body">
            <div id="actions" class="row">
                <div class="col-lg-6">
                    <div class="btn-group w-100">
                      <span class="btn btn-success col fileinput-button flex ai-center gab-10">
                        <i class="fas fa-plus"></i>
                        <span>Файлы</span>
                      </span>
                        <button type="button" class="btn btn-primary col start flex ai-center gab-10">
                            <i class="fas fa-upload"></i>
                            <span>Загрузить</span>
                        </button>
                        <button type="reset" class="btn btn-warning col cancel flex ai-center gab-10">
                            <i class="fas fa-times-circle"></i>
                            <span>Отменить</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="fileupload-process w-100">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar"
                             aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                 data-dz-uploadprogress></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table table-striped files" id="previews">
                <div id="template" class="row mt-2">
                    <div class="col-auto">
                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail/></span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <p class="mb-0">
                            <span class="lead" data-dz-name></span>
                            (<span data-dz-size></span>)
                        </p>
                        <strong class="error text-danger" data-dz-errormessage></strong>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                             aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                 data-dz-uploadprogress></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <div class="btn-group">
                            <button class="btn btn-primary start flex ai-center gab-5" type="button">
                                <i class="fas fa-upload"></i>
                                <span>Загрузить</span>
                            </button>
                            <button data-dz-remove class="btn btn-warning cancel flex ai-center gab-5"
                                    type="button">
                                <i class="fas fa-times-circle"></i>
                                <span>Отменить</span>
                            </button>
                            <button data-dz-remove class="btn btn-danger delete flex ai-center gab-5" type="button">
                                <i class="fas fa-trash"></i>
                                <span>Удалить</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "/resources/js/src/store.js";

export default {

    data() {
        return {
            files: [],
            dropZone: this.storage.dropZone,
            myDropzone: null,
            ratioStr: this.ratio
        }
    },
    name: "index",
    methods: {
        isParent(dataURL, myDropzone) {

            this.dropZone.img_files = myDropzone.files


        }
    },
    mounted() {
        let _ = this



        // if (this.storage.dropZone.start){
            Dropzone.autoDiscover = false;
            let dropZone = this.dropZone
            const previewNode = document.querySelector("#template")
            previewNode.id = ""
            const previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)
            document.querySelector("#actions .start").onclick = function (e) {
                e.preventDefault();
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#actions .cancel").onclick = function (e) {
                e.preventDefault();
                myDropzone.removeAllFiles(true)
            }
            let myDropzone
            this.storage.dropZone.start = true
            myDropzone = new Dropzone('#previews', { // Make the whole body a dropzone
                url: _.dropZone.path, // Set the url
                thumbnailWidth: _.dropZone.preview.width,
                thumbnailHeight: _.dropZone.preview.height,
                maxFiles: _.dropZone.maxFiles,
                maxFilesize: _.dropZone.maxFilesize,
                acceptedFiles: _.dropZone.acceptedFiles,
                parallelUploads: _.dropZone.parallelUploads,
                previewTemplate: previewTemplate,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
                params: Object.assign({}, {
                    folder: _.storage.media.filter.folder ??  1,
                }, this.params),
                init: function () {
                    this.on("success", function (file, responseText) {
                        dropZone.files.push(responseText)

                    });
                }
            })
            this.myDropzone = myDropzone
            myDropzone.on("addedfile", function (file) {
                // Hookup the start button
                file.previewElement.querySelector(".start").onclick = function () {
                    myDropzone.enqueueFile(file)

                }


            })

// Update the total progress bar
            myDropzone.on("totaluploadprogress", function (progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
            })

            myDropzone.on("sending", function (file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress").style.opacity = "1"
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")


            })

            myDropzone.on("error", function (file, response) {
                // Show the total progress bar when upload starts
                $(file.previewElement).find('.dz-error-message').text(response);
                console.log(file)
                console.log(response)

            })

// Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function (progress) {
                document.querySelector("#total-progress").style.opacity = "0"
            })
            let isParent = this.isParent
            myDropzone.on('thumbnail', function (file) {

                isParent(file, myDropzone)

            })
        // }





    }
}
</script>

<style scoped>

</style>
