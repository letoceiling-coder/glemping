<template>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body flex gab-20">


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
    <div class="row">
        <div class="col-12">
            <div class="card w-100">

                <div class="card-body">
                    <div class="flex flex-wrap gab-20">

                        <download-video></download-video>
                    </div>


                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "video-download",
    data(){
    return{
        video:null,
    }
    }
}
</script>

<style scoped>

</style>
