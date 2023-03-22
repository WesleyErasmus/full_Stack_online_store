<template>
  <!-- Featured products container -->
  <v-layout class="mt-3">
    <v-app-bar class="elevation-0" theme="light">
      <template v-slot:prepend>
        <!-- Component title with router link -->
        <v-app-bar-title class="text-high-emphasis">
            <RouterLink class="nav-link-item text-decoration-none" :to="{ name: 'FeaturedProducts' }">
          See what's trending
           <v-icon class="title-icon" color="primary">mdi-chevron-right</v-icon>
           </RouterLink>
        </v-app-bar-title>
      </template>
      <!-- New products page link button -->
      <template v-slot:append>
        <v-card-actions class="title-button">
          <RouterLink class="nav-link-item text-decoration-none" :to="{ name: 'FeaturedProducts' }">
          <v-btn variant="outlined" color="primary" size="small">shop our popular products</v-btn>
          </RouterLink>
        </v-card-actions>
      </template>
    </v-app-bar>

    <v-main class="mx-auto" v-if="featuredProducts.length">
      <v-item-group multiple>
        <v-row>
          <!-- V-for loop -->
          <v-col v-for="product in featuredProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
            <!-- Dynamic routing to view product in Product gallery page -->
            <v-card class="mx-auto rounded-0" max-width="200" variant="none">
              <router-link :to="{ name: 'Product', params: { id: product.id } }">
                <!-- Product image -->
                <v-img class="product-img-scale" :src="product.image" height="270px" cover aspect-ratio="1/1"></v-img>
              </router-link>
              <!-- Product title -->
              <v-card-title class="text-subtitle-2 font-weight-bold pa-0">
                {{ product.title }}
              </v-card-title>
              <!-- Product category -->
              <v-card-subtitle class="pa-0">
                {{ product.category }}
              </v-card-subtitle>
              <v-card-actions class="pa-0 ma-0" style="min-height: 28px !important; height: 28px !important;">
                <!-- Product price -->
                <v-card-text class="pa-0 text-subtitle-1 font-italic">
                  R{{ product.price }}
                </v-card-text>
                <v-spacer></v-spacer>
                <div class="my-2">
                  <!-- Dynamic routing to view product in Product gallery page -->
                  <router-link class="text-decoration-none" :to="{ name: 'Product', params: { id: product.id } }">
                    <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>
                  </router-link>
                </div>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-item-group>
    </v-main>
  </v-layout>
</template>
<script>
import api from "@/services/api.js";
export default {
  data() {
    return {
      products: [],
      // Array only containing featured products
      featuredProducts: [],
    };
  },
  mounted() {
    api
      .get("/controllers/ProductController.php?action=displayAllProducts&tableName=myTable", {
        responseType: "json",
      })
      .then((response) => {
        this.products = response.data;
      });
  },
    // Only displays products that are featured
  computed: {
    featuredProducts() {
      return this.products.filter(product => product.new === "1").slice(0, 6);;
    }
},
}
</script>

<style scoped>
/* Component link text color */
.nav-link-item {
  color: #000000DE;
}

.title-icon {
  display: none;
}

@media screen and (max-width: 530px) {
  /* Shop button in component header */
  .title-button {
    display: none;
  }

  .title-icon {
  display: block;
}
}
</style>
