import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faPhone, faMagnifyingGlass, faClipboard, faHouse, faUser, faCloudArrowUp, faPlus} from "@fortawesome/free-solid-svg-icons";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
faSearch,   
library.add(
    faUser, 
    faPhone, 
    faMagnifyingGlass,
    faHouse,
    faClipboard,
    faCloudArrowUp,
    faPenToSquare,
    faPlus
);

import "./assets/main.css";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { vMaska } from "maska/vue";

import App from "./App.vue";
import router from "./router";

const app = createApp(App);
app.directive("maska", vMaska);
app.component("font-awesome-icon", FontAwesomeIcon);

app.use(createPinia());
app.use(router);

app.mount("#app");
