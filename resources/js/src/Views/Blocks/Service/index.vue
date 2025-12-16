<template>

    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`" v-if="getField('collect-service').resource.data">
        <div id="services" class="bg-about relative pb-3 pt-5"
             :style="`background: url(${getField('bg-image').image.webp}) 0% 0% / cover no-repeat;`">


            <div class="container z-10 relative">
                <div class="row flex jc-sb ai-center">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">{{ getField('title').text }}</h2>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>{{ getField('description').text }}</p>

                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 col-12" v-for="service in validServices" :key="service.id || service.uid">
                        <Services :service="service"/>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="modal-signUpService">
        <div class="modal-dialog modal-xl">

            <div class="modal-content">
                <div class="modal-header flex ai-center jc-sb">

                    <button type="button" class="close m-0 p-0 w-100" @click="hideModal($event)" aria-label="Close">
                        <span aria-hidden="true" class="float-right">×</span>
                    </button>

                </div>
                <div class="modal-body">


                    <div class="container" v-if="this.storage.service">
                        <div class="row ai-center">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="flex column">
                                    <h3>{{ this.storage.service.name }}</h3>
                                    <div v-html="this.storage.service.description" class="description mt-3 mb-3"></div>
                                    <span>
    <Btn v-if="this.storage.offer"
         :btn="{route:`booking#mode=embed&page=search&room_id=${this.storage.offer.uid}&search=1`,method:'slug',view:'btn-default'}">Забронировать</Btn>
</span>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <picture>
                                    <source :srcset="this.storage.service.image_id.webp"
                                            type="image/webp">
                                    <img :src="this.storage.service.image_id.src"
                                         :alt="this.storage.service.image_id.name" class="w-100 pb-3">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

import Services from '/resources/js/src/Views/Cards/Services/index.vue'

export default {
    components: {Services},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {}
    },
    computed: {
        validServices() {
            const collectServiceField = this.getField('collect-service')
            if (!collectServiceField || !collectServiceField.resource || !collectServiceField.resource.data) {
                return []
            }
            const services = collectServiceField.resource.data
            return services.filter(service => {
                if (!service) return false
                // Показываем если есть image_id или хотя бы одно изображение в массиве images
                return service.image_id || (service.images && Array.isArray(service.images) && service.images.length > 0)
            })
        }
    },
    methods: {
        hideModal(e) {
            $('#' + $(e.target).closest('.modal').attr('id')).modal('hide')
        },
        async getResource(resource) {

            await axios.get(`/api/v1/${resource.resource.route}`, {
                params: resource.resource.filters
            }).then(data => {

                resource.resource.data = data.data.data

            }).catch((error) => {
                console.log(error)

            })

        },
        getField(name) {
            return this.data.fields.find(item => item.space === name)
        }
    },
    mounted() {
        let resource = this.data.fields.filter(item => item.type == 'resource')

        if (resource && resource.length > 0) {

            for (let i = 0; i < resource.length; i++) {

                this.getResource(resource[i])
            }
        }


    },

}
</script>

<style scoped lang="scss">
@import '/resources/css/mixin.scss';
.modal-header{
    border: none!important;
}
.float-right{
    font-size: 2rem;
}
h3 {

    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    @include adaptiv-font(24, 18);
    line-height: 29px;
    text-transform: uppercase;
    color: #000000;
}

.description {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(14, 12);
    line-height: 17px;
    color: #000000;
}

img {
    border-radius: 20px;
}

@media only screen and (max-width: 767px) {
    img {
        margin-top: 1rem;
    }
}

.bg-about {

    height: 100%;
    width: 100%;

    &:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 5;
    }
}

.h2 {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    @include adaptiv-font(36, 28);
    line-height: 50px;

    color: #FFFFFF;
}

.bg-additional-services {
    height: 100%;
    width: 100%;

    &:before {
        content: '';
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 5;
    }
}

p {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;

    color: #FFFFFF;
}
</style>
