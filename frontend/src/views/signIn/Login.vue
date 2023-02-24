<template>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <!-- LOGIN -->
             <form
            @submit.prevent="customerLogin"
            class="p-4 p-md-5 rounded-3 bg-light needs-validation"
          >
            <div class="form-floating mb-3">
              <input
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
              <input
                type="password"
                v-model="password"
                class="form-control"
                id="validationCustom02"
                placeholder="Enter your password"
                required
              />
              <label for="validationCustom02">Password</label>
            </div>
            <button
              class="w-100 btn btn-lg login-btn btn-warning"
              type="submit"
            >
              Login
            </button>
            <hr class="my-4" />
          </form>
        </div>
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
                    "/controllers/CustomerController.php",
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