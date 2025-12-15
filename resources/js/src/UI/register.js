import NotyError from '/resources/js/src/UI/error.vue'

import MCInput from '/resources/js/src/UI/Input/input.vue'
import MCInputCheck from '/resources/js/src/UI/Input/checkbox.vue'
import MCInputIcon from '/resources/js/src/UI/Input/input-icon.vue'
import MCOnOff from '/resources/js/src/UI/Input/input-on-off.vue'
import MCPhone from '/resources/js/src/UI/Input/phone.vue'
import MCDataPicker from '/resources/js/src/UI/Input/data-picker.vue'
import MCDataPickerRange from '/resources/js/src/UI/Input/data-picker-range.vue'

import MCColorPicker from '/resources/js/src/UI/Input/color-picker.vue'

import Vue3IconPicker from '/resources/js/src/UI/FontsIcon/Vue3IconPicker.vue'


import MCOption from '/resources/js/src/UI/Select/option.vue'
import MCSelect from '/resources/js/src/UI/Select/select.vue'
import MCSelectOne from '/resources/js/src/UI/Select/select-one.vue'
import MCSelectToo from '/resources/js/src/UI/Select/select-too.vue'

import MCTextarea from '/resources/js/src/UI/Input/textarea.vue'

import MCHtml from '/resources/js/src/UI/Html/html.vue'

import DropZone from '/resources/js/src/UI/DropZone/index.vue'
import Picture from '/resources/js/src/UI/Image/picture.vue'


import BtnImage from '/resources/js/src/UI/Btn/btn-image.vue'
import BtnVideo from '/resources/js/src/UI/Btn/btn-video.vue'

import Folders from '/resources/js/src/UI/Media/components/folders.vue'
import Files from '/resources/js/src/UI/Media/components/files.vue'
import Crop from '/resources/js/src/UI/Media/components/crop.vue'
import Upload from '/resources/js/src/UI/Media/components/upload.vue'
import Video from '/resources/js/src/UI/Media/components/video-download.vue'
import DownloadFile from '/resources/js/src/UI/Btn/download-file.vue'
import DownloadVideo from '/resources/js/src/UI/Btn/download-video.vue'
import FactoryModal from '/resources/js/src/UI/Factory/modals.vue'


import SettingsComponents from '/resources/js/src/UI/Pages/components/SettingsComponent/include'


const tags = {

}

const helperComponents = {
    'mc-error': NotyError,
    'mc-input': MCInput,
    'mc-checkbox': MCInputCheck,
    'mc-input-icon': MCInputIcon,
    'mc-on-off': MCOnOff,
    'mc-phone': MCPhone,
    'mc-data-picker-range': MCDataPickerRange,
    'mc-data-picker': MCDataPicker,

    'mc-color-picker': MCColorPicker,

    'vue-picker': Vue3IconPicker,

    'mc-textarea': MCTextarea,

    'mc-option': MCOption,
    'mc-select': MCSelect,
    'mc-select-one': MCSelectOne,
    'mc-select-too': MCSelectToo,

    'mc-btn-icon-picker': Vue3IconPicker,

    'mc-html': MCHtml,
    'DropZone': DropZone,
    'mc-picture': Picture,

    'mc-btn-image': BtnImage,
    'mc-btn-video': BtnVideo,

    'folders' : Folders,
    'files' : Files,
    'crop' : Crop,
    'upload' : Upload,
    'video-download' : Video,
    'download-file' : DownloadFile,
    'download-video' : DownloadVideo,
    'FactoryModal' : FactoryModal,
}



export default Object.assign({} ,tags,helperComponents,SettingsComponents)
