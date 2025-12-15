//////////////////////////////////AUTH////////////////////////////////////


import Forget from '/resources/js/src/Views/Auth/Forget/index.vue';
import ForgetSettings from '/resources/js/src/Views/Auth/Forget/settings.js';

import Login from '/resources/js/src/Views/Auth/Login/index.vue';
import LoginSettings from '/resources/js/src/Views/Auth/Login/settings.js';

import Register from '/resources/js/src/Views/Auth/Register/index.vue';
import RegisterSettings from '/resources/js/src/Views/Auth/Register/settings.js';

//////////////////////////////////AUTH////////////////////////////////////

//////////////////////////////////FOOTERS////////////////////////////////////

//////////////////////////////////FOOTERS////////////////////////////////////

//////////////////////////////////COMPONENTS////////////////////////////////////



//////////////////////////////////COMPONENTS////////////////////////////////////

//////////////////////////////////TEMPLATE////////////////////////////////////


import CatalogTemplate from '/resources/js/src/Views/Template/Catalog/index.vue';
import CatalogTemplateSettings from '/resources/js/src/Views/Template/Catalog/settings.js';
import Booking from '/resources/js/src/Views/Template/Booking/index.vue';
import BookingSettings from '/resources/js/src/Views/Template/Booking/settings.js';
import DefaultHtml from '/resources/js/src/Views/Template/Default/index.vue';
import DefaultHtmlSettings from '/resources/js/src/Views/Template/Default/settings.js';
//////////////////////////////////TEMPLATE////////////////////////////////////

//////////////////////////////////Header////////////////////////////////////


import Header from '/resources/js/src/Views/Headers/Header/index.vue';
import HeaderSettings from '/resources/js/src/Views/Headers/Header/settings.js';

//////////////////////////////////Header////////////////////////////////////

//////////////////////////////////BANNER////////////////////////////////////

// import BannerSwiper from '/resources/js/src/Views/Banners/BannerSwiper/index.vue';
// import BannerSwiperSettings from '/resources/js/src/Views/Banners/BannerSwiper/settings.js';

import BannerTop from '/resources/js/src/Views/Banners/BannerTop/index.vue';
import BannerTopSettings from '/resources/js/src/Views/Banners/BannerTop/settings.js';


//////////////////////////////////BANNER////////////////////////////////////

//////////////////////////////////Forms////////////////////////////////////


//////////////////////////////////Forms////////////////////////////////////


//////////////////////////////////CARDS////////////////////////////////////

//////////////////////////////////CARDS////////////////////////////////////

//////////////////////////////////BLOCKS////////////////////////////////////

import About from '/resources/js/src/Views/Blocks/About/index.vue'
import AboutSettings from '/resources/js/src/Views/Blocks/About/settings.js';

import Catalog from '/resources/js/src/Views/Blocks/Catalog/index.vue'
import CatalogSettings from '/resources/js/src/Views/Blocks/Catalog/settings.js';


import Included from '/resources/js/src/Views/Blocks/Included/index.vue'
import IncludedSettings from '/resources/js/src/Views/Blocks/Included/settings.js';


import Service from '/resources/js/src/Views/Blocks/Service/index.vue'
import ServiceSettings from '/resources/js/src/Views/Blocks/Service/settings.js';


import NumberGuest from '/resources/js/src/Views/Blocks/NumberGuest/index.vue'
import NumberGuestSettings from '/resources/js/src/Views/Blocks/NumberGuest/settings.js';


import BronBlock from '/resources/js/src/Views/Blocks/BronBlock/index.vue'
import BronBlockSettings from '/resources/js/src/Views/Blocks/BronBlock/settings.js';


import Faq from '/resources/js/src/Views/Blocks/Faq/index.vue'
import FaqSettings from '/resources/js/src/Views/Blocks/Faq/settings.js';


import Contact from '/resources/js/src/Views/Blocks/Contact/index.vue'
import ContactSettings from '/resources/js/src/Views/Blocks/Contact/settings.js';


import Reviews from '/resources/js/src/Views/Blocks/Reviews/index.vue'
import ReviewsSettings from '/resources/js/src/Views/Blocks/Reviews/settings.js';
import ReviewsDefault from '/resources/js/src/Views/Blocks/ReviewsDefault/index.vue'
import ReviewsDefaultSettings from '/resources/js/src/Views/Blocks/ReviewsDefault/settings.js';


