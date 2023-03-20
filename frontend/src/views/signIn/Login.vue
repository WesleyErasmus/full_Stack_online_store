<template>
  <!-- Login page -->
  <div class="container mx-auto page-container">
    <v-layout class="mt-3 form-container mx-auto">
      <v-app-bar class="text-center rounded-t-xl" color="primary">
        <v-app-bar-title class="text-high-emphasis">
          <div class="text-white">
            Login
          </div>
        </v-app-bar-title>
      </v-app-bar>
      <v-main class="mb-10">
        <v-card class=" pa-5 rounded-b-xl rounded-t-0" variant="tonal">
          <!-- LOGIN FORM -->
          <v-form 
          v-model="valid" 
          @submit.prevent="customerLogin" 
          class=" pa-4">
            <div class="form-floating mb-3">
              <!-- Email input -->
              <label>Email</label>
              <v-text-field 
              type="email" 
              name="email" 
              v-model="email" 
              class="form-control"
              placeholder="Enter your email address" 
              required 
              :rules="emailRules"
              />
              
            </div>
            <!-- Password input -->
            <div class="form-floating mb-3">
              <label>Password</label>
              <v-text-field 
              type="password" 
              v-model="password" 
              class="form-control"
              placeholder="Enter your password"
              required
              counter
              :rules="passwordRules"
              />
              
            </div>
            <!-- Login button -->
            <v-btn 
            color="primary" 
            class="w-100 btn btn-lg login-btn btn-warning" 
            type="submit"
            :disabled="!valid"
            >
              Login
            </v-btn>
            <hr class="my-4" />
          </v-form>
        </v-card>
      </v-main>
    </v-layout>
  </div>
</template>
<script>
import api from "@/services/api.js";
import Toasts from "@/components/Toasts.vue";
import { useCookies } from "vue3-cookies";
import router from "/src/router";
export default {
  components: { Toasts },
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  data() {
    return {
      fullName: "",
      email: "",
      password: "",
      customer_id: this.cookies.get("customer_id"),
      // Login Form Validation
      valid: false,
       emailRules: [
        value => {
          if (value) return true

          return 'E-mail is requred.'
        },
        value => {
          if (/.+@.+\..+/.test(value)) return true

          return 'E-mail must be valid.'
        },
      ],
      passwordRules: [
        value => {
          if (value) return true

          return 'Password is required.'
        },
        value => {
          if (value?.length >= 8) return true

          return 'Password must be longer than 8 characters.'
        },
      ],
    };
  },
  mounted() {
    let customerId = this.cookies.get("customer_id");
    const customer_id = parseInt(customerId);
    if (customer_id) {
      // Check if the customer is logged in
      router.push({ name: 'Home' });
      // Redirect the customer to the Home page
    }
  },
  methods: {
    // Customer login function
    customerLogin() {
      api
        .post(
          "/controllers/CustomerController.php?action=customerLogin",
          {
            email: this.email,
            password: this.password,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((response) => {
          console.log(response);
          if (response.data.success) {

            // Save the customer_id cookie received from backend
            this.cookies.set("customer_id", response.data.customer_id);

            // Route user to home page and then refresh page to change login btn to logout
            this.$router.push({ name: 'Home' }).then(() => {
              window.location.reload();
            });

          } else {

            var x = document.getElementById("snackbar6");
            x.className = "show";
            setTimeout(function () {
              x.className = x.className.replace("show", "");
            }, 2000);

            console.log("Error logging customer in");
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
<style scoped>
.page-container {
    min-height: 70vh;
}
.form-container {
    width: 550px;
}
@media screen and (max-width: 530px) {
.form-container {
    width: 100vw;
}

}
</style>