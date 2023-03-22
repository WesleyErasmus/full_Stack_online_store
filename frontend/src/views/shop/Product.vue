<template>
  <!-- Product view page -->
  <div id="main" class="mx-auto">
    <div v-if="products">
      <!-- Page toolbar -->
      <div class="pt-5 mt-5">
        <!-- Disable add to cart button for guest users -->
        <v-alert color="warning" variant="tonal" class="mb-3 text-caption rounded text-center" v-if="!customer_id">
          <v-spacer></v-spacer>
          Please
          <!-- Link to login page -->
          <RouterLink :to="{ name: 'Login' }" class="text-primary font-weight-bold text-decoration-none">
            Login
          </RouterLink> or
          <!-- Link to sign up page -->
          <RouterLink :to="{ name: 'SignUp' }" class=" text-primary font-weight-bold text-decoration-none">
            Sign-Up
          </RouterLink>
          to add items to the
          cart.
          <v-spacer></v-spacer>
        </v-alert>
      </div>
        <div>
          <RouterLink :to="{ name: 'Shop' }" class="text-decoration-none text-black d-flex justify-end">
            <v-btn variant="outlined" color="primary">
              Continue Shopping
            </v-btn>
          </RouterLink>
        </div>
      <!-- Product display card -->
      <v-card variant="none">
        <v-container fluid>
          <v-row dense>
            <v-col>
              <v-card v-for="product in products" :key="product.id" variant="none">
                <!-- card body container -->
                <v-container class="product-card-flex-container">
                  <!-- All images container -->
                  <div class="product-card-flex-inner">
                    <!-- Image gallery container -->
                    <div class="d-flex flex-column img-gallery-container">
                      <!-- Default image -->
                      <v-img :src="product.image" @click="updateMainImage(product.image)" class="mx-3 product-img"
                        aspect-ratio="1/1" cover>
                      </v-img>
                      <!-- Image gallery 1 -->
                      <v-img :src="product.img_gallery_1" @click="updateMainImage(product.img_gallery_1)"
                        class="ma-3 mb-0 product-img" aspect-ratio="1/1" cover>
                      </v-img>
                      <!-- Image gallery 2 -->
                      <v-img :src="product.img_gallery_2" @click="updateMainImage(product.img_gallery_2)"
                        class="ma-3 product-img" aspect-ratio="1/1" cover>
                      </v-img>
                      <!-- Image gallery 3 -->
                      <v-img :src="product.img_gallery_3" @click="updateMainImage(product.img_gallery_3)"
                        class="mx-3 product-img" aspect-ratio="1/1" cover>
                      </v-img>
                    </div>
                    <!-- Preview image -->
                    <div>
                      <v-img class="click-img-zoom" :src="mainImageSrc" aspect-ratio="1/1" @click="dialog = true">
                      </v-img>
                    </div>
                  </div>
                  <!-- Card text -->
                  <div class="card-body-text py-3">
                    <v-card-item class="text-h6 mb-1">{{ product.title }}</v-card-item>
                    <v-card-title>R{{ product.price }}</v-card-title>
                    <hr class="ma-3">
                    <v-card-subtitle class="pt-3">
                      <div>
                        Department: {{ product.category }}
                      </div>
                    </v-card-subtitle>
                    <v-card-text>
                      <div class="mb-2">Product Details</div>
                      <div class="text-caption">{{ product.description }}</div>
                    </v-card-text>
                    <!-- Add to cart button -->
                    <!-- Disable add to cart button for guest users -->
                    <v-btn color="primary" size="large" class="my-5 mx-3" block variant="elevated"
                      :disabled="!customer_id" @click="addToCart()">
                      <span class="material-symbols-outlined">
                        add_shopping_cart
                      </span>
                      Add to Cart
                    </v-btn>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <!-- card links for aesthetics -->
                      <div class="my-2">
                        <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>
                        <v-btn size="small" color="surface-variant" variant="text" icon="mdi-bookmark"></v-btn>
                        <v-btn size="small" color="surface-variant" variant="text" icon="mdi-share-variant"></v-btn>
                      </div>
                    </v-card-actions>
                  </div>
                </v-container>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </div>
    <!-- page loading spinner -->
    <div v-else>
      <Spinner />
    </div>
    <!-- Zoomed product dialog -->
    <v-dialog v-model="dialog" max-width="100%">
      <v-card>
        <!-- Zoomed image modal/dialog button -->
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn icon="mdi-close" @click="dialog = false"></v-btn>
        </v-card-actions>
        <v-card-item class="pb-5">
          <v-img :src="mainImageSrc" class="mx-auto" max-height="600" />
        </v-card-item>
      </v-card>
    </v-dialog>
    <!-- Add to cart success message -->
    <Toasts />
  </div>
