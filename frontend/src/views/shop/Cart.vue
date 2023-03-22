<template>
  <div class="page-container mx-auto" id="main">

    <!-- Page heading -->
    <h1>Your cart items: {{ cartLength }}</h1>
    <!-- V-if that displays empty cart message if cart is empty -->
    <div v-if="!shoppingCart.length">Your Cart is empty</div>

    <!-- DIsplays cart details or cart when there are cart items -->
    <div class="mr-7 cart-card-container">
      <div class="cart-items">
        <!-- V-for loop -->
        <div v-for="item in shoppingCart" :key="item.id">
          <v-card class="ma-2 cart-item-card" variant="none">
            <div>
              <v-img class="product-img-scale" :src="item.image" width="100px" max-height="150px" height="100%" cover>
              </v-img>
            </div>
            <div class="ml-3 card-body">
              <!-- Cart item title -->
              <v-card-title class="text-subtitle-1 font-weight-bold ml-0 pa-0">
                {{ item.title }}
              </v-card-title>
              <div>
                <!-- Cart item category -->
                <div class="ma-0 text-caption font-weight-medium py-1">
                  {{ item.category }}
                </div>
                <!-- Cart item description -->
                <v-card-subtitle class="text-caption pl-0 font-weight-medium">
                  {{ item.description }}
                </v-card-subtitle>
                <!-- Cart item price -->
                <div class="ma-0 font-weight-bold py-1">
                  R{{ item.price }}
                </div>
              </div>
              <!-- View product button using dynamic routing to view product in product gallery page -->
              <v-card-actions class="pt-0 mt-0">
                <router-link class="text-decoration-none" :to="{ name: 'Product', params: { id: item.product_id } }">
                  <v-btn class="mt-0 text-black" size="small" variant="tonal">View Product</v-btn>
                </router-link>
                <!-- Remove from cart button -->
                <v-btn color="error" variant="tonal" size="small" icon="mdi-cart-off" class="mt-0 ml-6"
                  @click="removeFromCart(item.cart_item_id)">
                </v-btn>
              </v-card-actions>
            </div>
          </v-card>
        </div>
      </div>
      <!-- Display cart details -->
      <div>
        <v-card class="cart-total pa-5 " variant="tonal">
          <v-card-title class="text-h5 font-weight-bold">
            Cart:
          </v-card-title>
          <!-- Display number of items in cart -->
          <v-card-subtitle>
            Total items in cart: <span>{{ cartLength }}</span>
          </v-card-subtitle>
          <!-- Display total cost of cart items -->
          <v-card-title class="text-h6">
            Total: <span class="font-weight-bold">R{{ priceTotal }}</span>
          </v-card-title>
          <!-- Placeholder info -->
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
      shoppingCart: [],
      // Total cost of cart items
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
    // Remove from cart success message
    itemRemovedMessage() {
      var x = document.getElementById("snackbar3");
      x.className = "show";
      setTimeout(function () {
        // Refreshes page after item is removed from cart
        window.location.reload();
        x.className = x.className.replace("show", "");
      }, 4000);
    },
    // Remove from cart failure message
    itemRemovedFailedMessage() {
      var x = document.getElementById("snackbar8");
      x.className = "show";
      setTimeout(function () {
        x.className = x.className.replace("show", "");
      }, 4000);
    },
    // Remove products from cart function
    removeFromCart(cartItemId) {
      api.get(`/controllers/CartController.php?action=removeFromCart&tableName=myTable&cartItemId=${cartItemId}`, { responseType: 'json' })
        .then((response) => {
          
          if (response.data === true) {
            // Remove cart item from shoppingCart array
            this.shoppingCart = this.shoppingCart.filter(item => item.cart_item_id !== cartItemId);

            // Cart item successfully removed message
            this.itemRemovedMessage();
          }
          else {
            console.log("Error removing item from cart");
            this.itemRemovedFailedMessage()
            // console.log(response.data);
          }
        })
        .catch(error => {
          console.error(error);
        });
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
        // console.warn(response);
        // console.log("customer_id:", customer_id, typeof customer_id);
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>

<style scoped>
/* Page container */
.page-container {
  min-height: 70vh;
}
/* Container for all cart items */
.cart-card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: start;
}
/* Cart item card styling */
.cart-item-card {
  display: flex;
}

.card-body {
  max-width: 275px;
}
/* Container for cart total & proceed to checkout button */
.cart-total {
  width: 350px;
  height: 330px;
}
</style>

