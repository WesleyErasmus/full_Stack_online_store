// Bootstrap import
import "bootstrap/dist/css/bootstrap.css";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Vuex state management
import { createStore } from "vuex";

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

// Install the store instance as a plugin
app.use(store);

app.mount("#app");
// Bootstrap popper.js
import 'bootstrap/dist/js/bootstrap.js'
import { popper } from "@popperjs/core";
