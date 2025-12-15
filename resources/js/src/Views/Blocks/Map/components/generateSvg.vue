<template>


    <svg v-if="offers" width="100%" viewBox="0 0 1634 1089" preserveAspectRatio="xMidYMid meet" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <rect width="1634" height="1089" fill="url(#map-container)"/>

        <rect v-for="offer in offers" :x="offer.pos_x" :y="offer.pos_y" :width="offer.width" :height="offer.height" :fill="`url(#pattern-${offer.id})`" class="pattern" ></rect>

        <use v-for="offer in offers" :xlink:href="`#pluck-${offer.id}`" :x="offer.pos_x" :y="offer.pos_y" class="alert-home" @mouseover="over($event)" @mouseout="out($event)"/>


        <defs v-for="offer in offers">

            <g :id="`pluck-${offer.id}`">
                <rect width="18%" height="90" rx="10" fill="white"/>
<!--                <text  class="text" x="10" y="25"  style="font-family: 'Montserrat'; font-style: normal;" fill="black" textLength="15%" lengthAdjust="spacingAndGlyphs" >{{-->
                <text  class="text" x="10" y="25"  style="font-family: 'Montserrat'; font-style: normal;" fill="black"  >{{
                        offer.name
                    }} </text>
                <text  class="text" style="font-family: 'Montserrat'; font-style: normal;"  fill="black" x="10" y="60" >{{offer.price}} р/ночь</text>
                <a :xlink:href="offer.slug">
                    <rect x="0.285633" y="94.2856" width="18%" height="29.4287" rx="3.35073" fill="#00BA57" class="cursor" />
                    <text style="font-family: 'Montserrat'; font-style: normal;" class="text cursor" x="90" y="115"  fill="#fff">Забронировать</text>
                </a>
                <rect x="13%" y="7" width="76" height="76" rx="5" fill="url(#alert-1)"/>
                <defs>
                    <pattern id="alert-1" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use :xlink:href="`#alert-image-${offer.id}`" transform="translate(-0.0595454) scale(0.00078064)"/>
                    </pattern>
                    <image v-if="getOfferImageWebpSafe(offer)" :id="`alert-image-${offer.id}`" width="1920" height="1281" preserveAspectRatio="none" :xlink:href="getOfferImageWebpSafe(offer)"/>
                </defs>
            </g>


            <pattern :id="`pattern-${offer.id}`" patternContentUnits="objectBoundingBox" width="1" height="1" >
                <use :xlink:href="`#house-${offer.id}`" transform="matrix(0.00120192 0 0 0.00203764 0 -0.00125826)" ></use>
            </pattern>
            <image v-if="images && images.find(item => item.id == offer.image_id)" :id="`house-${offer.id}`"  preserveAspectRatio="xMidYMid meet" :xlink:href="images.find(item => item.id == offer.image_id)?.path || ''" ></image>
        </defs>



        <defs>
            <pattern id="map-container" patternContentUnits="userSpaceOnUse" width="1634" height="1089">
                <image id="map" x="0" y="0" width="1634" height="1089" preserveAspectRatio="xMidYMid meet" :xlink:href="mapImage || '/map3.webp'"/>
            </pattern>
        </defs>






    </svg>
</template>

<script>
export default {
    props:{
        offers:Object,
        images:Object,
        mapImage: String,
    },
    name: "generateSvg",
    data() {
        return {
            _offerImageCache: null
        }
    },
    mounted() {
        this._offerImageCache = new Map();
    },
    methods:{
        over(e){
            $(e.target).addClass('active')
        },
        out(e){
            $(e.target).removeClass('active')
        },
        getOfferImageWebpSafe(offer) {
            if (!this._offerImageCache) {
                this._offerImageCache = new Map();
            }
            
            const cacheKey = offer?.id || 'unknown';
            if (this._offerImageCache.has(cacheKey)) {
                return this._offerImageCache.get(cacheKey);
            }
            
            let result = '';
            try {
                console.log('=== OFFER IMAGE WEBP DEBUG ===');
                console.log('offer:', offer);
                console.log('offer.id:', offer?.id);
                console.log('offer.images:', offer?.images);
                console.log('offer.images type:', typeof offer?.images);
                console.log('offer.images isArray:', Array.isArray(offer?.images));
                
                if (!offer) {
                    console.log('NO offer');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                if (!offer.images) {
                    console.log('NO offer.images');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                if (!Array.isArray(offer.images)) {
                    console.log('offer.images is NOT array');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                if (offer.images.length === 0) {
                    console.log('offer.images is EMPTY array');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                
                const firstImage = offer.images[0];
                console.log('firstImage:', firstImage);
                console.log('firstImage type:', typeof firstImage);
                console.log('firstImage === null:', firstImage === null);
                console.log('firstImage === undefined:', firstImage === undefined);
                
                if (firstImage === null || firstImage === undefined) {
                    console.log('firstImage is null/undefined');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                if (typeof firstImage !== 'object') {
                    console.log('firstImage is NOT object');
                    this._offerImageCache.set(cacheKey, result);
                    return result;
                }
                
                console.log('firstImage hasOwnProperty webp:', firstImage.hasOwnProperty('webp'));
                if (firstImage.hasOwnProperty('webp')) {
                    const webpValue = firstImage.webp;
                    console.log('webpValue:', webpValue);
                    console.log('webpValue type:', typeof webpValue);
                    if (webpValue !== null && webpValue !== undefined && typeof webpValue === 'string' && webpValue.trim() !== '') {
                        result = webpValue;
                        console.log('RETURNING webp:', result);
                    } else {
                        console.log('webpValue is invalid');
                    }
                } else {
                    console.log('NO webp property');
                }
                
                this._offerImageCache.set(cacheKey, result);
                return result;
            } catch (e) {
                console.error('ERROR in getOfferImageWebpSafe:', e);
                console.error('Error stack:', e.stack);
                this._offerImageCache.set(cacheKey, result);
                return result;
            }
        }
    }
}
</script>

<style scoped>
svg {
    width: 100%;
    max-width: 100%;
    display: block;
}

.text{
    font-family: 'Onest';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 18px;
}
.cursor{cursor:pointer;}
.white{color:#fff}
.price{
    font-family: 'Onest';
    font-style: normal;
    font-weight: 500;
    font-size: 12px;
    line-height: 15px;
    color: #000000;
}
.alert-home{
    opacity:0;
    transition: opacity .6s linear;
}
.active{
    display:block;
    opacity:1;
    transition: opacity .6s linear;
}
.pattern {
    pointer-events: none;
}
</style>
