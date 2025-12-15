<template>
    <div class="modal fade" id="modal-image">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" @click="this.modalClose" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body flex-center" >

                    <mc-picture :image="this.storage.media.current" style="height:300px;max-width: 100%;"/>
                </div>
                <div class="modal-footer">
                    <button @click="this.$parent.imageToBasket" type="button" class="btn btn-danger">Удалить</button>
                    <button @click="this.modalClose();this.storage.media.route = 'crop'"
                            class="btn btn-dark">
                        <span>Редактировать</span>
                    </button>

                    <button @click="this.modalClose" type="button" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "image-modal"
}
</script>

<style scoped>
.modal{
   height: 90vh;
}
</style>
