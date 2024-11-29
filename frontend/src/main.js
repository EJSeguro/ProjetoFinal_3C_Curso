import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faPhone, faMagnifyingGlass, faClipboard, faHouse, faUser, faCloudArrowUp, faPlus, faSquareCaretDown, faCircleChevronDown, faUserPen, faArrowDown, faTrashCan, faChevronRight, faFilter, faTrash, faEdit, faTimes} from "@fortawesome/free-solid-svg-icons";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
    faUser, 
    faPhone, 
    faMagnifyingGlass,
    faHouse,
    faClipboard,
    faCloudArrowUp,
    faPenToSquare,
    faPlus,
    faUserPen,
    faSquareCaretDown,
    faCircleChevronDown,
    faSearch,
    faArrowDown,
    faTrashCan,
    faChevronRight,  
    faEdit, 
    faTrash,
    faTimes,
    faFilter,
);
import "./assets/main.css";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { vMaska } from "maska/vue";

import App from "./App.vue";
import router from "./router";

const app = createApp(App);
app.directive("maska", vMaska);
app.component("font-awesome-icon", FontAwesomeIcon);

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia);
app.use(router);

app.mount("#app");
