<template>
  <!-- Page wrapper -->
  <v-layout class="home-page">
    
    <!-- Page Hero -->
    <Hero />

    <div id="main" class="mx-auto">

      <!-- New Products -->
      <NewProductsSample />

      <!-- Home Page Blogs -->
      <HomePageBlogs />

      <!-- Featured Products -->
      <TrendingSample />

      <!-- Categories -->
      <Categories />

    </div>

  </v-layout>
  <!-- End of Home Page Wrapper -->
</template>

<script>
// Component imports
import Hero from './Hero.vue'
import TrendingSample from './TrendingSample.vue'
import NewProductsSample from './NewProductsSample.vue'
import HomePageBlogs from './HomePageBlogs.vue'
import Categories from './Categories.vue'

import axios from "axios";
export default {
  components: { Hero, TrendingSample, NewProductsSample, HomePageBlogs, Categories },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    axios
      .get("https://api.escuelajs.co/api/v1/products?offset=0&limit=5")
      .then((response) => {
        this.products = response.data;
        console.warn(response);
      });
  },
};
</script>

<style scoped>
.home-page {
  display: block;
  margin: 0 auto;
}
</style>