export  class ContentColumn {

    constructor(col = null) {

        this.col.col = col
        this.col.on = true
    }
    col = {
        settings: Content.getSettings()
    }

    grids = [
        // 'xl',
        'lg',
        'md',
        'sm'
    ]
    cols(...cols){

        if (cols.length > 1) {

            this.className(   cols.map((item, grid) => {

                return `col-${this.grids[grid]}-${item}`
            }).toString().replaceAll(',', ' '))
        }else if(cols.length === 1){
            this.className(`col-${this.grids[0]}-${cols[0]}`)
        }else {
            this.className('col')
        }

        return this
    }

    colSm(col = null){
        this.col.colSm = col
        return this
    }
    bg(){
        console.log(this.col.col)
        // this.col.col.bgImage = {
        //     label:'BG',
        //     value:{},
        // }
        return this
    }
    get() {
        return this.col
    }
    empty(){
        return {}
    }
    make(...args){
        return new Content(args).getContent()
    }

    className(value){
        if (typeof value == 'string'){
            this.col.settings.className = value
        }

        return this
    }
    onOff(){
        this.col.on = true
        return this
    }
    setting(name,value = null){
        if (typeof name == 'string'){
            this.col.settings[name] = value
        }
        if (typeof name == 'object'){

            Object.entries(name).forEach(([key, value]) => {
                this.col.settings[key] = value
            });

        }

        return this

    }
    hr(){
        this.type('tag')
        this.space('hr')
        this.label('hr')
        return this.value(null)

    }
    data(...value){
        this.type('data')
        this.space('data')
        this.label('Collection')
        return this.value([value])
    }
    breadcrumbs(value){
        this.type('string')
        this.space('breadcrumbs')
        this.label('breadcrumbs')
        this.value(value)
        return this.get()
    }
    attr(attr,value){
        this.col[attr] = value
        this.col.value = this.col[attr]
        return this
    }
    setCol(type = '', label = '', space = '', value = null) {

        if (typeof type == 'string') {
            let component = Content.components[type]
            component.label = label ? label : component.label
            component.space = space ? space : component.space
            component.value = value ? value : component.value
            this.col = component
        } else {
            this.col = type
        }
        return this
    }


    value(value = undefined, def = null) {
        if (value !== undefined) {
            this.col.value = this.col.value ? this.col.value : value
        } else if (def) {
            this.col.value = this.col.value ? this.col.value : def
        }
        return this

    }

    space(space = undefined) {
        if (space !== undefined) {
            this.col.space = space
        }
        return this

    }


    label(label = undefined) {
        if (label !== undefined) {
            this.col.label = label
        }
        return this
    }

    type(type = undefined) {
        if (type !== undefined) {
            this.col.type = type
        }
        return this
    }

    string(value = null) {
        this.type('string')
        this.space('string')
        this.label('string')
        return this.value(value)
    }


    text(value = null) {
        this.type('textarea')
        this.space('textarea')
        this.label('textarea')
        return this.value(value)
    }

    html(value = null) {
        this.type('html')
        this.space('html')
        this.label('html')
        return this.value(value)
    }

    btn(value = null) {
        this.type('btn')
        this.space('btn')
        this.label('кнопка')
        return this.value(value)
    }
    icon(value = null) {
        this.type('icon')
        this.space('icon')
        this.label('icon')
        return this.value(value)
    }

    iconText(value = {}) {
        this.type('iconText')
        this.space('iconText')
        this.label('iconText')
        return this.value(value)
    }

    image(value = undefined) {
        this.type('image')
        this.space('image')
        this.label('image')

        return this.value(value, {
            id: '',
            name: '',
            src: '',
            webp: '',
        })
    }
    slideDown(value = undefined) {
        this.type('slideDown')
        this.space('slideDown')
        this.label('slideDown')

        return this.value(value, [])
    }
    imageBgText(value = undefined) {
        this.type('image-bg-text')
        this.space('image-bg-text')
        this.label('image-bg-text')

        return this.value(value, {
           image:{
               id: '',
               name: '',
               src: '',
               webp: '',
           },
            text:''
        })
    }

