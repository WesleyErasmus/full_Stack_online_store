<template>
    <div id="main">
        <h1>My Profile</h1>
        <v-card width="500px"
        class="pa-5 ma-5"
        >
        <v-form @submit.prevent="updateCustomerProfile">
            <div>
                <label for="name">Name:</label>
                <v-text-field id="name" v-model="customerData.full_name" type="text" />
            </div>
            <div>
                <label for="email">Email:</label>
                <v-text-field id="email" v-model="customerData.email" type="email" />
            </div>
            <div>
                <label for="password">Password:</label>
                <v-text-field id="password" v-model="customerData.password" type="password" />
            </div>
            <div>
                <label for="confirm-password">Confirm Password:</label>
                <v-text-field id="confirm-password" v-model="confirmPassword" type="password" />
            </div>
            <v-btn variant="tonal" color="primary" type="submit">Update Account</v-btn>
        </v-form>
        </v-card>
    </div>
</template>

<script>
import api from "@/services/api.js";
import { useCookies } from "vue3-cookies";
import Spinner from "/src/components/Spinner.vue";
export default {
    components: { Spinner },
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
    data() {
        return {
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
    },
}
</script>
<style scoped>
input {
    width: 250px;
}
</style>