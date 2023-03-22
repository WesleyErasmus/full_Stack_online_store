<template>
  <div id="main" class="mx-auto page-container">
    <v-banner
      lines="two"
      theme="light"
      class="my-7"
    >
      <template v-slot:prepend>
        <v-avatar
          color="deep-purple-accent-4"
          icon="mdi-star-circle"
        ></v-avatar>
      </template>

      <v-banner-text class="text-subtitle-1 text-medium-emphasis">
        Atlas online fashion store stays ahead of the competition by being the first to acquire the latest trending fashion ensuring our customers have access to the latest and most sought-after fashion.
      </v-banner-text>
    </v-banner>
    <!-- Displays no products message if products don't load -->
    <v-container class="mt-0 px-0 pt-0 mx-auto" v-if="featuredProducts.length">
      <v-item-group multiple>
        <v-row>
          <!-- V-for loop -->
          <v-col v-for="product in featuredProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
            <v-card class="mx-auto rounded-0" max-width="200" variant="none">
              <!-- Dynamic routing to product gallery page -->
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
                  <!-- Dynamic routing to product gallery page -->
                  <router-link class="text-decoration-none" :to="{ name: 'Product', params: { id: product.id } }">
                    <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>
                  </router-link>
                </div>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-item-group>
    </v-container>
    <!-- No product found else - if no products load -->
    <div v-else>
      <Spinner />
    </div>
  </div>
</template>

<script>
import api from "@/services/api.js";
import Spinner from "/src/components/Spinner.vue";

export default {
  components: { Spinner },
  data() {
    return {
      products: [],
      // Array containing only featured products
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
        // console.log(response.data);
      });
  },
  // Only displays products that are featured
  computed: {
    featuredProducts() {
      return this.products.filter(product => product.trending == 1);
    }
  }
};
</script>

<style scoped>
/* Page container */
.page-container {
  min-height: 70vh;
}
</style>