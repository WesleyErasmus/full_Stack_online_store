<template>
  <!-- Featured products container -->
  
  <v-container class="">
    <!-- Featured and New Page links -->
    <div class="page-links">
      <!-- New products page link -->
      <RouterLink class="text-decoration-none" :to="{ name: 'NewProducts' }">
        <div class="new-products-link">NEW PRODUCTS</div>
      </RouterLink>
      <!-- Featured products page link -->
      <RouterLink class="text-decoration-none" :to="{ name: 'FeaturedProducts' }">
        <div class="feature-products-link">FEATURED PRODUCTS</div>
      </RouterLink>
    </div>
    <h1>Trending Collection</h1>
   
    <v-card class="mx-auto" variant="none">
       <!-- See all link that routes to featured products page -->
      <span>
        <RouterLink :to="{ name: 'FeaturedProducts' }" class="see-all">
          see all</RouterLink>
      </span>
      <v-container class="pa-1">
        <v-item-group multiple>
          <v-row>
            <v-col v-for="featured in products" :key="featured.id" cols="12" md="2">
              <router-link :to="{ name: 'Product', params: { id: featured.id } }">
                <v-img :src="
                  'https://source.unsplash.com/random/?fashion/id' + featured.id" cover height="220"
                     aspect-ratio="4/3"
                  class="text-right pa-2" @click="toggle">
                </v-img>
              </router-link>
              <small class="text-muted">#Featured</small>
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
};
</script>

<style scoped>
/* See all button */
.see-all {
  color: var(--primary-color) !important;
}

/* Top banner links container */
.page-links {
  height: 50px;
  background: #000;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  margin: 2.5rem 0;
}

/* Links in block below app header */
.new-products-link,
.feature-products-link {
  color: #bbb;
}

.new-products-link:hover,
.feature-products-link:hover {
  color: #fff;
  cursor: pointer;
}
</style>