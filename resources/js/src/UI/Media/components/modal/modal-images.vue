<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="media">
        <div class="modal-dialog modal-xl">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Медиа менеджер</h5>
                    <button @click="this.modalClose" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <Media/>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Media from '/resources/js/src/UI/Media/index.vue'
export default {
    name: "modal-images",
    components:{
        Media
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
