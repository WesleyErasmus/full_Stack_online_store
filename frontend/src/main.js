import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Vuetify
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: "mdi", // This is already the default value - only for display purposes
  },
});


import "./assets/main.css";

const app = createApp(App);

app.use(router);

app.use(vuetify);

app.mount("#app");