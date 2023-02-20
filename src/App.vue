<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>

<!-- Sticky navbar -->
  <header ref="top" id="header" class="sticky-top">

    <!-- Store logo container -->
    <div class="logo-container">
      <!-- Store logo -->
      <img class="store-logo-words" src="../src/assets/logofull.png" alt="Logo Image">
    </div>

    <!-- Router page links -->
    <div class="wrapper">
      <nav>
        <RouterLink :to="{ name: 'Home' }">Home</RouterLink>
        <RouterLink :to="{ name: 'Shop' }">Shop</RouterLink>
        <RouterLink :to="{ name: 'Cart' }">Cart</RouterLink>
        <RouterLink :to="{ name: 'FeaturedProducts' }">Trending</RouterLink>
        <RouterLink :to="{ name: 'NewProducts' }">New In</RouterLink>
        <RouterLink :to="{ name: 'About' }">About</RouterLink>
        <RouterLink :to="{ name: 'Contact' }">Contact</RouterLink>

        <!-- Shopping Cart Icon in header -->
        <div id="navbar-cart" class="cart-icon-link-container">

          <!-- Shopping cart icon & link to cart -->
          <RouterLink class="shopping-cart-icon" :to="{ name: 'Cart' }">CART<span class="material-symbols-outlined">
              add_shopping_cart
            </span>
            <!-- Shopping cart count display -->
            <div class="cart-count-number">{{ this.shoppingCart.length }}</div>
          </RouterLink>
          <!-- Cart length count -->
        </div>
      </nav>
    </div>

    <!-- Redirect buttons  #youreasynav-->
    <div class="redirect-btn-container">
      <nav>
        <span>#youreasynav >></span>
        <a @click="smoothScrollToTop" class="back-to-top-btn">Back to top</a>
        <a class="redirect-btn" @click="back">Back</a>
        <a class="redirect-btn" @click="forward">Forward</a>
      </nav>
    </div>
  </header>

  <RouterView />

  <!-- App Footer component -->
  <Footer />
</template>

<script>
// Components import
import Footer from "../src/components/Footer.vue";
import Product from "../src/views/shop/Product.vue";
export default {
  components: { Footer, Product },
  // props to bring in cart array length count
  props: ["shoppingCart"],
  data() {
    return {
      cartCount: 0,
      shoppingCart: []
    }
  },
  methods: {
    // Back redirect button / using router history feature
    back() {
      this.$router.go(-1);
    },
    // Forward redirect button / using router history feature
    forward() {
      this.$router.go(1);
    },
    // Smooth scroll to top of page function
    smoothScrollToTop() {
      window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
    },
  },

  computed: {
    // To display Shopping cart length
    cartLength() {
      return this.shoppingCart.length;
    },
  },
  mounted() {
    // To display Shopping cart length
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


/* App header styling */
header {
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue",
    sans-serif;
  padding: 1.5rem 0;
  padding-bottom: 2.8rem;
  text-align: center;
  background: #fff;
}


/* App logo container */
.logo-container {
  position: relative;
  display: block;
    margin: 0 auto;
  max-width: 1280px;
}

/* Logo */
.store-logo-words {
  position: absolute;
  top: -50px;
  left: 30px;
  width: calc(50px + 3.5vw);
  margin-top: 0;
  padding-top: 1.5rem;
}

/* Shopping cart icon and cart item count container */
.cart-icon-link-container {
  display: block;
  margin: 0 auto;
  max-width: 1280px;
  position: relative;
  margin-top: 5px;
}


/* Shopping cart icon */
.shopping-cart-icon {
  position: absolute;
  right: 2vw;
  top: -1vw;
  color: rgb(78, 78, 78);
  /* color: #000; */
}

.shopping-cart-icon:hover {
  color: var(--primary-color);
}


/* Cart number displayed on dom */
.cart-count-number {
  position: absolute;
  top: -20px;
  right: 5px;
  line-height: 1;
  padding: 6px 0;
  width: 24px;
  height: 24px;
  border-radius: 99999px;
  background: var(--primary-color);
  color: #fff;
  font-size: 12px;
}

/* Shopping cart icon font styling */
.shopping-cart-icon .material-symbols-outlined {
  font-size: calc(25px + 0.3rem);
  font-weight: bold;
  color: var(--primary-grey);
  color: #000;

}
/* Back to top of page button */
.back-to-top-btn {
color: rgb(78, 78, 78);
}


/* Nav bar links styling */
nav a.router-link-exact-active {
  color: #000;
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

/* Redirect buttons container */
.redirect-btn-container {
  display: inline-block;
  margin-top: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid #ddd;
  cursor: pointer;
}


/* MEDIA QUERIES */
@media screen and (min-width: 481px) and (max-width: 840px) {
#header {
    padding-top: 1rem;
    padding-bottom: 0;
  }

  #app {
    padding-top: 0rem;
  }

  .store-logo-words {
    position: relative;
    top: 0px;
    left: 0px;
    padding-top: 0;
    margin-bottom: 20px;
  }

  .cart-icon-link-container {
    display: none;
  }

  .redirect-btn-container {
    display: none;
  }  
}


@media screen and (min-width: 0) and (max-width: 480px) {

#header {
    padding-top: 1rem;
    padding-bottom: 0;
  }

  #app {
    padding-top: 0rem;
  }

  .store-logo-words {
    position: relative;
    top: 0px;
    left: 0px;
    padding-top: 0;
    margin-bottom: 20px;
  }

  .cart-icon-link-container {
    display: none;
  }

  .redirect-btn-container {
    display: none;
  }
}
</style>
