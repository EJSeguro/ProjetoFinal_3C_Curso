import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faPhone, faMagnifyingGlass, faClipboard, faHouse, faUser, faCloudArrowUp, faPlus, faSquareCaretDown, faCircleChevronDown, faUserPen, faArrowDown, faTrashCan, faChevronRight, faFilter, faTrash, faEdit, faTimes, faE, faEye } from "@fortawesome/free-solid-svg-icons";
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
    faEye,
);
import "./assets/main.css";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import { POSITION } from "vue-toastification";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";


import { createApp } from "vue";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { vMaska } from "maska/vue";

import App from "./App.vue";
import router from "./router";

const app = createApp(App);

app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 5,
    newestOnTop: true,
    position: POSITION.BOTTOM_RIGHT,
    icon: false,
});


app.directive("maska", vMaska);
app.component("font-awesome-icon", FontAwesomeIcon);

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia);
app.use(router);

app.mount("#app");
