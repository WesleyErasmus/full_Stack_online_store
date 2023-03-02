<template>

<!-- New products page -->

  <div id="main" class="new-products-page">

    <!-- Page heading -->
    <h1>New Collection</h1>

    <!-- V-if to display spinner while products load -->
    <div v-if="products.length" class="container">
      <div class="row">
        
        <!-- V-for loop -->
        <div
         class="card col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 mb-4 mt-4"
          v-for="product in newProducts"
          :key="product.id"
        >

        <!-- Router link to Product gallery page -->
          <router-link :to="{ name: 'Product', params: { id: product.id } }">
           <div class="img-box">
           <img
              :src="
                'https://source.unsplash.com/random/?fashion/id' + product.id
              "
              class="card-img-top"
              alt="Product Image"
            />
            </div>
          </router-link>


          <div class="card-body">
            <h6 class="card-title">{{ product.title }}</h6>
            <p class="card-text">
              {{ product.category.name }}
            </p>
          </div>
          <div class="card-footer">
           <p class="price">R{{ product.price }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- V-else for page load spinner component -->
    <div v-else>
      <Spinner />
    </div>
  </div>
</template>

<script>
import axios from "axios";
// Components import
import Spinner from "/src/components/Spinner.vue"
export default {
    components: { Spinner },
  data() {
    return {
      products: [],
    };
  },
  computed: {
    // Function for filtering out all products within a specific category
    newProducts() {
      return this.products.filter((product) => product.category.id == "4");
    },
  },
  mounted() {
    axios.get("https://api.escuelajs.co/api/v1/products/").then((response) => {
      this.products = response.data;
      console.warn(response);
    });
  },
};
</script>
