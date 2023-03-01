<template>
    <!-- Contact page message-us form -->
    <div id="main" class="message-container">
        <v-form @submit.prevent="saveCustomerMessage" class="mb-5">
            <v-text-field v-model="message" :rules="rules" label="Message"></v-text-field>
            <v-btn variant="tonal" color="primary" type="submit" block class="mt-2">Submit</v-btn>
        </v-form>
        <Toasts />
    </div>
</template>

<script>
import api from "@/services/api.js";
import Toasts from "/src/components/Toasts.vue";
import { useCookies } from "vue3-cookies";
export default {
    components: { Toasts },
    name: "Contact",
    setup() {
        const { cookies } = useCookies();
        return { cookies };
    },
  data: () => ({
        message: '',
        rules: [
            value => {
                if (value) return true;

                return 'You must enter a message.';
            },
        ],
    }),
    methods: {
        successMessage() {
            var x = document.getElementById("snackbar2");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 5000);
        },

      saveCustomerMessage() {
            console.log('saveCustomerMessage Message');

            let customerId = this.cookies.get("customer_id");
             console.log('Data sent:', { customerId, message: this.message });

            api.post(
                `/controllers/CustomerController.php?action=saveMessage&customerId=${customerId}`,
                {
                    message: this.message,
                },
                {
                    headers: {
                        "Content-Type": "application/json"
                    },
                }
            )
                .then(response => {
                    console.log(response);

                    if (response.data && this.message !== "") {
                        this.successMessage();

                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },

};
</script>

<style scoped></style>
