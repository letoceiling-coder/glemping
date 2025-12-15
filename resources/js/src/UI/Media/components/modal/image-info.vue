<template>
    <div class="modal fade" id="modal-image-info">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Информация о файле</h4>
                    <button type="button" class="close" @click="this.modalClose" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Имя файла при загрузке</label>
                        <input type="text" class="form-control" :value="this.storage.media.current?.name" disabled>

                    </div>
                    <div class="form-group">
                        <label>Имя файла </label>
                        <input type="text" class="form-control" :value="this.storage.media.current?.path + '.' + this.storage.media.current?.extension" disabled>

                    </div>

                    <div class="form-group">
                        <label>Тип файла</label>
                        <input type="text" class="form-control" :value="this.storage.media.current?.extension" disabled>

                    </div>
                    <div class="form-group">
                        <label>Ширина</label>
                        <input type="text" class="form-control" :value="this.storage.media.current?.width" disabled>

                    </div>
                    <div class="form-group">
                        <label>Высота</label>
                        <input type="text" class="form-control" :value="this.storage.media.current?.height" disabled>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary"
                            @click="this.downloadItem(this.storage.media.current?.src,this.storage.media.current?.name)">
                        Скачать
                    </button>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
export default {
name: "image-info"
}
</script>

<style scoped>

</style>
