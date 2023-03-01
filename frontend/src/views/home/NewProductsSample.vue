<template>
  <!-- Featured products container -->
  <v-container class="">
    <h1>New Collection</h1>
  
    <v-card class="mx-auto" variant="none">
      <!-- See all link that routes to featured products page -->
      <span>
        <RouterLink :to="{ name: 'FeaturedProducts' }" class="see-all">
          see all</RouterLink>
      </span>
      <v-container class="pa-1">
        <v-item-group multiple>
          <v-row>
            <v-col v-for="newin in products" :key="newin.id" cols="12" md="2">
              <router-link :to="{ name: 'Product', params: { id: newin.id } }">
                <v-img :src="
                  'https://source.unsplash.com/random/?fashion/id' + newin.id" cover height="220"
                     aspect-ratio="4/3"
                  class="text-right pa-2" @click="toggle">
                </v-img>
              </router-link>
              <small class="text-muted">#JustDropped</small>
            </v-col>
          </v-row>
        </v-item-group>
      </v-container>
    </v-card>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    axios
      .get("https://api.escuelajs.co/api/v1/products?offset=0&limit=6")
      .then((response) => {
        this.products = response.data;
        console.warn(response);
      });
  },
}
</script>

<style scoped>
.see-all {
  color: var(--primary-color) !important;
}

</style>
