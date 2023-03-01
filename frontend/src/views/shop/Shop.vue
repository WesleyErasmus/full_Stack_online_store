<template>
  <v-container class="shop-page px-0" id="main">
    <!-- Products display -->
    <v-container v-if="products.length">
      <v-item-group multiple>
        <v-row>
          <v-col v-for="product in products" :key="product.id" class="" cols="12" md="2">
            <v-card class="mx-auto rounded-0" max-width="" variant="elevated">
              <router-link :to="{ name: 'Product', params: { id: product.id } }">
                <v-img :src="product.image" height="270px" cover aspect-ratio="1/1"></v-img>
              </router-link>

              <v-card-title>
                {{ product.title }}
              </v-card-title>

              <v-card-subtitle>
                {{ product.category }}
              </v-card-subtitle>

              <v-card-title>
                R{{ product.price }}
              </v-card-title>
            </v-card>
          </v-col>
        </v-row>
      </v-item-group>
    </v-container>
    <!-- V-else message -->
    <div v-else>
      <Spinner />
      No products found.
    </div>
  </v-container>
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
    // API request parameters are being used to invoke a selectAll function in the backend which retrieves the product data from the database. The backend checks if the 'action' and 'tableName' parameters are set by means of a $_GET request. If both conditions (action, and tableName) are set, then the data is retrieved. 
    api
      .get("/controllers/ProductController.php?action=displayAllProducts&tableName=myTable", {
        responseType: "json",
      })
      // ResponseType is a configuration option in the Axios library that specifies the type of data expected to be returned in the response
      .then((response) => {
        this.products = response.data;
      });
  },
};
</script>