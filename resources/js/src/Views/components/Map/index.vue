<template>
    <div v-if="data" id="maps">
        <h2 class="mt-5">{{data.name}}</h2>
        <div v-if="data.value.html" class="mt-4" v-html="data.value.html"></div>
        <div id="map" class="mt-4">

        </div>

    </div>



</template>

<script>
export default {

    props: {
        data: Object,

    },
    watch:{
        'data': {
            handler: function (data) {
                if(data.value.cords){
                    this.mapInit()
                }

            },
            deep: true,
            immediate: true
        },
    },
    mounted() {

    },
    methods: {
        mapInit() {
            console.log(123)
            let myMap;
            let _ = this
            console.log(_.data.value.cords)
            ymaps.ready().then(() => {
                $('#map').empty();
                myMap = new ymaps.Map("map", {
                    center: [_.data.value.cords[1],_.data.value.cords[0]],
                    zoom: 10,
                    controls: []
                }, {});

                let myPlacemark = new ymaps.Placemark([_.data.value.cords[1],_.data.value.cords[0]], null,{
                    iconLayout: 'default#image',
                    iconImageHref: "/img/map-icon.png",
                    iconImageSize: [30, 44],
                    iconImageOffset: [-15, -44]
                });
                console.log(myPlacemark)
                myMap.geoObjects.add(myPlacemark);
            });


        },
    }
}
</script>

<style scoped>
#map{
    height: 400px;
    width: 100%;
}
</style>
