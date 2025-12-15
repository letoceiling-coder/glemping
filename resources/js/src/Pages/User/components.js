import Components from '/resources/js/src/Views/components'

import Personal from '/resources/js/src/Pages/User/Personal/index.vue'

import Favourites from '/resources/js/src/Views/components/favourites.vue';
import Btn from '/resources/js/src/Views/components/Btn/Btn.vue';


export default Object.assign({
    personal: Personal,
    Favourites:Favourites,
    Btn:Btn,
}, new Components().importComponents())
