<template>
  <div id="main">

    <div class="pa-4 cart-card-container">
    <v-row class="fill-height" align="center" justify="center">
      <v-col cols="12" md="6">
        <div v-for="item in shoppingCart" :key="item.id">
          <v-card class="ma-2" variant="none">
            <v-row>
              <v-col cols="3">
                <v-img :src="item.image" height="150px" cover>
                </v-img>
              </v-col>
              <v-col cols="9">
                <v-card-title class="font-weight-bold py-0">
                  {{ item.title }}
                </v-card-title>
                <div>
                  <v-card-text class="ma-0 text-caption font-weight-medium py-1">
                    {{ item.category }}
                  </v-card-text>
                  <v-card-subtitle class="text-caption font-weight-medium">
                    {{ item.description }}
                  </v-card-subtitle>
                </div>
                <v-card-actions class="pt-0">
                  <v-spacer></v-spacer>
                  <!-- <router-link :to="{ name: 'Product', params: { id: product.id } }"> -->
                <v-btn class="mt-2 text-primary" size="small" variant="elevated">View Product</v-btn>
                <!-- </router-link> -->
                  <v-btn color="error" size="large" icon="mdi-delete-off" class="mt-2 mr-6">
                  </v-btn>
                
                </v-card-actions>
              </v-col>
            </v-row>
          </v-card>
        </div>
      </v-col>
    </v-row>
  </div>
    <Toasts />
  </div>
</template>

<script>
// Components import
import api from "@/services/api.js";
import Toasts from "/src/components/Toasts.vue";
import { useCookies } from "vue3-cookies";
export default {
  components: { Toasts },
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  data() {
    return {
      shoppingCart: [],
      total: 0,
    };
  },
  computed: {
    // Displays cart array length
    cartLength() {
      return this.shoppingCart.length;
    },
    // Calculates total price of products in cart array
    priceTotal() {
      let total = 0;
      this.shoppingCart.forEach((product, i) => {
        total += product.price;
      });
      return total;
    },
  },
  methods: {
    // Remove from success message
    itemRemovedMessage() {
      var x = document.getElementById("snackbar3");
      x.className = "show";
      setTimeout(function () {
        // Refreshes page after item is removed from cart
        window.location.reload();
        x.className = x.className.replace("show", "");
      }, 1000);
    },
    // Remove products from cart function
    removeFromCart(cartItemId) {
      api.get(`/controllers/CartController.php?action=removeFromCart&tableName=myTable&cartItemId=${cartItemId}`, { responseType: 'json' })
        .then((response) => {
          if (response.data === true) {
            // Remove cart item from shoppingCart array
            this.shoppingCart = this.shoppingCart.filter(item => item.cart_item_id !== cartItemId);
          }
        })
        .catch((error) => {
          console.error(error);
        });

      this.itemRemovedMessage()
    },
  },
 mounted() {
    // User id cookie
    let customerId = this.cookies.get("customer_id");
    if (!customerId) {
      // If customer_id cookie does not exist, set the shoppingCart array to an empty array
      this.shoppingCart = [];
      return;
    }
    const customer_id = parseInt(customerId);
    // Display cart items for a customer. Customerid parameter displaying only cart items with the customers id
    api.get(`/controllers/CartController.php?action=displayCartItems&tableName=myTable&customerId=${customer_id}`, { responseType: 'json' })
      .then((response) => {
        this.shoppingCart = response.data;
        console.warn(response);
        console.log("customer_id:", customer_id, typeof customer_id);
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>

<style scoped>

</style>