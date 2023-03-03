<template>
  <div id="main" class="px-0 pt-4 mx-auto page-container">
    <!-- Products display -->
    <v-container id="main" class="mt-0 pt-0 px-0 mx-auto" v-if="products.length">
      <v-layout class="mt-0">
        <v-app-bar class="elevation-0" theme="dark">
          <template v-slot:prepend>
            <v-app-bar-title class="text-high-emphasis">
              See what's just dropped
            </v-app-bar-title>
          </template>
          <template v-slot:append>
            <v-card-actions>
              <RouterLink class="text-decoration-none text-white" :to="{ name: 'FeaturedProducts' }">
              <v-btn variant="outlined" size="small">Go to trending products</v-btn>
              </RouterLink>
            </v-card-actions>
          </template>
        </v-app-bar>
        <v-main>
          <v-parallax
            src="https://images.unsplash.com/photo-1536243298747-ea8874136d64?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
            height="295px" cover aspect-ratio="16/9" class="my-7">
            <div class="d-flex fill-height justify-center align-center text-white">
              <div class="text-h4">Just arrived.</div>
            </div>
          </v-parallax>
          <div class="mx-auto" v-if="products.length">
            <v-item-group multiple>
              <v-row>
                <v-col v-for="product in products" :key="product.id" cols="12" md="2">
                  <v-card class="mx-auto rounded-0" max-width="200" variant="none">
                    <router-link :to="{ name: 'Product', params: { id: product.id } }">
                      <v-img class="product-img-scale" :src="product.image" height="270px" cover aspect-ratio="1/1"></v-img>
                    </router-link>
                    <v-card-title class="text-subtitle-2 font-weight-bold pa-0">
                      {{ product.title }}
                    </v-card-title>
                    <v-card-subtitle class="pa-0">
                      {{ product.category }}
                    </v-card-subtitle>
                    <v-card-actions class="pa-0 ma-0" style="min-height: 28px !important; height: 28px !important;">
                      <v-card-text class="pa-0 text-subtitle-1 font-italic">
                        R{{ product.price }}
                      </v-card-text>
                      <v-spacer></v-spacer>
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
    <div v-else>
      No products found.
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

};
</script>

<style scoped>
.page-container {
  min-height: 70vh;
}
</style>