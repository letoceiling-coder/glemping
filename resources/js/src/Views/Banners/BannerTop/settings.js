export default {
    fields: [

        {
            label: "Фоновое фото",
            space: "bg-image",
            type: 'bg-image',
            image: {
                name: '',
                src: '',
                webp: '',
                size: null,
            }
        },

        {
            label:"Спец.предложения",
            space:"special_offers",
            type:'resource',
            resource:{
                name:'Спец.предложения',
                route:'special_offers',
                filters:{
                    sort: 'orderBy',
                    paginate:0,
                    ids:[],
                },
            },


        },
        {
            label:"Коллекция предложений",
            space:"collect-stocks",
            type:'resource',
            resource:{
                name:'Коллекция акций',
                route:'stocks',
                filters:{
                    limit: 5,
                    sort: 'orderBy',
                    paginate:0,
                    ids:[],
                },
            },


        },


    ],

}
