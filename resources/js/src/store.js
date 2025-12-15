import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            service:null,
            widget:false,
            sendLoading:0,
            tabs:null,
            favourites:[],
            currentId:null,
            modal:{
                on:false,
                name:''
            },
            width: 0,
            aside: 'default',
            errors: [],
            user: null,
            accessToken: '',
            settings: null,
            access: false,
            media: {
                id: null,
                basket_id: 2,
                video_id: 3,
                countFile: 1,
                route: 'folders',
                active: false,
                selected: [],
                folder: null,
                deleteImages: [],
                folders: [],
                images: [],

                current: null,
                copy: null,
                filter: {
                    paginate: 10,
                    selectSort: 'orderByDesc',
                    sortField: 'id',
                    page: 1,
                    search: '',
                    folder: 1,
                },


            },
            crop: {
                cropImage: null,
                cropImageChange: null,
                ratio: {
                    aspectRatio:16 / 9
                },
                defaultPosition: {
                    left: 100,
                    top: 100
                },
                defaultSize: {
                    width: 400,
                    height: 400
                },
            },
            dropZone: {
                start:false,
                path: '/api/v1/images/dropzone/store',
                maxFiles: 20,
                maxFilesize: 10,
                acceptedFiles: 'image/*',
                parallelUploads: 20,
                preview: {
                    width: 100,
                    height: 100,
                },
                params: {},
                files: [],
                img_files: null,
            },
            resource:{
                form:{
                    tags:[]
                },
                default:null,
                tags:null,
                fields:[],
                resources:null,
                route:'lists',
                filter:{
                    search:'',
                    sort:'orderByDesc',
                    paginate:10,
                    page:1,
                    ids:[],


                }
            },
            ids:[],
            page:{
                currentContainer:0,
                title: '',
                description: '',
                head: '',
                name: '',
                slug: '',
                active: true,
                publish: false,
                data: [],
            },
            form:{
                name: '',
                method: 'default',
                size: 'modal-xl',
                statement_text: '',
                statement: true,
                active: true,
                bitrix: false,
                save: false,
                logo: true,
                sort: 0,
                popup: true,
                currentRow:0,
                currentCol:0,
                data:[],
            },
            menu:{
                action:'create'
            },
            category:{
                action:'create',
                name:'',
            },
            offer:null,
            offers:{
                offer:null,
                properties: [],
                types: [],
                typesOn: [],
            },
            categories:[]

        }
    },
    mutations: {},
    getters: {}
})

export default store;