    imageBgTextLabel(value = undefined) {
        this.type('image-bg-text-label')
        this.space('image-bg-text-label')
        this.label('image-bg-text-label')

        return this.value(value, {
           image:{
               id: '',
               name: '',
               src: '',
               webp: '',
           },
            link:'',
            label:'',
            text:'',
        })
    }

    images(value = undefined, count = 5) {
        this.type('images')
        this.space('image')
        this.label('image')
        this.file(count)
        return this.value(value, [])
    }
    file(count){
        this.col.settings.countFile = count
    }


}

export  class ContentRow {
    row = {
        cols:[]
    }
    constructor(col = null) {
        this.row.cols = col ? col : []
    }
    setRow(col){
        this.row.cols.push(col)
    }
    getRow(){
        return this.row
    }

    setClassName(value){
        this.row.className = value
        return this
    }
    checkCols(cols) {

        let col = 12
        if (cols.find(item => item.col != null)) {

            cols.map(item => {
                if (item.col) {
                    col -= item.col
                    item.col = `col-lg-${item.col} `
                }
                return item
            })


        }

        let colCustom = cols.filter(item => item.col == null).length

        if (col % colCustom === 0) {
            cols.filter(item => item.col == null).map(item => {

                col -= col / colCustom
                item.col = `col `
                // item.col = `col-lg-${col / colCustom} `


                return item
            })

            if (col <= 0 ){
                console.log(('Неправильно создан ряд (Колонок больше...)'));
            }
        } else {


            let colChange = parseInt(col / colCustom)

            let colCount = cols.filter(item => item.col == null).length
            if (col < colCount){
                console.log(('Неправильно создан ряд (Колонок больше...)'));
            }


            cols.filter(item => item.col == null).map((item, index) => {

                item.col = `col `
                // item.col = `col-lg-${col < colChange ? col : colChange} `
                col -= colChange
                if (colCount - 1  === index ) {
                    item.col = `col `
                    // item.col = `col-lg-${col + colChange} `
                    col -= col
                }

                if (col < 0 ){
                    console.log(('Неправильно создан ряд (Колонок больше...)'));
                }
                return item
            })


        }

        console.log(cols)
        return cols

    }

}

export  class Content {

    constructor(rows = null) {
        this.content = {
            label: "Контент",
            space: "content",
            type: 'content',
            className: '',

            settings: Content.getSettings(),
            content: rows
        }
    }
    bg(){

        this.content.bgImage = {
            label:'',
            value:{}
        }

        return this
    }
    link(){
        this.content.link = '/'
        return this
    }
    className(value){
        if (typeof value == 'string'){
            this.content.className = value
        }


        return this
    }
    setting(name,value = null){
        if (typeof name == 'string'){
            this.content.settings[name] = value
        }
        if (typeof name == 'object'){

            Object.entries(name).forEach(([key, value]) => {
                this.content.settings[key] = value
            });

        }

        return this

    }

    getContent(){
        return this.content;
    }
    static components = {

        string: {
            label: "Строка",
            space: "string",
            type: 'string',
            value: '',
            settings: this.getSettings(),
        },
        text: {
            label: "Текст",
            space: "textarea",
            type: 'textarea',
            value: '',
            settings: this.getSettings(),
        },
        html: {
            label: "HTML",
            space: "html",
            type: 'html',
            value: '',
            settings: this.getSettings(),
        },
        image: {
            label: "Фото",
            space: "image",
            type: 'image',
            value: {
                src: '',
                webp: '',
                name: '',
            },
            settings: this.getSettings(),
        },
        images: {
            label: "Галерея фото",
            space: "images",
            type: 'images',
            value: [],
            settings: this.getSettings(),
        },
    }

    static getSettings() {
        return {
            height: null,
            width: null,
            ratio: null,
            margin: {
                t: 0,
                r: 0,
                b: 0,
                l: 0,
            },
            padding: {
                t: 0,
                r: 0,
                b: 0,
                l: 0,
            },
            className: ''
        }
    }
}

export function make(...row) {

    return new Content(row).getContent()
}

export function col(col = null) {
    return new ContentColumn(col)
}


export function row(...col ) {
    return new ContentRow(col).getRow()
}
export function rowClass(...col ) {
    return new ContentRow(col)
}
export function rows(...row ) {

    return new Content(row)
}


