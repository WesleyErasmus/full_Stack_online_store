<template>
  <div id="main" class="cart-page">

    <!-- Page heading -->
    <h1 class="large-cart-heading">Your Cart: {{ cartLength }}</h1>
    
    <!-- V-if that displays empty cart message if cart is empty -->
    <div v-if="!shoppingCart.length">Your Cart is empty</div>

    <!-- V-if used to display spinner component while products are loading -->
    <div v-if="shoppingCart.length" class="cart-items">

      <!-- flex parent container to display product content-->
      <div class="cart-item" v-for="product in shoppingCart" :key="product.id">
    
    <!-- flex child-1 container -->
        <div class="parent">
          <div class="img-box child-1">
            <img :src="
              'https://source.unsplash.com/random/?fashion/id' + product.id
            " class="card-img-top" alt="Product Image" />
          </div>

          <!-- flex child-2 container -->
          <div class="child-2 col">
            <div class="card-title">{{ product.title }}</div>
            <div class="card-text">Product details</div>
            <div class="card-description">{{ product.description }}</div>
          </div>

          <!-- child-3 -->
          <div class="child-3 row">
            <div class="price">R{{ product.price }}</div>
          </div>

          <!-- End of parent container -->
        </div>

        <!-- Container for remove from cart button -->
        <div class="button-counter">
          <div>
            <button class="remove-from-cart" @click="removeFromCart(product)">
              <span class="cart-icon material-symbols-outlined">
                remove_shopping_cart </span>Remove
            </button>
          </div>
        </div>
      </div>
    </div>


<!-- Cart array length and price total container -->
    <div class="cart-sum-total">

      <!-- Displays amount of items in the cart -->
      <div class="count-text">
        Total items in cart: <span class="count-number">{{ cartLength }}</span>
      </div>

      <!-- Displays total cart price -->
      <div class="total">
        Total: <span class="total-number">R{{ priceTotal }}</span>
      </div>

      <!-- Checkout btn container -->
      <div class="checkout">

       <!-- Proceed to checkout button -->
        <button class="checkout-btn">Proceed To Checkout</button>
      </div>
    </div>

    <!-- End of Cart Page Wrapper -->
  </div>

  
  <!-- Remove cart message toast-->
  <Toasts />
</template>

<script>
// Components import
import Toasts from "/src/components/Toasts.vue";
export default {
  components: { Toasts },
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
    removeFromCart(product) {
      const remove = this.shoppingCart.filter((i) => i != product);

      this.shoppingCart = remove;

      // Update cart array
      this.saveToLocalStorage();

      // Product removed message
      this.itemRemovedMessage()
    },

    // Updates local storage function
    saveToLocalStorage() {
      const parsed = JSON.stringify(this.shoppingCart);
      localStorage.setItem("shoppingCart", parsed);      
    },
  },
  mounted() {
    // Display local storage products in the DOM
    if (localStorage.getItem("shoppingCart")) {
      try {
        this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"));
      } catch (e) {
        localStorage.removeItem("shoppingCart");
      }
    }
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