import Map from '/resources/js/src/Views/Blocks/Map/index.vue'
import MapSettings from '/resources/js/src/Views/Blocks/Map/settings.js';

import NotFound from '/resources/js/src/Views/Blocks/NotFound/index.vue'
import NotFoundSettings from '/resources/js/src/Views/Blocks/NotFound/settings.js';

//////////////////////////////////BLOCKS////////////////////////////////////

//////////////////////////////////TAGS////////////////////////////////////

//////////////////////////////////TAGS////////////////////////////////////


const settingsComponent = {


    NotFound: NotFoundSettings,
    BannerTop: BannerTopSettings,
    About: AboutSettings,
    Catalog: CatalogSettings,
    Included: IncludedSettings,
    Service: ServiceSettings,
    NumberGuest: NumberGuestSettings,
    BronBlock: BronBlockSettings,
    Faq: FaqSettings,
    Contact: ContactSettings,
    ReviewsDefault: ReviewsDefaultSettings,
    Reviews: ReviewsSettings,
    Map: MapSettings,


    Login: LoginSettings,
    Register: RegisterSettings,
    Forget: ForgetSettings,

    Header: HeaderSettings,

    CatalogTemplate: CatalogTemplateSettings,
    Booking: BookingSettings,
    DefaultHtml: DefaultHtmlSettings,


}
const comp = {
    NotFound,
    BannerTop,
    About,
    Catalog,
    Included,
    Service,
    NumberGuest,
    BronBlock,
    Faq,
    Contact,
    Reviews,
    ReviewsDefault,
    Map,
    Login,
    Register,
    Forget,

    Header,

    CatalogTemplate,
    Booking,
    DefaultHtml,
}

class VRC {
    data = null
    settingsComponent = settingsComponent

    categories = [
        // {id: 'Components', name: 'Компоненты'},
        {id: 'Headers', name: 'Headers'},
        {id: 'Banners', name: 'Банеры'},
        // {id: 'Cards', name: 'Карточки'},
        {id: 'Blocks', name: 'Блоки'},
        {id: 'Templates', name: 'Шаблоны'},
        // {id: 'Footers', name: 'Подвал'},
        {id: 'Forms', name: 'Формы'},
        {id: 'Auth', name: 'Авторизация'},
        // {id: 'Tags', name: 'Теги'},


    ];
    mapComponents = []
    mapComponent = {}
    registerComponents = [



        {
            id: 1,
            category: this.getCategory('Banners'),
            name: 'Баннер',
            preview: '/img/template/BannerTop.png',
            component: 'BannerTop',
            path: '',
        },
        {
            id: 2,
            category: this.getCategory('Auth'),
            name: 'Авторизация',
            preview: '/img/template/Login.png',
            component: 'Login',
            path: '',
        },
        {
            id: 3,
            category: this.getCategory('Auth'),
            name: 'Регистрация',
            preview: '/img/template/Register.png',
            component: 'Register',
            path: '',
        },
        {
            id: 4,
            category: this.getCategory('Auth'),
            name: 'Востановление пароля',
            preview: '/img/template/Forget.png',
            component: 'Forget',
            path: '',
        },
        {
            id: 5,
            category: this.getCategory('Blocks'),
            name: 'О нас',
            preview: '/img/template/About.png',
            component: 'About',
            path: '',
        },
        {
            id: 6,
            category: this.getCategory('Blocks'),
            name: 'Каталог',
            preview: '/img/template/Catalog.png',
            component: 'Catalog',
            path: '',
        },
        {
            id: 7,
            category: this.getCategory('Blocks'),
            name: 'Сервисы',
            preview: '/img/template/Included.png',
            component: 'Included',
            path: '',
        },
        {
            id: 8,
            category: this.getCategory('Blocks'),
            name: 'Услуги',
            preview: '/img/template/Service.png',
            component: 'Service',
            path: '',
        },
        {
            id: 9,
            category: this.getCategory('Blocks'),
            name: 'Количество гостей',
            preview: '/img/template/NumberGuest.png',
            component: 'NumberGuest',
            path: '',
        },
        {
            id: 10,
            category: this.getCategory('Blocks'),
            name: 'Бронирование',
            preview: '/img/template/BronBlock.png',
            component: 'BronBlock',
            path: '',
        },
        {
            id: 11,
            category: this.getCategory('Blocks'),
            name: 'Faq',
            preview: '/img/template/Faq.png',
            component: 'Faq',
            path: '',
        },
        {
            id: 12,
            category: this.getCategory('Blocks'),
            name: 'Контакты',
            preview: '/img/template/Contact.png',
            component: 'Contact',
            path: '',
        },
        {
            id: 13,
            category: this.getCategory('Blocks'),
            name: 'Отзывы',
            preview: '/img/template/Reviews.png',
            component: 'Reviews',
            path: '',
        },

        {
            id: 14,
            category: this.getCategory('Blocks'),
            name: 'Карта',
            preview: '/img/template/Map.png',
            component: 'Map',
            path: '',
        },
        {
            id: 15,
            category: this.getCategory('Headers'),
            name: 'Header',
            preview: '/img/template/Header.png',
            component: 'Header',
            path: '',
        },
        {
            id: 16,
            category: this.getCategory('Templates'),
            name: 'Catalog',
            preview: '',
            component: 'CatalogTemplate',
            path: '',
        },
        {
            id: 17,
            category: this.getCategory('Templates'),
            name: 'Booking',
            preview: '',
            component: 'Booking',
            path: '',
        },
        {
            id: 20,
            category: this.getCategory('Templates'),
            name: 'DefaultHtml',
            preview: '',
            component: 'DefaultHtml',
            path: '',
        },
        {
            id: 21,
            category: this.getCategory('Blocks'),
            name: 'Отзывы default',
            preview: '/img/template/ReviewsDefault.png',
            component: 'ReviewsDefault',
            path: '',
        },
        {
            id: 22,
            category: this.getCategory('Blocks'),
            name: 'NotFound',
            preview: '/img/template/NotFound.png',
            component: 'NotFound',
            path: '',
        },

    ]

