<template>
  <div class="page-container mx-auto" id="main">

    <!-- Page heading -->
    <h1>Your cart items: {{ cartLength }}</h1>
    <!-- V-if that displays empty cart message if cart is empty -->
    <div v-if="!shoppingCart.length">Your Cart is empty</div>

    <!-- DIsplays cart details or cart when there are cart items -->
    <div class="mr-7 cart-card-container">
      <div class="cart-items">
      <v-row class="fill-height" align="start">
        <v-col cols="auto">
          <div v-for="item in shoppingCart" :key="item.id">
            <v-card class="ma-2" variant="none">
              <v-row>
                <v-col cols="3">
                  <v-img class="product-img-scale" :src="item.image" max-width="125px" max-height="150px" height="100%" cover>
                  </v-img>
                </v-col>
                <v-col cols="9">
                  <v-card-title class="text-subtitle-1 font-weight-bold ml-0 pa-0">
                    {{ item.title }}
                  </v-card-title>
                  <div>
                    <div class="ma-0 text-caption font-weight-medium py-1">
                      {{ item.category }}
                    </div>
                    <v-card-subtitle class="text-caption pl-0 font-weight-medium">
                      {{ item.description }}
                    </v-card-subtitle>
                    <div class="ma-0 font-weight-bold py-1">
                      R{{ item.price }}
                    </div>
                  </div>
                  <v-card-actions class="pt-0 mt-0">
                    <v-spacer></v-spacer>
                    <router-link :to="{ name: 'Product', params: { id: item.product_id } }">
                      <v-btn class="mt-0 text-primary" size="small" variant="elevated">View Product</v-btn>
                    </router-link>
                    <v-btn color="error" size="large" icon="mdi-cart-off" class="mt-0 mr-6"
                      @click="removeFromCart(item.cart_item_id)">
                    </v-btn>
                  </v-card-actions>
                </v-col>
              </v-row>
            </v-card>
          </div>
        </v-col>
      </v-row>
      </div>
      <!-- Display cart details -->
      <div>
      <v-card class="cart-total pa-5 ml-10"
      variant="elevated" color="white">
          <v-card-title class="text-h5 font-weight-bold">
            Cart:
          </v-card-title>
          <v-card-subtitle>
            Total items in cart: <span>{{ cartLength }}</span>
          </v-card-subtitle>
          
            
          <v-card-title class="text-h6">
            Total: <span class="font-weight-bold">R{{ priceTotal }}</span>
          </v-card-title>
          <v-card-text>
            Delivery
          <v-icon class="mr-1">mdi-truck-check</v-icon>
          </v-card-text>
          <v-card-text class="mt-1 pt-0">
            Payment methods: 
          <v-icon class="mr-2">mdi-credit-card-outline</v-icon>
          <v-icon class="mr-2">mdi-contactless-payment-circle-outline</v-icon>
          <v-icon class="mr-2">mdi-cash</v-icon>
          </v-card-text>
          <v-card-actions class="mt-3">
            <v-btn block color="primary" size="large" variant="elevated">Proceed To Checkout</v-btn>
          </v-card-actions>
      </v-card>
      </div>
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
      sticky: true,
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
        total += parseInt(product.price);
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
.page-container {
  min-height: 70vh;
}
.cart-items {
  max-width: 700px;
}
.cart-card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: start;
}
.cart-total {
  width: 350px;
  height: 350px;
}
</style>

