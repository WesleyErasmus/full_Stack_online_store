<template>
    <!-- Sign-up page -->
    <div class="page-container mx-auto">
        <div class="form-container">
        <v-layout class="mt-3 mx-auto">
            <v-app-bar class="text-center rounded-t-xl" color="primary">
                <!-- Page heading -->
                <v-app-bar-title class="text-high-emphasis">
                    <div class="text-white">
                        Sign-Up
                    </div>
                </v-app-bar-title>
            </v-app-bar>
            <v-main class="mb-10">
                <!-- Sign up form -->
                <v-card 
                class="pa-5 rounded-b-xl rounded-t-0"                
                variant="tonal">
                 
                    <v-form 
                    v-model="valid" 
                    @submit.prevent="customerSignUp" 
                    class="sign-up-form row pa-4 p-md-5 bg-light needs-validation"
                    >
                        <!-- Full name input -->
                        <div>
                            <label>Full Name</label>
                            <v-text-field 
                            v-model="fullName"
                            type="text" 
                            name="fullname" 
                            class="form-control"
                            placeholder="Enter your full name"
                            required
                            :rules="nameRules"
                            />
                        </div>
                        <!-- Email input -->
                        <div class="form-floating ps-1 mb-3 col-md-6">
                            <label>Email</label>
                            <v-text-field 
                            v-model="email" 
                            type="email" 
                            name="email" 
                            class="form-control"
                            placeholder="Enter your email"
                            required
                            :rules="emailRules"
                            />
                        </div>
                        <!-- Password input -->
                        <div class="form-floating ps-1 mb-3 col-md-6">
                            <label>Password</label>
                            <v-text-field 
                            v-model="password" 
                            type="password" 
                            name="password" 
                            class="form-control"
                            counter
                            placeholder="Enter your password" 
                            required
                            :rules="passwordRules"
                            />
                        </div>
                        <!-- Sign-up button -->
                        <v-btn 
                        variant="elevated" 
                        color="primary" 
                        class="w-100 btn btn-lg btn-secondary login-btn"
                        type="submit"
                        :disabled="!valid"
                        >Sign-up</v-btn>
                    </v-form>
                    <hr class="ma-4" />
                </v-card>
            </v-main>
        </v-layout>
        </div>
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
            // Getting customer id from cookies
            customer_id: this.cookies.get("customer_id"),
            // Sign-up Form Validation
            valid: false,
            nameRules: [
                value => {
                    if (value) return true

                    return 'Name is required.'
                },
                value => {
                    if (value?.length >= 5) return true

                    return 'Name must be longer than 5 characters.'
                },
            ],
            emailRules: [
                value => {
                    if (value) return true

                    return 'E-mail is required.'
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
        // Sign-up Success Message
        signUpSuccessMessage() {
            var x = document.getElementById("snackbar5");
            x.className = "show";
            setTimeout(function () {
                router.push({ name: 'Login' });
                x.className = x.className.replace("show", "");
            }, 2000);
        },
        // Sign-up Error message
        signUpError() {
            var x = document.getElementById("snackbar8");
            x.className = "show";
            setTimeout(function () {
            x.className = x.className.replace("show", "");
            }, 4000);
        },
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
                    // console.log(response);

                    if (response.data) {
                        // Sign-up successful message
                        this.signUpSuccessMessage();

                    }
                })
                .catch(error => {
                    console.error(error);
                    this.signUpError();
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