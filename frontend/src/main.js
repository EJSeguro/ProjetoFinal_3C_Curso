import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faPhone, faMagnifyingGlass, faClipboard, faHouse, faUser, faCloudArrowUp,  } from "@fortawesome/free-solid-svg-icons";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(
    faSearch,   
    faUser, 
    faPhone, 
    faMagnifyingGlass,
    faHouse,
    faClipboard,
    faCloudArrowUp,
    faPenToSquare
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
