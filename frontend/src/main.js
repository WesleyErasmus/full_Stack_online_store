import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Vuex state management
import { createStore } from "vuex";

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

// Create a new store instance.
const store = createStore({
  state() {
    return {
      isLoggedIn: false,
    };
  },
  mutations: {
    customerLogin(state) {
      state.isLoggedIn = true;
      localStorage.setItem("isLoggedIn", true);
    },
    customerLogout(state) {
      state.isLoggedIn = false;
      localStorage.removeItem("isLoggedIn");
    },
  },
  
});


import "./assets/main.css";

const app = createApp(App);

app.use(router);

app.use(vuetify);

// Install the store instance as a plugin
app.use(store);

app.mount("#app");