    setData(data) {
        this.data = data
        return this
    }

    importSetting(name) {
        console.log(name)
        return JSON.parse(JSON.stringify(this.settingsComponent[name]))
    }


    checkFieldsChildren(fieldsComponent, fields = null) {

        if (fields) {
            for (const [index, value] of Object.entries(fieldsComponent)) {

                if (!fields[index]) {
                    fields[index] = value
                }
            }
            return fields;
        } else {
            return fieldsComponent;
        }


    }

    checkFields(fieldsComponent, fields = null) {

        if (fields) {

            for (let i = 0; i < fieldsComponent.length; i++) {

                for (const [index, value] of Object.entries(fieldsComponent[i])) {

                    if (index == 'space' && !fields.find(s => s.space == value)) {

                        fields.push(fieldsComponent[i])
                    }

                }
            }

            return JSON.parse(JSON.stringify(fields))
        } else {
            return JSON.parse(JSON.stringify(fieldsComponent))
        }


    }

    getCategory(name) {
        return this.categories.find(item => item.id === name)
    }

    getFields(name) {
        return this.importSetting(name).fields[0].fields
    }

    getFilter() {
        return {
            sort: [
                {id: 'orderByDesc', name: 'по убыванию'},
                {id: 'orderBy', name: 'по возврастанию'},
                {id: 'ids', name: 'по ID'},
            ],

        };
    }

    generatePath(item) {
        return `/resources/js/src/Views/${item.category.id}/${item.component}/`
    }

    getFiltersResource(resources) {
        return {
            resources: resources,
            sorts: {
                ids: ''
            }
        }
    }

    appendSettings(settings = null) {
        let sett = {
            marginTop: 'mt-0',
            marginBottom: 'mb-0',
        }

        if (settings) {
            for (const [key, value] of Object.entries(sett)) {
                if (!settings[key]) {
                    settings[key] = value
                }
            }
            return settings;
        } else {
            return sett;
        }

    }

    getComponents(id = null) {

        if (id) {
            return this.registerComponents.filter(item => item.category.id == id)
        }
        return this.registerComponents

    }

    getComponentsCard() {

        return this.getComponents('Cards')

    }

    getProperty(properties, name) {
        return properties.find(item => item.type = name)
    }

    importComponents() {
        for (let i = 0; i < this.registerComponents.length; i++) {

            this.mapComponent['mi-' + this.registerComponents[i].component] = comp[this.registerComponents[i].component]

        }
        return this.mapComponent
    }

    chunkArray(array, chunk) {


        const res = [];
        while (array.length > 0) {

            res.push(chunk);
        }

        return res;

    }


}

export default VRC
