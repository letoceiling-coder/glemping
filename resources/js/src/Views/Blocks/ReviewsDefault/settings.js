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
            label: "Заголовок ",
            space: "title",
            type: 'string',
            text: 'фото наших клиентов'
        },
        {
            label:"Коллекция предложений",
            space:"collect-images",
            type:'resource',
            resource:{
                name:'Коллекция фото',
                route:'reviews',
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
