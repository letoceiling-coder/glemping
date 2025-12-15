<template>


    <div :class="this.appendClass(data.view)" :id="`id-${data.id}`">
        <div class="bg-map relative pb-3 pt-5">
            <div class="map-container w-100">
                <SvgMapGenerate :images="images" :offers="getField('collect-offers')?.resource?.data" :mapImage="mapImageUrl"/>
                <SvgMapSettings :offers="getField('collect-offers')?.resource?.data" :images="images" v-if="this.storage.settings.user?.role_id >= 999"/>
            </div>
        </div>


    </div>

</template>

<script>
// import SvgMap from './components/svgMap.vue'
import SvgMapGenerate from './components/generateSvg.vue'
import SvgMapSettings from './components/settingsMap.vue'

export default {
    components: { SvgMapGenerate, SvgMapSettings},
    name: "index",
    props: {
        data: Object,
    },
    data() {
        return {
            images:[
                {
                    id:1,
                    path:'/img/homes/1.png'
                },
                {
                    id:2,
                    path:'/img/homes/2.png'
                },
                {
                    id:3,
                    path:'/img/homes/3.png'
                },
                {
                    id:4,
                    path:'/img/homes/4.png'
                },
                {
                    id:5,
                    path:'/img/homes/5.png'
                },
                {
                    id:6,
                    path:'/img/homes/6.png'
                },
                {
                    id:7,
                    path:'/img/homes/7.png'
                },
                {
                    id:8,
                    path:'/img/homes/8.png'
                },
                {
                    id:9,
                    path:'/img/homes/9.png'
                },
                {
                    id:10,
                    path:'/img/homes/10.png'
                },
                {
                    id:11,
                    path:'/img/homes/11.png'
                },
                {
                    id:12,
                    path:'/img/homes/12.png'
                },
                {
                    id:13,
                    path:'/img/homes/13.png'
                },
                {
                    id:14,
                    path:'/img/homes/14.png'
                },
                {
                    id:15,
                    path:'/img/homes/15.png'
                },
                {
                    id:16,
                    path:'/img/homes/16.png'
                },
            ]
        }
    },
    computed: {
        mapImageUrl() {
            try {
                const imageField = this.getField('image');
                if (!imageField) return null;
                
                // Алгоритм поиска оригинального изображения (src):
                // 1. Компонент image.vue сохраняет данные в setting.value = setting.image
                // 2. При сохранении страницы данные отправляются как value
                // 3. При загрузке данные могут быть в value или в image
                
                let imageSrc = null;
                
                // Вариант 1: данные в image.src (если загружены из settings.js)
                if (imageField.image && typeof imageField.image === 'object' && imageField.image.src) {
                    imageSrc = imageField.image.src;
                }
                // Вариант 2: данные в value.src (данные сохранены и загружены с сервера)
                else if (imageField.value && typeof imageField.value === 'object') {
                    // Если value содержит src напрямую
                    if (imageField.value.src) {
                        imageSrc = imageField.value.src;
                    }
                    // Если value содержит image объект
                    else if (imageField.value.image && imageField.value.image.src) {
                        imageSrc = imageField.value.image.src;
                    }
                }
                
                if (imageSrc && typeof imageSrc === 'string' && imageSrc.trim() !== '') {
                    // Убеждаемся что путь корректный
                    if (imageSrc.startsWith('/') || imageSrc.startsWith('http://') || imageSrc.startsWith('https://')) {
                        return imageSrc;
                    }
                    return '/' + imageSrc;
                }
                
                return null;
            } catch (e) {
                console.error('Error in mapImageUrl:', e);
                return null;
            }
        }
    },
    methods: {

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

.bg-map {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
}

.map-container {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    
    svg {
        max-width: 100%;
        height: auto;
        display: block;
    }
}

</style>
