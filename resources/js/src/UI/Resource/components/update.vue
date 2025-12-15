<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ this.$route.params.params == 'create' ? 'Новый ресурс' : 'Редактирование' }}</h3>
            </div>
            <div class="card-body">


                <div class="card">
                    <div class="card-body">
                        <template v-for="(field, ind) in this.storage.resource.fields">

                            <!--====================ACTIVE====================-->
                            <div class="form-group" v-if="field.type == 'active'">
                                <label>{{ field.name }}</label>
                                <mc-on-off v-model="field.value" :keys="field.field"></mc-on-off>
                            </div>
                            <!--====================ACTIVE====================-->

                            <!--====================STRING====================-->
                            <div class="form-group" v-if="field.type == 'string'">
                                <label>{{ field.name }}</label>
                                <mc-input v-model="field.value" class="form-control" :keys="field.field"></mc-input>
                            </div>
                            <!--====================STRING====================-->

                            <!--====================INTEGER====================-->
                            <div class="form-group" v-if="field.type == 'integer'">
                                <label>{{ field.name }}</label>
                                <mc-input v-model="field.value" type="number" class="form-control"
                                          :keys="field.field"></mc-input>
                            </div>
                            <!--====================INTEGER====================-->


                            <!--====================FLOAT====================-->

                            <div class="form-group" v-if="field.type == 'float'">
                                <label>{{ field.name }}</label>
                                <mc-input v-model="field.value" type="number" step="0.01" class="form-control"
                                          :keys="field.field"></mc-input>
                            </div>
                            <!--====================FLOAT====================-->


                            <!--====================TEXT====================-->
                            <div class="form-group" v-if="field.type == 'text'">
                                <label>{{ field.name }}</label>

                                <mc-textarea v-model="field.value" :keys="field.field"
                                             class="form-control"></mc-textarea>
                            </div>
                            <!--====================TEXT====================-->


                            <!--====================ICON STRING====================-->
                            <div class="form-group" v-if="field.type == 'icon-string'">
                                <label>{{ field.name }}</label>
                                <mc-input-icon :input="field.value" :keys="field.field" class="form-control"/>

                            </div>
                            <!--====================ICON STRING====================-->


                            <!--====================COLOR====================-->
                            <div class="form-group" v-if="field.type == 'color'">
                                <label>{{ field.name }}</label>
                                <mc-color-picker v-model="field.value" :keys="field.field"/>
                            </div>
                            <!--====================COLOR====================-->


                            <!--====================DATE====================-->
                            <div class="form-group" v-if="field.type == 'date'">
                                <label>{{ field.name }}</label>
                                <mc-data-picker v-model="field.value" :keys="field.field"></mc-data-picker>

                            </div>
                            <!--====================DATE====================-->


                            <!--====================IMAGE====================-->
                            <div class="form-group flex ai-center" v-if="field.type == 'image'">
                                <div class="col-2">
                                    <label>{{ field.name }}</label>

                                    <mc-btn-image v-model="field.value" :keys="field.field"
                                                  format="webp.src.id.name"></mc-btn-image>
                                </div>
                                <div class="col-2" v-if="field.value?.webp">
                                    <img :src="field.value.webp" :alt="field.value.name" class="w-100">
                                </div>


                            </div>
                            <!--====================IMAGE====================-->

                            <!--====================IMAGES====================-->

                            <div class="form-group flex ai-center" v-if="field.type == 'images'">
                                <div class="col-12">
                                    <label>{{ field.name }}</label>
                                    <Gallery :data="this.storage.resource.fields[ind]" :keys="field.field"
                                             :countFile=" 20"/>
                                </div>


                            </div>
                            <!--====================IMAGES====================-->

                            <!--====================IMAGE UPLOAD====================-->
                            <div class="form-group flex ai-center" v-if="field.type == 'image-upload'">

                                <div class="col-4">

                                    <label>{{ field.name }} <span v-if="field.size"
                                                                  class="text-danger">( размер {{ field.size }} px)</span></label>
                                    <div class="flex gab-10 ai-center">
                                        <download-file v-model="field.value" :keys="field.field" :size="field.size">
                                            <label class="m-0">Загрузить файл</label>
                                        </download-file>

                                        <mc-btn-image v-model="field.value" :keys="field.field"
                                                      format="webp.src.id.name">
                                            <label class="m-0">Mедиа-менеджер</label>
                                        </mc-btn-image>
                                    </div>

                                </div>

                                <div class="col-2 relative trash-hover" v-if="field.value?.webp">
                                    <img :src="field.value.webp" :alt="field.value.name" class="w-100 ">
                                    <div @click.prevent="deleteImage(field.value)"
                                         class="absolute trash flex-center p-3"><i
                                        class="fa-solid fa-trash text-danger"></i></div>
                                </div>


                            </div>
                            <!--====================IMAGE UPLOAD====================-->

                            <!--====================SELECT ALL====================-->
                            <template v-if="field.type == 'select-all'">
                                <div class="form-group">

                                    <label>{{ field.name }}</label>

                                    <mc-select-too :selects="field.selects" v-model="field.value" class="form-control"
                                                   :keys="field.field"></mc-select-too>
                                </div>


                            </template>

                            <!--====================SELECT ALL====================-->
                            <!--====================SELECT====================-->
                            <template v-if="field.type == 'select'">
                                <div class="form-group">

                                    <label>{{ field.name }}</label>

                                    <mc-select-one :selects="field.selects" v-model="field.value" class="form-control"
                                                   :keys="field.field"></mc-select-one>
                                </div>

                                <!--====================TAGS ISSET====================-->

                                <template
                                    v-if="field.value && field.selects.find(t => t.tags) && field.selects.filter(item => field.value.includes(item.id)) && field.selects.find(item => item.id == field.value).tags">


                                    <div class="form-group"
                                         v-for="tag in field.selects.find(item => item.id == field.value).tags">
                                        <label>{{ tag.name }}</label>
                                        <mc-input class="form-control" v-model="tag.value"/>
                                    </div>
                                </template>

                                <!--====================TAGS ISSET====================-->

                            </template>

                            <!--====================SELECT====================-->

                            <!--====================HTML====================-->
                            <div class="form-group" v-if="field.type == 'html' ">
                                <label>{{ field.name }}</label>
                                <mc-html v-model="field.value" :keys="field.field"></mc-html>

                            </div>
                            <!--====================HTML====================-->


                            <!--====================CONFIRMED====================-->
                            <div class="form-group" v-if="field.type == 'confirmed' ">
                                <label>{{ field.name }}</label>

                                <mc-on-off v-model="field.value" :keys="field.field"></mc-on-off>

                            </div>
                            <!--====================CONFIRMED====================-->


                            <!--====================RATING====================-->
                            <div class="form-group" v-if="field.type == 'rating' ">

                                <label>{{ field.name }}</label>
                                <div class="flex gab-10 ai-center">
                                    <svg class="cursor-pointer" width="20" height="21" viewBox="0 0 20 21"
                                         fill="none" v-for="(star ,index) in stars"
                                         @mouseover="over(index +1 )"
                                         @mouseout="out"
                                         @click="field.value = index + 1"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.7289 2.16102L13.4889 5.68102C13.7289 6.17102 14.3689 6.64102 14.9089 6.73102L18.0989 7.26102C20.1389 7.60102 20.6189 9.08102 19.1489 10.541L16.6689 13.021C16.2489 13.441 16.0189 14.251 16.1489 14.831L16.8589 17.901C17.4189 20.331 16.1289 21.271 13.9789 20.001L10.9889 18.231C10.4489 17.911 9.55893 17.911 9.00893 18.231L6.01893 20.001C3.87893 21.271 2.57893 20.321 3.13893 17.901L3.84893 14.831C3.97893 14.251 3.74893 13.441 3.32893 13.021L0.848932 10.541C-0.611068 9.08102 -0.141067 7.60102 1.89893 7.26102L5.08893 6.73102C5.61893 6.64102 6.25893 6.17102 6.49893 5.68102L8.25893 2.16102C9.21893 0.251016 10.7789 0.251016 11.7289 2.16102Z"
                                            :fill="field.value > index ? star.fill:'transparent'" stroke="#FFC471">

                                        </path>
                                    </svg>
                                    <button @click="field.value = 0;out(field.value)" type="button"
                                            class="btn btn-outline-dark">очистить рейтинг
                                    </button>
                                </div>

                            </div>
                            <!--====================RATING====================-->

                            <!--====================VIDEO====================-->
                            <div class="form-group" v-if="field.type == 'video' ">

                                <div class="row ai-center">
                                    <div class="col-2">
                                        <label>{{ field.name }}</label>

                                        <mc-btn-video v-model="field.value" :keys="field.field"
                                                      format="webp.src.id.name.video" class="btn-block"></mc-btn-video>
                                        <button v-if="field.value" @click="field.value = null" type="button" class="btn btn-block btn-outline-danger flex-center mt-3">Удалить</button>

                                    </div>

                                    <div class="col-3" v-if="field.value?.video">
                                        <video class="w-100" controls>
                                            <source :src="field.value.video" id="video_here">
                                            Your browser does not support HTML5 video.
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <!--====================VIDEO====================-->


                        </template>
                    </div>

                </div>


            </div>

            <div class="card-footer mt-3 flex ai-center jc-end">

                <button @click="save" type="button" class="btn btn-outline-dark mt-3">
                    <span class="send">{{ this.$route.params.params == 'create' ? 'Сохранить' : 'Обновить' }}</span>
                    <span class="spinner-container" style="display: none;">
                        <span class="spinner-border spinner-border-sm"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Paginate from '/resources/js/src/UI/Paginate/paginate.vue'
