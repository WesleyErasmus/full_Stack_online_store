<template>
  <!-- Contact page wrapper -->
  <div id="main" class="mx-auto">

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
    };
  },
};
</script>

<style scoped>
</style>
