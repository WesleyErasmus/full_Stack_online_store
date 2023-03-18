<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template><!-- Sticky navbar -->
<v-app>
  <!-- TOP NAVBAR -->
  <TopNavbar />

  <!-- Back to top button -->
  <BackToTop/>

  <RouterView />

  <!-- FOOTER -->
  <Footer />
  </v-app>
</template>

<script>
import Footer from "../src/components/Footer.vue";
import TopNavbar from "../src/components/TopNavbar.vue";
import BackToTop from "../src/components/BackToTop.vue";
export default {
  components: { Footer, TopNavbar, BackToTop },
};
</script>
