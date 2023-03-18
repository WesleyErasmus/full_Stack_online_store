<template>
  <!-- Contact page wrapper -->
  <div id="main" class="mx-auto">

    <!-- Page heading -->
    <v-parallax
      src="https://images.unsplash.com/photo-1508427953056-b00b8d78ebf5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
      height="175px"
      class="mt-6">
      <div class="d-flex flex-column flex-wrap fill-height justify-center align-center text-white">
        <div class="text-h3 mb-4">
          CONTACT US
        </div>
      </div>
    </v-parallax>
    <!-- Page subheading -->
    <v-container class="my-3 text-center">
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
                  <v-chip class="" size="x-large" variant="outlined" v-for="tag in tags" :key="tag">
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
    <!-- Contact Form Component -->
    <ContactForm />

    <!-- Google Maps Component -->
    <GoogleMaps />

  </div>
</template>
<script>
// Components import
import ContactForm from "./ContactForm.vue"
import GoogleMaps from "./GoogleMaps.vue"
export default {
  components: { ContactForm, GoogleMaps },
  name: "Contact",
  data() {
    return {
      // Help services info
      HelpLine: "084 123 1234",
      HelpEmail: "help@atlas.co.za",
      tags: [
        'Courier Costs',
        'Returns Policy',
        'Collections',
        'Gift Vouchers',
        'Customer Service',
        'Missing Packages',
        'Queries',
      ],
    };
  },
};
</script>

<style scoped>
.credit-card-icon {
  width: 135px;

}
</style>
