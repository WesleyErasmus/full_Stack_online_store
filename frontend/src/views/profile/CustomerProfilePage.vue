<template>
    <div id="main">
        <h1>Customer Profile details</h1>
        <div v-if="profileData">
        <div v-for="data in profileData" :key="data.id">

            <ul>
                <li>{{ data.full_name }}</li>
                <li>{{ data.email }}</li>
                <button>Change Password</button>
            </ul>
        </div>
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
            profileData: null,
        };
    },

    mounted() {
        // User id cookie
        let customerId = this.cookies.get("customer_id");
        const customer_id = parseInt(customerId);

        // Display cart items for a customer. Customerid parameter displaying only cart items with the customers id
        api.get(`/controllers/CustomerController.php?action=getProfile&customerId=${customerId}`, { responseType: 'json' })
            .then((response) => {
                this.profileData = response.data;

                console.warn(response);
                // console.log(this.shoppingCart)
                console.log("customer_id:", customer_id, typeof customer_id);
            });
    },
}
</script>

<style></style>