</template>
<script>
// component imports
import api from "@/services/api.js";
import Spinner from "/src/components/Spinner.vue";
import Toasts from "/src/components/Toasts.vue";
import { useCookies } from "vue3-cookies";
export default {
  components: { Spinner, Toasts },
  // Id. props used for dynamic routing / props enabled on product component. See router/index.js
  props: ["id"],
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  data() {
    return {
      // for carousel
      model: null,
      // for dialog
      dialog: false,
      // main image on display
      mainImageSrc: '',
      products: null,
      shoppingCart: [],
      customer_id: this.cookies.get("customer_id")
    };
  },

  methods: {
    // Function to change which image is the source of the main image display
    updateMainImage(imageSrc) {
      this.mainImageSrc = imageSrc;
    },

    // Add to cart success message
    addToCartSuccessToast() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function () {
        // Refreshes page after item is removed from cart
        window.location.reload();
        x.className = x.className.replace("show", "");
      }, 4000);
    },
    // Add to cart Error message
    addToCartError() {
      var x = document.getElementById("snackbar8");
      x.className = "show";
      setTimeout(function () {
        x.className = x.className.replace("show", "");
      }, 4000);
    },

    // Add to cart function
    addToCart() {
      // Declaring variables and setting values to the variables
      const productId = parseInt(this.products[0].id);
      const price = parseInt(this.products[0].price);

      // User id cookie
      let customerId = this.cookies.get("customer_id");
      let customer_id = parseInt(customerId);

      // Post values to store in cart SQL table
      api.post(`/controllers/CartController.php?action=addToCart&tableName=myTable&id=${productId}&customerId=${customer_id}`, {
        productId: productId,
        customerId: customer_id,
        price: price
      }, {
        headers: {
          "Content-Type": "application/json"
        },
      })
          .then(response => {
          // console.log(response);
          if (response.data === true) { // check if the response is true
            // console.log("customer_id:", customer_id, typeof customer_id);
            // console.log("this.id:", productId, typeof productId);
            // console.log("price:", price, typeof price);

            // Calling toast message
            this.addToCartSuccessToast();
          } else { // handle error
            console.log("Error adding item to cart");
            this.addToCartError();
          }

        })
        .catch(error => {
          console.error(error);
        });
    },
  },
  mounted() {
    let customerId = this.cookies.get("customer_id");
    const customer_id = parseInt(customerId);
    // Get product based on the product id
    api.get(`/controllers/ProductController.php?action=displayProductById&tableName=myTable&id=${this.id}`, { responseType: 'json' })
      .then((response) => {
        this.products = response.data;
        this.mainImageSrc = this.products[0].image;
        // console.warn(response);
      });
  },
};
</script>

<style scoped>
/* View cart button below page header */
.view-cart {
  display: inline-block;
  color: black;
}

.view-cart:hover {
  color: var(--primary-grey);
}

/* Product images flex container */
.product-card-flex-container {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.product-card-flex-inner {
  display: flex;
}

/* Small side images */
.img-gallery-container {
  min-width: 125px;
  opacity: 0.5;
}

.card-body-text {
  max-width: 450px;
}

/* Individual image container for hover effect */

.product-img {
  width: 110px;
}

.product-img:hover {
  cursor: pointer;
  opacity: 0.75;
  transform: scale(105%);
}

.click-img-zoom {
  min-width: 480px;
}

.click-img-zoom:hover {
  cursor: zoom-in;
}

@media screen and (max-width: 840px) {

  .product-card-flex-container {
    justify-content: center;
  }

  .product-card-flex-inner {
    display: flex;
    flex-direction: column-reverse;
  }

  .img-gallery-container {
    opacity: 0.5;
    display: flex;
    flex-direction: row !important;
    align-content: center;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    height: 110px;
    padding-top: 10px;
  }

  .product-img {
    width: 50px;
    margin: 5px !important;
  }

}
</style>
