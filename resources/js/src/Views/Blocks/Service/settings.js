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
            text: 'ДОПОЛНИТЕЛЬНЫЕ УСЛУГИ'
        },
        {
            label: "Заголовок",
            space: "description",
            type: 'string',
            text: 'Вы можете заказать дополнительные услуги заранее, при бронировании коттеджа, либо по факту, после заселении'
        },


        {
            label:"Коллекция предложений",
            space:"collect-service",
            type:'resource',
            resource:{
                name:'Коллекция предложений',
                route:'services',
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
