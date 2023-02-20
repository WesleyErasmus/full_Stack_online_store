<template>
  <div id="main" class="product-page">
    <div class="product">

      <!-- Product gallery page // Products are redirected here once the user clicks on the product -->

      <!-- v-if to display product content / also linked to a v-else for page loading spinner -->
      <div v-if="product">

        <!-- Page heading -->
        <h1 class="page-heading">Product Details</h1>

        <!-- View cart link -->
        <div></div>
        <RouterLink :to="{ name: 'Cart' }">
          <div class="view-cart">View Cart</div>
        </RouterLink>

        <!-- Product image gallery inages container -->
        <div class="product-container">
          <div class="product-image-container">

            <!-- Image 1 -->
            <div class="img-box">
              <img class="product-img" :src="product.images + 0" alt="Product Image 1" @click="toggleModal1" />
            </div>

            <!-- Image 2 -->
            <div class="img-box">
              <img class="product-img" :src="product.images + 1" alt="Product Image 2" @click="toggleModal2" />
            </div>

            <!-- Image 2 -->
            <div class="img-box">
              <img class="product-img" :src="product.images + 2" alt="Product Image 3" @click="toggleModal3" />
            </div>



            <!-- Modals that pop up with enlarged product images / images are linked by using the same index number in the product.images object in API -->

            <!-- Teleporting outside of page container - see #modals div in the index.html file -->
            <!-- Image modal 1 -->
            <teleport to="#modals" v-if="showModal1">
              <Modal @close="toggleModal1">
                <img class="product-img-zoomed" :src="product.images + 0" alt="Product Image 1" />
                <template v-slot:links>
                  <button class="close-modal-button" @click="toggleModal1"><span class="material-symbols-outlined">
                      close </span></button>
                </template>
              </Modal>
            </teleport>

            <!-- Image modal 2 -->
            <teleport to="#modals" v-if="showModal2">
              <Modal @close="toggleModal2">
                <img class="product-img-zoomed" :src="product.images + 1" alt="Product Image 2" />
                <template v-slot:links>
                  <button class="close-modal-button" @click="toggleModal2"><span class="material-symbols-outlined">
                      close </span></button>
                </template>
              </Modal>
            </teleport>

            <!-- Image modal 3 -->
            <teleport to="#modals" v-if="showModal3">
              <Modal @close="toggleModal3">
                <img class="product-img-zoomed" :src="product.images + 2" alt="Product Image 3" />
                <template v-slot:links>
                  <button class="close-modal-button" @click="toggleModal3">
                    <span class="material-symbols-outlined"> close </span>
                  </button>
                </template>
              </Modal>
            </teleport>
          </div>
          <!-- End of product images container -->


          <!-- Product details container -->
          <div class="product-details">
            <span class="product-id">Product id: {{ product.id }}</span>

            <h3 class="product-title">{{ product.title }}</h3>

            <div class="product-price">R{{ product.price }}</div>

            <div class="product-department">
              Department: {{ product.category.name }}
            </div>

            <div class="product-description-title">Product Details</div>

            <div class="product-description">{{ product.description }}</div>


            <!-- Add to cart button -->
            <button class="add-to-cart-btn" @click="addToCart(product)">
              <span class="material-symbols-outlined shopping-cart-icon">
                add_shopping_cart
              </span>
              Add to Cart
            </button>
          </div>
          <!-- End of product details container -->
        </div>
      </div>

      <!-- V-else to display spinner on page load -->
      <div v-else>
        <Spinner />
      </div>
    </div>
  </div>

  <!-- Add to cart success message -->
  <Toasts />

</template>

