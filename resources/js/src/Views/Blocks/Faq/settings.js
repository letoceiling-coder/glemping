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
            text: "ВОПРОСЫ И ОТВЕТЫ"
        },
        {
            label: "Фото",
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
            label: "FAQ",
            space: "faq",
            type: 'faq',
            data: [
                {
                    active:true,
                    question:'Как подобрать домик?',
                    answer:'We specialize in branding, UI/UX design, motion graphics, campaign assets, and content production. Whether you need a full brand identity or a quick-turn digital campaign, we’ve got you covered.',

                },
                {
                    active:false,
                    question:'Как забронировать онлайн?',
                    answer:'We specialize in branding, UI/UX design, motion graphics, campaign assets, and content production. Whether you need a full brand identity or a quick-turn digital campaign, we’ve got you covered.',

                },

                {
                    active:false,
                    question:'Во сколько заселение в домик',
                    answer:'We specialize in branding, UI/UX design, motion graphics, campaign assets, and content production. Whether you need a full brand identity or a quick-turn digital campaign, we’ve got you covered.',

                },

                {
                    active:false,
                    question:'Есть ли раннее заселение?',
                    answer:'We specialize in branding, UI/UX design, motion graphics, campaign assets, and content production. Whether you need a full brand identity or a quick-turn digital campaign, we’ve got you covered.',

                },



            ],
        },



    ],

}
