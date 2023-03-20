<template>
  <!-- Featured products container -->
  <v-layout class="mt-10">
    <v-app-bar class="elevation-0" theme="light">
      <template v-slot:prepend>
        <v-app-bar-title class="text-high-emphasis">
          <RouterLink class="nav-link-item text-decoration-none" :to="{ name: 'NewProducts' }">
          See what's just dropped
          <v-icon class="title-icon" color="primary">mdi-chevron-right</v-icon>
          </RouterLink>
        </v-app-bar-title>
      </template>
      <template v-slot:append>
        <v-card-actions class="title-button">
          <RouterLink class="nav-link-item text-decoration-none" :to="{ name: 'NewProducts' }">
            <v-btn variant="outlined" color="primary" size="small">shop our latest fashion</v-btn>
          </RouterLink>
        </v-card-actions>
      </template>
    </v-app-bar>
    <v-main>
      <div class="mx-auto" v-if="newProducts.length">
        <v-item-group multiple>
          <v-row>
            <!-- .v-col-sm-6 md-5 .offset-md-2 .v-col-lg-6 .offset-lg-0 -->
            <v-col v-for="product in newProducts" :key="product.id" cols="12" sm="4" md="2" lg="2">
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
      </div>
    </v-main>
  </v-layout>
</template>
<!-- <small class="text-muted">#JustDropped</small> -->
<script>
import api from "@/services/api.js";
export default {
  data() {
    return {
      products: [],
      newProducts: [],
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

    // event listener for escape key press
    document.addEventListener("keydown", this.clearSearchOnEscape);
  },
   // Only displays products that are new
  computed: {
    newProducts() {
      return this.products.filter(product => product.new === "1").slice(0, 6);;
    }
  },
}
</script>

<style scoped>

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
