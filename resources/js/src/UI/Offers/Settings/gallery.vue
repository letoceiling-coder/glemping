<template>

  <div class="card">
      <div class="card-body ">

          <div class="flex flex-wrap gab-20"  @update="onUpdate"
               v-sortable="{disabled: false, options: {handle: '.handle-image', animation: 250, easing: 'cubic-bezier(1, 0, 0, 1)' } }">
              <div v-if="data.value" class="image-card p-3 flex column lists-form-images " :data-index="index"
                   v-for="(image,index) in data.value">

                  <div  class="images pb-2 flex-center relative" :style="`background-image: url(${image.src}) `">
                      <i class="handle-image handle-absolute absolute fa-solid fa-arrows-up-down-left-right"></i>
                      <div class="flex-center column gab-20" >
                          <button  @click="data.value.splice(index,1)" type="button"
                                   class="btn btn-outline-danger active  flex-center show-btn ">
                              Удалить
                          </button>

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="card-body">

          <mc-btn-image v-model="data.value" :keys="keys" format="webp.src.id.name" :countFile="countFile"></mc-btn-image>

      </div>
  </div>

</template>

<script>
export default {
name: "gallery",
    props: {
        data: Object,
        countFile: {
            type:Number,
            default:20,
        },
        keys:{
            type:String,
            default:'image',
        }
    },
    mounted() {

    },
    created() {
        if (!this.data.value){
            this.data.value = []
        }
    }
}
</script>
<style scoped lang="scss">

.handle-absolute{
    display: none;
    top: 5px;
    left: 5px;

}
.image-card {
    width: calc(20% - 16px);
    border: 1px solid silver;
}
.images {
    &:hover {
        .handle-absolute{
            display: block;
        }

    }
    cursor: move;

    height: 165px;
    overflow: hidden;
    background-size: contain;
    background-position: center;

    background-repeat: no-repeat;

    img {
        width: 100%;
    }
}


</style>
