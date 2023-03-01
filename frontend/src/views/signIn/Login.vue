<template>
    <div class="container mx-auto">
        <v-card 
        width="500px"
        class="mt-5 pa-5" 
        variant="tonal"
        >
            <!-- LOGIN FORM -->
             <v-form
            @submit.prevent="customerLogin"
            class=" pa-4"
          >
            <div class="form-floating mb-3">
              <v-text-field
                type="email"
                name="email"
                v-model="email"
                class="form-control"
                id="validationCustom01"
                placeholder="Enter your email address"
                required
              />
              <label for="validationCustom01">Email</label>
            </div>
            <div class="form-floating mb-3">
              <v-text-field
                type="password"
                v-model="password"
                class="form-control"
                id="validationCustom02"
                placeholder="Enter your password"
                required
              />
              <label for="validationCustom02">Password</label>
            </div>
            <v-btn
            color="secondary"
              class="w-100 btn btn-lg login-btn btn-warning"
              type="submit"
            >
              Login
            </v-btn>
            <hr class="my-4" />
          </v-form>
        </v-card>
    </div>
</template>
<script>
import api from "@/services/api.js";
import Toasts from "@/components/Toasts.vue";
import { mapMutations } from 'vuex';
import { useCookies } from "vue3-cookies";
export default {
    components: { Toasts },
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
            loggedIn: null,
            fullName: "",
            email: "",
            password: "",
            customerId: null
        };
    },
    computed: {
        isLoggedIn() {
            return this.loggedIn;
        },
    },
    methods: {
     ...mapMutations(["customerLogin"]),
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

                        // commit the customerLogin mutation
                        this.$store.commit("customerLogin");
                        
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
    mounted() {
        if (localStorage.getItem("isLoggedIn")) {
            try {
                this.loggedIn = localStorage.getItem("isLoggedIn");
            } catch (e) {
                localStorage.removeItem("isLoggedIn");
            }
        }
    },
};
</script>