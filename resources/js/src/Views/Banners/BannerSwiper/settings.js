export default {
    fields:[

        {
            label:"Баннер слайдер",
            space:"bannerSwiper",
            type:'resource',
            resource:{
                name:'Баннер слайдер',
                route:'banner_swipers',
                filters:{
                    sort: 'orderBy',
                    paginate:0,
                },
            },


        },
        {
            label:"Соотношение стророн баннера ",
            space:"ratio",
            type:'ratio',
            descTop:{
                label:'DescTop',
                numerator:3,
                denominator :1,
            },
            mobile:{
                label:'Mobile',
                numerator:1,
                denominator :1,
            },
        }


    ],

}
