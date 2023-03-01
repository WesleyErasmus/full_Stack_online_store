<template>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <form @submit.prevent="customerSignUp" class="sign-up-form row p-4 p-md-5 rounded-3 bg-light needs-validation"
                novalidate>
                <div class="form-floating ps-1 mb-3 col-12">

                    <input v-model="fullName" type="text" name="fullname" class="form-control" id="validationCustom02"
                        placeholder="Enter your full name">
                    <label for="validationCustom02">Full Name</label>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-6">

                    <input v-model="email" type="email" name="email" class="form-control" id="validationCustom04"
                        placeholder="Enter your email">
                    <label for="validationCustom04">Email</label>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-6">

                    <input v-model="password" type="password" name="password" class="form-control" id="validationCustom03"
                        placeholder="Enter your password">
                    <label for="validationCustom03">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-secondary login-btn" type="submit">Sign-up</button>
                <hr class="my-4">
            </form>
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
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    mounted() {
        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);
        // if (customer_id) { 
        //     // Check if the customer is logged in
        //     router.push({ name: 'Home' }); 
        //     // Redirect the customer to the Home page
        // }
    },
    data() {
        return {
            fullName: "",
            email: "",
            password: "",
        };
    },
    methods: {
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