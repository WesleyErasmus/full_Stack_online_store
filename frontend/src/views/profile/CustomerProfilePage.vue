<template>
    <div id="main">
        <h1>My Profile</h1>
        <div v-if="customerData">
            <form @submit.prevent="updateCustomerProfile">
                <div>
                    <label for="name">Name:</label>
                    <input id="name" v-model="customerData.full_name" type="text" />
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input id="email" v-model="customerData.email" type="email" />
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input id="password" v-model="customerData.password" type="password" />
                </div>
                <button type="submit">Update Account</button>
            </form>
        </div>
        <div v-else>
            <Spinner />
        </div>
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
            customerData: {
                full_name: "",
                email: "",
                password: "",
            },
        };
    },
    methods: {
        updateCustomerProfile() {
            const customerId = this.cookies.get("customer_id");
            const fullName = this.customerData.full_name;
            const email = this.customerData.email;
            const password = this.customerData.password;

            api.post(`/controllers/CustomerController.php`, {
                action: 'updateProfile',
                customerId: customerId,
                full_name: fullName,
                email: email,
                password: password
            })
                .then(response => {
                    console.log(response.data);
                    // handle success
                })
                .catch(error => {
                    console.error(error);
                    // handle error
                });
        }
    },
    mounted() {
        // User id cookie
        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);

        // Display cart items for a customer. Customerid parameter displaying only cart items with the customers id
        api.get(`/controllers/CustomerController.php?action=getProfile&customerId=${customerId}`, { responseType: 'json' })
            .then((response) => {
                this.customerData = response.data;


                console.warn(response);
                // console.log(this.shoppingCart)
                console.log("customer_id:", customer_id, typeof customer_id);
            });
    },
}
</script>
<style scoped>
input {
    width: 250px;
}
</style>