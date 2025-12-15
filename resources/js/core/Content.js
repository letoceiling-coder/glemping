import {Rows ,Row} from './Rows'
import {Column} from './Column'

export class Content
{

    constructor(rows = null) {
        this.content = {
            label: "Контент",
            space: "content",
            type: 'content',
            className: '',
            swiper:{

            },
            settings: Content.getSettings(),
            content: rows
        }
    }
    className(str){
        this.content.className = str
        return this
    }
    setting(name,value)
    {
        this.content.settings[name] = value
        return this
    }

    settings(name,value = null)
    {
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

    getContent()
    {
        return this.content;
    }

    swiper() // разработать swiper
    {

    }
    static getSettings() {
        return {
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

        }
    }
}

// Content
export function content(...row){
    return new Content(row).getContent()
}

export function make(...row){
    return new Content(row)
}
// END Content

// Rows
// END Rows
export function rows(...row ){
    return new Content(row)
}
// Row

// END Row
export function row(...cols ){
    return new Column(cols)
}

// Column
export function col(...col ){
    return new Column(col)
}
// END Column
console.log(

    make().className('temp')

)
