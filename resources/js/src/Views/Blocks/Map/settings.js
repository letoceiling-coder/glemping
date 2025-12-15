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
            label: "Карта фото",
            space: "image",
            type: 'image',
            image: {
                name: '',
                src: '',
                webp: '',
                size: null,
            }
        },
        {
            label:"Коллекция предложений",
            space:"collect-offers",
            type:'resource',
            resource:{
                name:'Коллекция предложений',
                route:'offers',
                filters:{
                    limit: 0,
                    sort: 'orderBy',
                    paginate:0,
                    ids:[],
                },
            },


        },


    ],

}
