import {Content} from "/resources/js/core/Content.js";

export class Column {

    constructor(col) {
        this.col = col
        this.settings =  Content.getSettings()
    }

    get() {
        return this.col
    }

    set(value) {
        this.col = value
        return this
    }
}
