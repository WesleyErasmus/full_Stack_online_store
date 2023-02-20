// Bootstrap import
import "bootstrap/dist/css/bootstrap.css";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";


import "./assets/main.css";

const app = createApp(App);

app.use(router);

app.mount("#app");
// Bootstrap popper.js
import 'bootstrap/dist/js/bootstrap.js'
import { popper } from "@popperjs/core";
