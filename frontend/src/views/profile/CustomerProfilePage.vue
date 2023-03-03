<template>
    <!-- class="pa-0" -->
    <v-container class="page-container">
        <v-img id="main" class="mx-auto" height="100%" cover aspect-ratio="16/9"
            src="https://images.unsplash.com/photo-1557207201-0a45788f977b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80">
            <div class="d-flex fill-height justify-center align-start">
                <v-container fluid class="d-flex justify-center">
                    <v-card min-width="480px" class="pa-0 ma-5" variant="elevated">
                        <v-toolbar density="compact" color="black" class="text-center py-3">
                            <v-toolbar-title class="text-h5">Your Account</v-toolbar-title>
                        </v-toolbar>
                        <v-container class="ml-4">
                            <div class="d-flex">
                                <v-icon size="42" color="grey" class="mr-3">mdi-account</v-icon>
                                <!-- User name & email -->
                                <div class="ml-1">
                                    <div class="text-h6">
                                        {{ customerData.full_name }}
                                    </div>
                                    <div class="text-medium-emphasis">
                                        {{ customerData.email }}
                                    </div>
                                </div>
                            </div>
                        </v-container>
                        <v-form class="px-10 pb-3" @submit.prevent="updateCustomerProfile">
                            <div>
                                <label for="name">Edit Name:</label>
                                <v-text-field id="name" v-model="customerData.full_name" type="text" />
                            </div>
                            <div>
                                <label for="email">Edit Email:</label>
                                <v-text-field id="email" v-model="customerData.email" type="email" />
                            </div>
                            <v-expand-transition>
                                <div v-show="show">
                                    <div>
                                        <label for="password">Edit Password:</label>
                                        <v-text-field id="password" v-model="customerData.password" type="password" />
                                    </div>
                                    <div>
                                        <label for="confirm-password">Confirm Password:</label>
                                        <v-text-field id="confirm-password" v-model="confirmPassword" type="password" />
                                    </div>
                                </div>
                            </v-expand-transition>
                            <v-card-actions>

                                <v-btn size="small" class="pl-0 ml-0" color="primary"
                                    :icon="show ? 'mdi-chevron-up-circle' : 'mdi-chevron-down-circle'"
                                    @click="show = !show"></v-btn>
                                <span class="text-caption text-grey">Update password</span>
                                <v-spacer></v-spacer>
                                <v-btn size="small" variant="outlined" color="primary" type="submit">Update Account</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-container>
            </div>
        </v-img>
    </v-container>
</template>

<script>
import api from "@/services/api.js";
import { useCookies } from "vue3-cookies";
import Spinner from "/src/components/Spinner.vue";
import router from "/src/router";
export default {
    components: { Spinner },
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
            show: false,
            // Customer data that gets displayed in the input fields
            customerData: {
                full_name: "",
                email: "",
                password: "",
            },
            confirmPassword: "",
        };
    },
    methods: {
        updateCustomerProfile() {
            let customerId = this.cookies.get("customer_id");
            const customer_id = parseInt(customerId);
            const fullName = this.customerData.full_name;
            const email = this.customerData.email;
            const password = this.customerData.password;

            // Update customerData object with new data from inputs
            this.customerData.full_name = fullName;
            this.customerData.email = email;
            this.customerData.password = password;

            // Check if password and confirm password match before continuing with the function code
            if (password !== this.confirmPassword) {
                alert("Passwords do not match!");
                return;
            }

            api.post(`/controllers/CustomerController.php?action=updateCustomerProfile&customerId=${customer_id}`, {
                full_name: fullName,
                email: email,
                password: password
            }, {
                headers: {
                    "Content-Type": "application/json"
                },
            })
                .then(response => {
                    console.log(response.data);
                    // Refresh customer data after updating
                    this.fetchCustomerData();
                    // Add a toast for fail or success
                    this.customerData.full_name = fullName;
                    console.log("Updated full name:", this.customerData.full_name);

                    this.customerData.email = email;
                    console.log("Updated email:", this.customerData.email);

                    this.customerData.password = password;
                    console.log("Updated password:", this.customerData.password);

                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchCustomerData() {
            let customerId = this.cookies.get("customer_id");
            const customer_id = parseInt(customerId);
            api.get(`/controllers/CustomerController.php?customerId=${customerId}`, { responseType: 'json' })
                .then((response) => {
                    this.customerData = response.data;
                    console.warn(response);
                    console.log("customer_id:", customer_id, typeof customer_id);
                    this.customerData.password = "";
                });
        },
    },
    mounted() {
        // Fetch customer data on component mount
        this.fetchCustomerData();

        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);
        if (!customer_id) {
            // Check if the customer is logged in
            router.push({ name: 'AccessDenied' });
            // Redirect the customer to the Home page
        }
    },
}
</script>
<style scoped>
.page-container {
  min-height: 70vh;
}
</style>