<template>
  <!-- New Products display -->
  <div id="main" class="px-0 pt-4 mx-auto page-container">
    <!-- DIsplays no products message if products don't load -->
    <v-container id="main" class="mt-0 pt-0 px-0 mx-auto" v-if="newProducts.length">
      <v-layout class="mt-0">
        <v-app-bar class="elevation-0" theme="dark">
          <template v-slot:prepend>
            <!-- page heading -->
            <v-app-bar-title class="text-high-emphasis">
              See what's just dropped
            </v-app-bar-title>
          </template>
          <template v-slot:append>
            <v-card-actions>
              <!-- link to features products -->
              <RouterLink class="text-decoration-none text-white" :to="{ name: 'FeaturedProducts' }">
              <v-btn color="primary" variant="outlined" size="small">Go to trending products</v-btn>
              </RouterLink>
            </v-card-actions>
          </template>
        </v-app-bar>
        <v-main>
          <!-- Just arrived image -->
          <v-parallax
            src="https://images.unsplash.com/photo-1536243298747-ea8874136d64?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
            height="295px" cover aspect-ratio="16/9" class="my-7">
            <!-- Image content -->
            <div class="d-flex fill-height justify-center align-center text-white">
              <div class="text-h4">Just arrived.</div>
            </div>
          </v-parallax>
          <div class="mx-auto">
            <!-- Product card container -->
            <v-item-group multiple>
              <v-row>
                <!-- V-for loop -->
                <v-col v-for="product in newProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
                  <v-card class="mx-auto rounded-0" max-width="200" variant="none">
                    <!-- Product image and link to product view page -->
                    <router-link :to="{ name: 'Product', params: { id: product.id } }">
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
                      <!-- link to product view page -->
                      <div class="my-2">
                        <router-link class="text-decoration-none" :to="{ name: 'Product', params: { id: product.id } }">
                          <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>
                        </router-link>
                      </div>
                    </v-card-actions>
                  </v-card>
                  <hr>
                </v-col>
              </v-row>
            </v-item-group>
          </div>
        </v-main>
      </v-layout>
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
      newProducts: [],

    };
  },
  mounted() {
    // Display products
    api
      .get("/controllers/ProductController.php?action=displayAllProducts&tableName=myTable", {
        responseType: "json",
      })
      .then((response) => {
        this.products = response.data;
        console.log(response.data);
      });
  },
  // Only displays products that are new
  computed: {
    newProducts() {
      return this.products.filter(product => product.new == 1);
    }
  },
};
</script>

<style scoped>
.page-container {
  min-height: 70vh;
}
</style>