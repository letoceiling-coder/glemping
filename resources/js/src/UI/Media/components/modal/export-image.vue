<template>
    <div class="modal fade" id="modal-exportImage">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Экспортироват файл</h5>
                    <button @click="this.modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">

                    <mc-select class="form-control" :selects="this.storage.media.folders.filter(item => item.id != 2 && item.id != 3 && item.id != this.storage.media.filter.folder)"
                               v-model="folder" keys="folder"/>
                </div>
                <div class="modal-footer">
                    <button @click="toFolder" type="button" class="btn btn-danger">Переместить</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "copy-image",
    data() {
        return {
            folder: 0,
        }
    },
    methods: {
        async toFolder() {

            await axios.post('/api/v1/images/folder/to', {
                id: this.storage.media.copy.id,
                folder: this.folder,
            }).then(data => {

                if (data){

                    $('#modal-exportImage').modal('hide')
                    this.storage.media.filter.folder = this.folder

                    this.storage.media.images = []
                    this.$router.push(`/admin/media/files/${this.storage.media.filter.folder}`)
                    this.storage.media.copy = null
                    this.folder = null
                }

            }).catch((error) => {
                console.log(error)

            })
        },
    }
}
</script>

<style scoped>

</style>
