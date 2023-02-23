<template>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <!-- <form @submit.prevent="customerSignIn" class="sign-up-form row p-4 p-md-5 rounded-3 bg-light needs-validation"
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
            </form> -->

            <!-- LOGIN -->
            <form @submit.prevent="customerLogin" class="p-4 p-md-5 rounded-3 bg-light needs-validation">
                <div class="form-floating mb-3">
                    <input type="email" name="email" v-model="email" class="form-control" id="validationCustom01"
                        placeholder="Enter your email address" required>
                    <label for="validationCustom01">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" v-model="password" class="form-control" id="validationCustom02"
                        placeholder="Enter your password" required>
                    <label for="validationCustom02">Password</label>
                </div>
                <button class="w-100 btn btn-lg login-btn btn-warning" type="submit">Login</button>
                <hr class="my-4">
            </form>
        </div>
    </div>
</template>
<script>
import api from "@/services/api.js";

export default {
    data() {
        return {
            // User input data values binded by v-model
            fullName: "",
            email: "",
            password: "",
        };
    },
    methods: {
        customerSignIn() {
            api.post("/controllers/CustomerController.php", JSON.stringify({
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
                })
                .catch(error => {
                    console.error(error);
                });
        },

        customerLogin() {
            // Data properties that get requested by the backend CustomerController.php controller
            api.post("/controllers/CustomerController.php", {
                email: this.email,
                password: this.password,
            }, {
                headers: {
                    "Content-Type": "application/json"
                },
            })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>