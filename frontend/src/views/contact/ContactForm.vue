<template>
  <!-- Contact page message form -->
  <div id="main" class="mt-6">
    <!-- Page heading -->
    <v-parallax
      src="https://images.unsplash.com/photo-1508427953056-b00b8d78ebf5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
      height="175px">
      <div class="d-flex flex-column flex-wrap fill-height justify-center align-center text-white">
        <div class="text-h3 mb-4">
          CONTACT US
        </div>
      </div>
    </v-parallax>
    <!-- Page subheading -->
    <v-container class="bg-black my-3 text-center">
      <div class="text-h5 font-weight-bold">
        How can we help you?
      </div>
    </v-container>
    <!-- Chip group and Card Safety container -->
    <v-card class="d-flex justify-center flex-wrap pa-10 my-5" variant="outlined" color="grey-lighten-2">
      <!-- FAQS -->
      <v-card class="ma-3 rounded-b-xl rounded-t-xl" max-width="480px" width="100%" variant="none">
        <v-row justify="center">
          <v-col cols="12">
            <v-sheet elevation="0" rounded="xl">
              <v-sheet class="pa-3 text-center text-grey-darken-2" rounded="t-xl">
                <div class="text-h5 font-weight-bold">Frequently asked questions</div>
              </v-sheet>
              <!-- CHIPS -->
              <div class="pa-7 pt-5">
                <v-chip-group selected-class="text-info" column>
                  <v-chip class="" size="x-large" variant="elevated" v-for="tag in tags" :key="tag">
                    {{ tag }}
                  </v-chip>
                </v-chip-group>
              </div>
            </v-sheet>
          </v-col>
        </v-row>
      </v-card>
      <!-- Card Safety -->
      <v-card class="ma-3 rounded-b-xl rounded-t-xl" max-width="480px" width="100%" variant="elevated">
        <v-row justify="center">
          <v-col cols="12">
            <v-sheet elevation="0" rounded="xl">
              <div class="pa-6">
                <v-card-title class="text-h6 font-weight-bold">Payment security</v-card-title>
                <div class="pl-3">
                  <span>Keep your credit card information safe: Never share your credit card information with anyone who
                    doesn't have a legitimate reason to know it. Don't give out your credit card number over the phone,
                    email, or text message unless you initiated the contact and you trust the recipient.</span>
                  <img src="../../assets/credit-card.png" class="credit-card-icon float-end" alt="Credit-card-icon">
                </div>
              </div>
            </v-sheet>
          </v-col>
        </v-row>
      </v-card>
    </v-card>

    <!-- Message form heading | Get in touch -->
    <v-container class="my-5 text-center">
      <div class="text-h5 font-weight-bold">
        Want to get in touch?
      </div>
    </v-container>
    <!-- Contact form -->
    <v-layout class="mt-3 form-container mx-auto">
      <v-app-bar class="text-center rounded-t-xl" color="black">
        <v-app-bar-title class="text-high-emphasis">
          <div class="text-white">
            Send us a message
          </div>
        </v-app-bar-title>
      </v-app-bar>
      <v-main class="mb-10">
        <v-card color="grey-lighten-2" class="px-4 rounded-b-xl" variant="outlined">
          <!-- Contact form section -->
          <v-form @submit.prevent="saveCustomerMessage">
            <!-- Message input field -->
            <v-textarea variant="filled" class="text-black mx-15 mt-10" v-model="message" label="Message"
              bg-color="grey-lighten-5" rows="2" row-height="15" auto-grow>
            </v-textarea>
            <!-- Form submit btn -->
            <v-card-actions>
              <v-btn color="info" size="large" type="submit" :loading="isLoading" class="mt-1" block>
                Send Message
                <v-icon end icon="mdi-send"></v-icon>
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
        <div class="sm-links pt-10 text-center">
          <a href="https://www.facebook.com/" target="_blank" alt="Facebook"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.twitter.com/" target="_blank" alt="Twitter"><i class="fa-brands fa-twitter"></i></a>
          <a href="https://www.instagram.com/" target="_blank" alt="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://www.linkedin.com/" target="_blank" alt="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
          <a href="https://www.tiktok.com/" target="_blank" alt="TikTok"><i class="fa-brands fa-tiktok"></i></a>
          <a href="https://www.youtube.com/" target="_blank" alt="YouTube"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </v-main>
    </v-layout>

    <Toasts />
    <hr>
  </div>
</template>

<script>
import api from "@/services/api.js";
import Toasts from "/src/components/Toasts.vue";
import { useCookies } from "vue3-cookies";
import router from "/src/router";
export default {
  // Toast messages
  components: { Toasts },
  name: "Contact",
  // Using cookies for customer id
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  data: () => ({
    message: '',
    customerData: [],
    tags: [
      'Courier Costs',
      'Returns Policy',
      'Collections',
      'Gift Vouchers',
      'Customer Service',
      'Missing Packages',
      'Queries',
    ],
  }),
  methods: {
    // Message sent toast
    successMessage() {
      var x = document.getElementById("snackbar2");
      x.className = "show";
      setTimeout(function () {
        // Refreshes page after item is removed from cart
        window.location.reload();
        x.className = x.className.replace("show", "");
      }, 4000);
    },
    // Save message to database function
    saveCustomerMessage() {
      console.log('saveCustomerMessage Message');
      // Getting customer id cookie on page/DOM mount
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
    },
    // Fetch customer id function being called in my methods and lifecycle hook
    fetchCustomerData() {
      let customerId = this.cookies.get("customer_id");
      const customer_id = parseInt(customerId);
      api.get(`/controllers/CustomerController.php?customerId=${customerId}`, { responseType: 'json' })
        .then((response) => {
          this.customerData = response.data;
          console.warn(response);
          console.log("customer_id:", customer_id, typeof customer_id);
        });
    },
  },
  mounted() {
    // Fetch customer data on component mount
    this.fetchCustomerData();

    let customerId = this.cookies.get("customer_id");
    const customer_id = parseInt(customerId);
  },

};
</script>

<style scoped>
.form-container {
  max-width: 700px;
}

.credit-card-icon {
  width: 135px;

}
/* Social media links */
.sm-links a {
  padding: 10px;
  color: #000;
}

/* Social media header icons styling */
.fa-brands {
  font-size: calc(10px + 0.4rem);
  -webkit-transition: 0.1s ease-out;
  transition: 0.1s ease-out;
}

.fa-brands:hover {
  transform: scale(1.4);
  background: none;
}
</style>