import Gallery from '/resources/js/src/UI/Offers/Settings/gallery.vue'

export default {
    components: {
        Paginate, Gallery
    },
    data() {
        return {
            model: null,
            load: false,
            stars: [
                {id: 1, active: false, fill: '#FFC471'},
                {id: 2, active: false, fill: '#FFC471'},
                {id: 3, active: false, fill: '#FFC471'},
                {id: 4, active: false, fill: '#FFC471'},
                {id: 5, active: false, fill: '#FFC471'},
            ],
        }
    },
    mounted() {
        if (this.storage.resource.fields.length == 0) {

            this.$parent.getFields(true)
        }
        if (this.$route.params.params != 'create') {

            this.getModel()
        } else {
            this.load = true
        }
    },
    methods: {
        over(index) {

            for (var i = 0; i < 5; i++) {
                if (index > i) {
                    this.stars[i].active = true
                } else {
                    this.stars[i].active = false
                }
            }


        },
        out(card) {

            for (var i = 0; i < 5; i++) {
                if (card.rating > i) {
                    this.stars[i].active = true
                } else {
                    this.stars[i].active = false
                }

            }


        },
        async getModel() {
            if (this.storage.resource.resources && this.storage.resource.resources.data.find(item => item.id == this.$route.params.params)) {
                this.model = this.storage.resource.resources.data.find(item => item.id == this.$route.params.params)

            } else {
                await axios.get(`/api/v1/${this.$route.params.action}/${this.$route.params.params}`, {
                    params: this.storage.resource.filter
                }).then(data => {


                    this.model = data.data.data
                    console.log(this.model)
                    this.load = true

                }).catch((error) => {
                    console.log(error)

                })
            }

            for (let i = 0; i < this.storage.resource.fields.length; i++) {
                this.storage.resource.fields[i].value = this.model[this.storage.resource.fields[i].field]
                if (this.model.tags != undefined && this.storage.resource.fields[i].type == 'select') {
                    this.storage.resource.fields[i].selects = this.model.tags
                }
            }
            console.log(this.storage.resource)

        },
        async deleteImage(image) {
            image.webp = null
            console.log(image)
            await axios.post(`/api/v1/images/${image.id}`, {
                _method: 'DELETE'
            }).then(data => {

                if (data) {
                    image.id = null
                    image.name = null
                    image.src = null
                    image.webp = null
                }
                console.log(data)


            }).catch((error) => {
                console.log(error)

            })

        },
        async save() {
            let url = `/api/v1/${this.$route.params.action}`
            let data = {}
            for (let i = 0; i < this.storage.resource.fields.length; i++) {
                data[this.storage.resource.fields[i].field] = this.storage.resource.fields[i].value

                if (this.storage.resource.fields[i].selects && this.storage.resource.fields[i].selects.filter(item => item.tags != undefined)) {
                    data.tags = this.storage.resource.fields[i].selects.map(item => {
                        if (item.tags) {
                            return item.tags.map(t => {
                                return {
                                    id: t.id,
                                    value: t.value
                                }
                            })
                        }

                    })
                }
            }

            if (this.$route.params.params != 'create') {

                url += `/${this.$route.params.params}`
                data._method = 'PUT'
            }
            if (this.$route.params.params){
                data.id = this.$route.params.params
            }

            console.log(this.storage.resource.fields)
            console.log(data)
            await axios.post(url, data).then(data => {
                if (data) {
                    console.log(data.data)
                    this.$router.push(`/admin/resource/${this.$route.params.action}`)
                }

            }).catch((error) => {
                console.log(error)

            })

        },
    },

    name: "lists"
}
</script>

<style scoped lang="scss">
.trash-hover:hover {
    .trash {
        opacity: .9 !important;
    }
}

.trash {
    transition: opacity 0.3s ease;
    top: 10px;
    right: 10px;
    opacity: 0;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    cursor: pointer;
    background: #fff;

}
</style>
