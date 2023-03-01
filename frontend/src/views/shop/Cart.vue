<template>
  <div id="main" class="cart-page mx-auto">

    <div>
      <ul>
        <li v-for="(cartItem, index) in shoppingCart" :key="index">
          <p>Cart Item Id: {{ cartItem.cart_item_id }}</p>
          <p>Customer Id: {{ cartItem.customer_id }}</p>
          <p>Product Id: {{ cartItem.product_id }}</p>
          <p>Price: R{{ cartItem.price }}</p>
          <p>Title: {{ cartItem.title }}</p>
          <p>Description: {{ cartItem.description }}</p>
          <p>Category: {{ cartItem.category }}</p>
          <p>
            <img :src="cartItem.image" alt="" style="max-width: 200px; max-height: 200px;">
          </p>
           <button @click="removeFromCart(cartItem.cart_item_id)">Remove from Cart</button>
        </li>
      </ul>
    </div>

    <!-- End of Cart Page Wrapper -->
    <!-- Remove cart message toast-->
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
    
    // Updates local storage function
    saveToLocalStorage() {
      const parsed = JSON.stringify(this.shoppingCart);
      localStorage.setItem("shoppingCart", parsed);      
    },
  },
  mounted() {
    // User id cookie
    let customerId = this.cookies.get("customer_id");
    const customer_id = parseInt(customerId);

    // Display cart items for a customer. Customerid parameter displaying only cart items with the customers id
    api.get(`/controllers/CartController.php?action=displayCartItems&tableName=myTable&customerId=${customer_id}`, { responseType: 'json' })
      .then((response) => {
        this.shoppingCart = response.data;
        
        console.warn(response);
        // console.log(this.shoppingCart)
        console.log("customer_id:", customer_id, typeof customer_id);
      });
  },
};
</script>

<style scoped>
/* Prevents that cart page from looking squashed when cart is empty */
.cart-page {
  min-height: 69vh;
}

/* Cart length & total display & submit btn container */
.cart-sum-total {
  position: fixed;
  top: 9vw;
  right: 8vw;
  text-align: center;
  padding: 2rem;
  width: 25%;
  background: #fff;
  z-index: 2;
  border-radius: 3px;
}

/* Cart count text */
.count-text {
  font-size: calc(11px + 0.35rem);
  font-weight: bold;
}

/* Cart count number text */
.count-number {
  color: var(--primary-color);
  font-weight: bold;
  font-size: calc(11px + 0.6em);
}

/* CART PRODUCT STYLING */

/* Main container */
.cart-items {
  width: 65%;
}

/* Cart item title */
.card-title {
  font-size: calc(12px + 0.4rem);
}

/* Cart item container */
.cart-item {
  margin: var(--card-padding);
  padding: var(--card-padding);
  box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
}

/* Product image */
.card-img-top {
  aspect-ratio: 3 / 4;
  width: 73px;
  border-radius: 2px;
}

/* Cart item parent container for flex */
.parent {
  display: flex;
}

/* Cart item child container for flex */
.child-1 {
  margin: var(--card-padding);
  background: transparent;
}

/* Cart item child container for flex */
.child-2 {
  padding: var(--card-padding);
}

/* Cart item child container for flex */
.child-3 {
  padding: var(--card-padding);
}

/* Remove from cart button */
.remove-from-cart {
  font-size: calc(10px + 0.3rem);
  font-weight: bold;
}

/* Google cart icon */
.cart-icon {
  font-size: 20px;
    position: relative;
    bottom: -4px;
    margin-right: 10px;
}

/* Container for remove from cart button */
.button-counter {
  display: flex;
  justify-content: space-between;
}

/* Prevent zoom on hover */
.card-img-top:hover {
  transform: scale(1);
}

.card-description {
  font-size: calc(9px + 0.3rem);
}

button {
  background: var(--primary-color);
  color: #fff;
}

button:hover {
  opacity: 0.8;
}

/* Prices font size */
.price {
  font-size: calc(10px + 0.5rem);
}

/* Total text font size */
.total {
  font-size: calc(20px + 0.4rem);
  font-weight: bold;
}

/* Total number color */
.total-number {
  color: var(--primary-color);
}

/* Checkout button */
.checkout-btn {
  width: 100%;
  margin-top: 1rem;
  padding: var(--card-padding);
  font-size: calc(12px + 0.4rem);
}

@media screen and (min-width: 841px) and (max-width: 1280px) {
  .cart-sum-total {
    top: 15vw;
    right: 8vw;
    width: 30%;
  }
    .checkout-btn {
      font-size: calc(12px + 0.3rem);
    }

  .cart-items {
    width: 60%;
  }

  .card-img-top {
    aspect-ratio: 3 / 4;
    width: 95px;
    border-radius: 2px;
  }

  .card-description {
    font-size: calc(8px + 0.3rem);
  }

  .large-cart-heading {
    font-size: calc(20px + 0.3rem);
  }
}

@media screen and (min-width: 662px) and (max-width: 840px) {

  .cart-sum-total {
    position: relative;
    top: 0;
    width: 100%;
    right: 0;
  }
.cart-items {
  width: 100%;
}
  .card-img-top {
    aspect-ratio: 3 / 4;
    width: 100px;
    border-radius: 2px;
  }

  .card-description {
    font-size: calc(8px + 0.3rem);
  }

    .large-cart-heading {
      display: none;
    }
}

@media screen and (min-width: 481px) and (max-width: 661px) {

  .cart-sum-total {
    position: relative;
    top: 0;
    width: 100%;
    right: 0;
  }

  .card-img-top {
    aspect-ratio: 3 / 4;
    width: 100px;
    border-radius: 2px;
  }

  .cart-items {
    width: 100%;
  }

  .card-description {
    font-size: calc(8px + 0.3rem);
  }

  .large-cart-heading {
    display: none;
  }
}

@media screen and (min-width: 0) and (max-width: 480px) {
  .cart-sum-total {
      position: relative;
      top: 0;
      width: 100%;
      right: 0;
    }
  
    .card-img-top {
      aspect-ratio: 3 / 4;
      width: 100px;
      border-radius: 2px;
    }
  
    .cart-items {
      width: 100%;
    }
  
    .card-description {
      font-size: calc(8px + 0.2rem);
    }
  
    .large-cart-heading {
      display: none;
    }
}
</style>
