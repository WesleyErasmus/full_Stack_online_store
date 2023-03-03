<template>
    <!-- Sign-up page -->
    <div class="page-container mx-auto">
        <v-layout class="mt-3 form-container mx-auto">
            <v-app-bar class="text-center rounded-t-xl" color="secondary">
                <!-- Page heading -->
                <v-app-bar-title class="text-high-emphasis">
                    <div class="text-white">
                        Sign-Up
                    </div>
                </v-app-bar-title>
            </v-app-bar>
            <v-main class="mb-10">
                <!-- Sign up form -->
                <v-card class="pa-5 rounded-b-xl rounded-t-0" width="550px" variant="tonal">
                    <v-form @submit.prevent="customerSignUp" class="sign-up-form row p-4 p-md-5 bg-light needs-validation"
                        novalidate>
                        <!-- Full name input -->
                        <div>
                            <v-text-field v-model="fullName" type="text" name="fullname" class="form-control"
                                id="validationCustom02" placeholder="Enter your full name" />
                            <label for="validationCustom02">Full Name</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-floating ps-1 mb-3 col-md-6">
                            <v-text-field v-model="email" type="email" name="email" class="form-control"
                                id="validationCustom04" placeholder="Enter your email" />
                            <label for="validationCustom04">Email</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-floating ps-1 mb-3 col-md-6">
                            <v-text-field v-model="password" type="password" name="password" class="form-control"
                                id="validationCustom03" placeholder="Enter your password" />
                            <label for="validationCustom03">Password</label>
                        </div>
                        <!-- Sign-up button -->
                        <v-btn variant="elevated" color="secondary" class="w-100 btn btn-lg btn-secondary login-btn"
                            type="submit">Sign-up</v-btn>
                    </v-form>
                </v-card>
            </v-main>
        </v-layout>
        <Toasts />
    </div>
</template>
<script>
import api from "@/services/api.js";
import Toasts from "@/components/Toasts.vue";
import router from "/src/router";
import { useCookies } from "vue3-cookies";
export default {
    components: { Toasts },
    // Using cookies to store customer id
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
            fullName: "",
            email: "",
            password: "",
            customer_id: this.cookies.get("customer_id")
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
        // Customer sign-up method
        customerSignUp() {
            api.post("/controllers/CustomerController.php?action=customerSignUp", JSON.stringify({
                // Data properties that get requested by the backend CustomerController.php controller
                fullName: this.fullName,
                email: this.email,
                password: this.password
            }), {
                headers: {
                    "Content-Type": "application/json"
                },
            })
                .then(response => {
                    console.log(response);

                    if (response.data) {
                        // Sign-up successful message
                        var x = document.getElementById("snackbar5");
                        x.className = "show";
                        setTimeout(function () {
                            router.push({ name: 'Login' });
                            x.className = x.className.replace("show", "");
                        }, 2000);

                    }
                })
                .catch(error => {
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
</style>