<template>
  <div id="main" class="mx-auto page-container">
    <v-banner
      lines="two"
      theme="dark"
      color="deep-purple-accent-4"
      class="my-7"
    >
      <template v-slot:prepend>
        <v-avatar
          color="deep-purple-accent-4"
          icon="mdi-new-box"
        ></v-avatar>
      </template>

      <v-banner-text class="text-subtitle-1">
        Atlas online fashion store stays ahead of the competition by being the first to acquire the latest trending fashion ensuring our customers have access to the latest and most sought-after fashion.
      </v-banner-text>

      <v-banner-actions>
        <RouterLink class="text-decoration-none text-white" :to="{ name: 'Cart' }">
        <v-btn color="white" variant="outlined" size="small">View cart</v-btn>
        </RouterLink>
      </v-banner-actions>
    </v-banner>
    <!-- Products display -->
    <v-container class="mt-0 px-0 pt-0 mx-auto" v-if="featuredProducts.length">
      <v-item-group multiple>
        <v-row>
          <v-col v-for="product in featuredProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
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
          </v-col>
        </v-row>
      </v-item-group>
    </v-container>
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
        console.log(response.data);
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
.page-container {
  min-height: 70vh;
}
</style>