<script>
// component imports
import axios from "axios";
import Spinner from "/src/components/Spinner.vue";
import Modal from "/src/components/Modal.vue";
import Toasts from "/src/components/Toasts.vue";
export default {
  components: { Spinner, Modal, Toasts },
  // Id. props used for dynamic routing / props enabled on product component. See router/index.js
  props: ["id"],
  data() {
    return {

      product: null,
      shoppingCart: [],
      showModal1: false,
      showModal2: false,
      showModal3: false,
    };
  },
  methods: {
    // Add to cart success message
    addToCartSuccessToast() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function () {
         // Refreshes page after item is removed from cart
        window.location.reload();
        x.className = x.className.replace("show", "");
      }, 1000);
    },


    // Product Zoom Modals
    toggleModal1() {
      this.showModal1 = !this.showModal1;
    },
    toggleModal2() {
      this.showModal2 = !this.showModal2;
    },
    toggleModal3() {
      this.showModal3 = !this.showModal3;
    },


    // Add products to shopping cart function
    addToCart(product) {
      // Ensure that the product array is not empty
      if (!this.shoppingCart) {
        return;
      }

      // Adding products to the front of the cart
      if (this.shoppingCart.unshift(product)) {
      }

      // Save to local storage function
      this.saveToLocalStorage();

      // Product added message
      this.addToCartSuccessToast()
    },

    // Save products to cart function
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

    axios
      .get("https://api.escuelajs.co/api/v1/products/" + this.id)
      .then((response) => {
        this.product = response.data;
        console.warn(response);
      });
  },
};

</script>

<style scoped>

/* Page container */
.product-page {
  box-shadow: var(--card-shadows);
}


/* View cart button below page header */
.view-cart {
  display: inline-block;
  color: var(--primary-color);
  font-weight: bold;
  text-decoration: underline;
}

.view-cart:hover {
  color: var(--primary-grey);
}


/* Product details wrapper */
.product {
  margin-top: 2vw;
  padding: 2rem;
}

/* Flex container for images layout */
.product-container {
  display: flex;
  flex-direction: row;
  padding: 2vw 0;
}

/* Contains images only */
.product-image-container {
  position: relative;
  width: 590px;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-content: center;
  flex-direction: column;
}

/* Individual image container for hover effect */
.img-box {
  display: flex;
  justify-content: center;
  align-content: center;
  overflow: hidden;
  margin: 0.2rem;
}


/* Product images */
.product-img {
  width: 270px;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}

.product-img:hover {
  position: relative;
  transform: scale(1.2);
  cursor: zoom-in;
}


/* Modal product images */
.product-img-zoomed {
  width: 100%;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
}

.product-img-zoomed:hover {
  position: relative;
}

/* Close modal button / modal can also be closed if you click anywhere else on the screen */
.close-modal-button {
  padding: 0;
  margin: 0;
  background: transparent;
}

/* Product details container */
.product-details {
  width: 450px;
  margin-left: 2rem;
}


/* Product title container */
.product-title {
  padding: 0 0.5rem;
}


/* Product price text styling */
.product-price {
  font-size: calc(14px + 1rem);
  font-weight: bold;
  padding: 0 0.5rem;
  color: var(--primary-color);
}


/* Product id font sizing */
.product-id {
  padding: 0 0.5rem;
  font-size: calc(8px + 0.2rem);
}


/* Compartment text container */
.product-department {
  color: grey;
  padding: 0 0.5rem;
}

/* Description and title container */
.product-description-title {
  padding: 0 0.5rem;
  margin-top: 3rem;
  color: rgb(102, 102, 102);
  font-weight: 600;
  padding-bottom: 0.2rem;
}

/* Product description font styling */
.product-description {
  padding: 0 0.5rem;
  color: grey;
  font-size: calc(8px + 0.35rem);
}

/* Add to cart button */
.add-to-cart-btn {
  margin-top: 3rem;
  width: 100%;
  background: var(--primary-color);
  padding: 0.5rem;
  border-radius: 6px;
  color: #fff;
  font-size: calc(13px + 0.5rem);
  box-shadow: var(--card-shadows);
}


/* Google fonts shopping cart icon */
.shopping-cart-icon {
  position: relative;
  bottom: -4px;
  margin-right: 13px;
  font-size: 28px;
}

.add-to-cart-btn:hover {
  opacity: 0.8;
}
</style>
