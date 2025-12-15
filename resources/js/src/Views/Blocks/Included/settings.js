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
            label: "Заголовок",
            space: "title",
            type: 'string',
            text: 'ЧТО ВХОДИТ'
        },


        {
            label:"Коллекция предложений",
            space:"collect-include",
            type:'resource',
            resource:{
                name:'Коллекция предложений',
                route:'include_services',
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
