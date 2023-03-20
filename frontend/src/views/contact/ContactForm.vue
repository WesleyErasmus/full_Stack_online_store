<template>
  <!-- Contact page message form -->
  <div id="main" class="mt-6">

    <!-- Message form heading | Get in touch -->
    <v-container class="my-5 text-center">
      <div class="text-h5">
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
          <v-form 
          @submit.prevent="saveCustomerMessage"
           v-model="valid" 
           class="px-10 pb-10"
          >
            <!-- Name input -->
            <v-text-field 
            v-model="fullName" 
            variant="filled" 
            class="text-black mt-10" 
            label="Full name"
            hide-details="auto"
            required
            :rules="nameRules"
            ></v-text-field>
            <!-- Email input -->
            <v-text-field 
            v-model="email" 
            variant="filled" 
            class="text-black mt-10" 
            hide-details="auto"
            label="Email address" 
            type="email"
            required
            :rules="emailRules"
            ></v-text-field>
            <!-- Message input field -->
            <v-textarea 
            variant="filled" 
            class="text-black mt-10" 
            v-model="message" 
            label="Message"
            bg-color="grey-lighten-5" 
            rows="2" 
            row-height="15" 
            auto-grow
            required
            counter
             :rules="messageRules"
            >
            </v-textarea>
            <!-- Form submit btn -->
            <v-card-actions>
              <v-btn 
              color="primary"
              variant="elevated" 
              size="large" 
              type="submit" 
              :disabled="!valid"
              class="mt-1" 
              block>
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
    fullName: '',
    email: '',
    message: '',
    customerData: [],
    // Message Form Validation
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

        return 'E-mail is requred.'
      },
      value => {
        if (/.+@.+\..+/.test(value)) return true

        return 'E-mail must be valid.'
      },
    ],
    messageRules: [
      value => {
        if (value) return true

        return 'Message is required.'
      },
      value => {
        if (value?.length >= 10) return true

        return 'Message must be longer than 10 characters.'
      },
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
      console.log('Data sent:', { fullName: this.fullName, email: this.email, message: this.message });
      api.post(
        `/controllers/MessageController.php?action=saveMessage`,
        {
          fullName: this.fullName,
          email: this.email,
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

          if (response.data) {
            this.successMessage();

          }
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
  mounted() {
    let customerId = this.cookies.get("customer_id");
    const customer_id = parseInt(customerId);
  },

};
</script>

<style scoped>
.form-container {
  max-width: 700px;
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